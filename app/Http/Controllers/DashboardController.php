<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        
        $balance = $totalIncome - $totalExpense;
        
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
        
        return view('dashboard', compact(
            'balance',
            'totalIncome',
            'totalExpense',
            'expenseTrend',
            'recentTransactions'
        ));
    }
}
