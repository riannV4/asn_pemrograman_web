<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Auth::user()->transactions()
            ->with('category')
            ->latest('transaction_date')
            ->latest('created_at')
            ->get();
        
        return view('transactions.index', compact('transactions'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
            'input_method' => 'required|in:manual,voice,scan',
        ]);

        // Validasi kategori milik user
        if ($validated['category_id']) {
            $category = Auth::user()->categories()->find($validated['category_id']);
            if (!$category) {
                return back()->withErrors(['category_id' => 'Kategori tidak valid.'])->withInput();
            }
        }

        Auth::user()->transactions()->create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        // Pastikan transaksi milik user yang sedang login
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Auth::user()->categories()->orderBy('name')->get();
        
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Pastikan transaksi milik user yang sedang login
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
            'input_method' => 'required|in:manual,voice,scan',
        ]);

        // Validasi kategori milik user
        if ($validated['category_id']) {
            $category = Auth::user()->categories()->find($validated['category_id']);
            if (!$category) {
                return back()->withErrors(['category_id' => 'Kategori tidak valid.'])->withInput();
            }
        }

        $transaction->update($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // Pastikan transaksi milik user yang sedang login
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
