<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Traits\HasChartColors;

class DashboardController extends Controller
{
    use HasChartColors;

    public function index()
    {
        $user = Auth::user();
        
        // Tanggal awal dan akhir bulan berjalan
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        // 1. Summary Cards - Total Income & Expense Bulan Ini (aggregated in 1 query)
        $monthlySums = $user->transactions()
            ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income")
            ->selectRaw("SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense")
            ->whereBetween('transaction_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->first();
        
        $totalIncome = $monthlySums->income ?? 0;
        $totalExpense = $monthlySums->expense ?? 0;

        // Total Income & Expense All Time (aggregated in 1 query)
        $allTimeSums = $user->transactions()
            ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income")
            ->selectRaw("SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense")
            ->first();

        $totalIncomeAll = $allTimeSums->income ?? 0;
        $totalExpenseAll = $allTimeSums->expense ?? 0;
        
        $balance = $totalIncomeAll - $totalExpenseAll;
        
        // 2. Grafik Tren Pengeluaran Per Minggu (Bulan Berjalan) - optimized select
        $expenses = $user->transactions()
            ->select('transaction_date', 'amount')
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->get();
        
        // Kelompokkan pengeluaran berdasarkan minggu
        $expenseTrend = [];
        $weeklyExpenses = [];
        
        foreach ($expenses as $expense) {
            $transactionDate = Carbon::parse($expense->transaction_date);
            $weekNumber = $transactionDate->weekOfMonth;
            
            if (!isset($weeklyExpenses[$weekNumber])) {
                $weeklyExpenses[$weekNumber] = 0;
            }
            
            $weeklyExpenses[$weekNumber] += $expense->amount;
        }
        
        // Format data untuk Chart.js
        // Pastikan semua minggu ada (1-5) dengan nilai 0 jika tidak ada transaksi
        for ($week = 1; $week <= 5; $week++) {
            $expenseTrend[] = [
                'week' => "Minggu $week",
                'amount' => $weeklyExpenses[$week] ?? 0
            ];
        }
        
        // 3. Daftar 5 Transaksi Terakhir
        $recentTransactions = $user->transactions()
            ->with('category')
            ->latest('transaction_date')
            ->latest('created_at')
            ->limit(5)
            ->get();
        
        // 4. Breakdown Pengeluaran per Kategori (Bulan Ini) - fully aggregated in DB to prevent N+1 and PHP memory overhead
        $categoryBreakdown = $user->transactions()
            ->selectRaw('category_id, SUM(amount) as total, COUNT(*) as count')
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(function ($item) {
                return [
                    'category_name' => $item->category?->name ?? 'Tanpa Kategori',
                    'total' => (float) $item->total,
                    'count' => (int) $item->count
                ];
            })
            ->sortByDesc('total')
            ->values();
        
        // 5. Trend Pengeluaran Harian (Last 7 Days) - aggregated in DB
        $dailyExpenses = $user->transactions()
            ->selectRaw('transaction_date, SUM(amount) as total')
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [Carbon::now()->subDays(6)->toDateString(), Carbon::now()->toDateString()])
            ->groupBy('transaction_date')
            ->get()
            ->pluck('total', 'transaction_date')
            ->toArray();
        
        // Pastikan semua 7 hari ada
        $dailyTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $formattedDate = Carbon::parse($date)->format('d M');
            
            $amount = 0;
            foreach ($dailyExpenses as $dbDate => $total) {
                if (Carbon::parse($dbDate)->toDateString() === $date) {
                    $amount = (float) $total;
                    break;
                }
            }
            
            $dailyTrend[] = [
                'date' => $formattedDate,
                'amount' => $amount
            ];
        }
        
        // 6. Top 5 Categories by Expense
        $topCategories = $categoryBreakdown->take(5);
        
        // 7. Prepare Chart Data (JSON format)
        $categoryChartData = [
            'labels' => $categoryBreakdown->pluck('category_name')->toArray(),
            'data' => $categoryBreakdown->pluck('total')->toArray(),
            'colors' => $this->generateColors(count($categoryBreakdown))
        ];
        
        $trendChartData = [
            'labels' => collect($dailyTrend)->pluck('date')->toArray(),
            'data' => collect($dailyTrend)->pluck('amount')->toArray()
        ];
        
        return view('dashboard', compact(
            'balance',
            'totalIncome',
            'totalExpense',
            'expenseTrend',
            'recentTransactions',
            'categoryBreakdown',
            'topCategories',
            'categoryChartData',
            'trendChartData',
            'dailyTrend'
        ));
    }
}
