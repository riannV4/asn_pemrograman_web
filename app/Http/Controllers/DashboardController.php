<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Tanggal awal dan akhir bulan berjalan
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        // 1. Summary Cards - Total Income & Expense Bulan Ini
        $totalIncome = $user->transactions()
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->sum('amount');
        
        $totalExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $totalIncomeAll = $user->transactions()
            ->where('type', 'income')
            ->sum('amount');

        $totalExpenseAll = $user->transactions()
            ->where('type', 'expense')
            ->sum('amount');
        
        $balance = $totalIncomeAll - $totalExpenseAll;
        
        // 2. Grafik Tren Pengeluaran Per Minggu (Bulan Berjalan)
        $expenses = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
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
        
        // 4. Breakdown Pengeluaran per Kategori (Bulan Ini)
        $categoryBreakdown = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->with('category')
            ->get()
            ->groupBy('category_id')
            ->map(function ($transactions) {
                return [
                    'category_name' => $transactions->first()->category?->name ?? 'Uncategorized',
                    'total' => $transactions->sum('amount'),
                    'count' => $transactions->count()
                ];
            })
            ->sortByDesc('total')
            ->values();
        
        // 5. Trend Pengeluaran Harian (Last 7 Days)
        $dailyExpenses = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [Carbon::now()->subDays(7), Carbon::now()])
            ->get()
            ->groupBy(function ($transaction) {
                return Carbon::parse($transaction->transaction_date)->format('Y-m-d');
            })
            ->map(function ($transactions) {
                return $transactions->sum('amount');
            });
        
        // Pastikan semua 7 hari ada
        $dailyTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dailyTrend[] = [
                'date' => Carbon::parse($date)->format('d M'),
                'amount' => $dailyExpenses[$date] ?? 0
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
    
    /**
     * Generate random colors for charts
     */
    private function generateColors($count)
    {
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
            '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384',
            '#36A2EB', '#FFCE56', '#FF9F40', '#C9CBCF', '#4BC0C0'
        ];
        
        return array_slice($colors, 0, $count);
    }
}
