<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->transactions()->with('category');

        // Filter by search (notes or category name)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('notes', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filter by type (income/expense)
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->input('end_date'));
        }

        $transactions = $query->latest('transaction_date')
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        $categories = Auth::user()->categories()->orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();
        
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        Auth::user()->transactions()->create($request->validated());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dibuat.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        Gate::authorize('update', $transaction);

        $categories = Auth::user()->categories()->orderBy('name')->get();
        
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        Gate::authorize('update', $transaction);

        $transaction->update($request->validated());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        Gate::authorize('delete', $transaction);

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Scan receipt using OCR.space API and extract total transaction amount.
     */
    public function scanStruk(Request $request)
    {
        $request->validate([
            'struk_gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $file = $request->file('struk_gambar');
        $filePath = $file->getRealPath();
        $mimeType = $file->getClientMimeType();
        $fileName = $file->getClientOriginalName();

        try {
            $apiKey = config('services.ocr_space.key');
            if (empty($apiKey)) {
                return response()->json([
                    'success' => false,
                    'message' => 'OCR Space API Key belum dikonfigurasi di server.'
                ], 500);
            }

            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 35,
            ])
            ->attach(
                'file',
                fopen($filePath, 'r'),
                $fileName,
                ['Content-Type' => $mimeType]
            )
            ->post('https://api.ocr.space/parse/image', [
                'apikey' => $apiKey,
                'language' => 'eng',
                'isTable' => 'true',
                'scale' => 'true',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['IsErroredOnProcessing']) && $data['IsErroredOnProcessing'] === true) {
                    $errorMessage = $data['ErrorMessage'][0] ?? 'Terjadi kesalahan saat memproses gambar.';
                    return response()->json([
                        'success' => false,
                        'message' => $errorMessage
                    ], 422);
                }

                $parsedText = $data['ParsedResults'][0]['ParsedText'] ?? '';
                if (empty($parsedText)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Teks tidak terdeteksi dari struk belanja ini.'
                    ], 422);
                }

                $total = $this->extractTotalFromText($parsedText);

                return response()->json([
                    'success' => true,
                    'total' => $total,
                    'parsed_text' => $parsedText
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungi server OCR.space (Status: ' . $response->status() . ').'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan internal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Smart helper to extract total transaction amount from Indonesian raw receipt text.
     */
    private function extractTotalFromText($text)
    {
        if (empty($text)) {
            return 0;
        }

        $lines = explode("\n", $text);
        $candidates = [];

        // Keywords hierarchy
        // Priority 1: Direct Grand Total indicators
        $p1 = '/\b(grand\s*total|total\s*belanja|total\s*bayar|total\s*tagihan|net\s*total)\b/i';
        // Priority 2: Standard Total indicators
        $p2 = '/\b(total|jumlah|netto|tagihan|amount)\b/i';
        // Priority 3: Fallback subtotals
        $p3 = '/\b(sub\s*total|subtotal)\b/i';

        // Negative keywords to avoid (e.g. payment details, change, discount)
        $negativePattern = '/\b(kembali|kembalian|cash|tunai|bayar|diskon|discount|potongan|ppn|tax|promo|debit|credit|card|kartu|kembalian\s*tunai)\b/i';

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            if (preg_match_all('/(?:rp\.?\s*)?([\d.,]+)/i', $line, $matches)) {
                foreach ($matches[1] as $numStr) {
                    $cleaned = $this->cleanAmountString($numStr);
                    if ($cleaned < 100 || $cleaned > 50000000) {
                        continue;
                    }

                    $priority = 0;
                    
                    if (preg_match($negativePattern, $line)) {
                        if (preg_match('/total\s*bayar/i', $line)) {
                            $priority = 4;
                        } else {
                            continue;
                        }
                    }

                    if ($priority === 0) {
                        if (preg_match($p1, $line)) {
                            $priority = 4;
                        } elseif (preg_match($p2, $line)) {
                            $priority = 3;
                        } elseif (preg_match($p3, $line)) {
                            $priority = 2;
                        }
                    }

                    if ($priority > 0) {
                        $candidates[] = [
                            'amount' => $cleaned,
                            'priority' => $priority,
                            'line' => $line
                        ];
                    }
                }
            }
        }

        if (!empty($candidates)) {
            usort($candidates, function($a, $b) {
                if ($a['priority'] !== $b['priority']) {
                    return $b['priority'] <=> $a['priority'];
                }
                return $b['amount'] <=> $a['amount'];
            });
            return $candidates[0]['amount'];
        }

        // Fallback: Max logic
        $allNumbers = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || preg_match($negativePattern, $line)) {
                continue;
            }
            
            // Skip lines that look like dates, phone numbers, or contain invoice/receipt metadata
            if (preg_match('/(\d{4}-\d{2}-\d{2}|\d{2}\/\d{2}\/\d{4}|\+?62\d{8,12})/i', $line)) {
                continue;
            }

            if (preg_match('/\b(inv|invoice|trx|trxid|transaksi|id|receipt|no|nomor|telp|telpon|phone|tgl|date|time|jam|merchant|terminal|batch|ref|approval)\b/i', $line)) {
                continue;
            }

            if (preg_match_all('/(?:rp\.?\s*)?([\d.,]+)/i', $line, $matches)) {
                foreach ($matches[1] as $numStr) {
                    $cleaned = $this->cleanAmountString($numStr);
                    if ($cleaned >= 500 && $cleaned <= 10000000) {
                        $allNumbers[] = $cleaned;
                    }
                }
            }
        }

        if (!empty($allNumbers)) {
            return max($allNumbers);
        }

        return 0;
    }

    /**
     * Helper to parse price string to clean integer.
     */
    private function cleanAmountString($numStr)
    {
        $numStr = preg_replace('/[^\d.,]/', '', $numStr);
        
        if (preg_match('/[.,]\d{2}$/', $numStr)) {
            $numStr = substr($numStr, 0, -3);
        }
        
        $numStr = str_replace([',', '.'], '', $numStr);
        
        return (int)$numStr;
    }
}
