<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // 1. Tentukan Filter Period
        $filterType = $request->input('filter', 'monthly'); // weekly, monthly, custom
        $startDate = null;
        $endDate = null;
        
        switch ($filterType) {
            case 'weekly':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
                
            case 'monthly':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
                
            case 'custom':
                $startDate = $request->input('start_date') 
                    ? Carbon::parse($request->input('start_date')) 
                    : Carbon::now()->startOfMonth();
                $endDate = $request->input('end_date') 
                    ? Carbon::parse($request->input('end_date')) 
                    : Carbon::now()->endOfMonth();
                break;
                
            default:
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
        }
        
        // 2. Summary Data
        $totalIncome = $user->transactions()
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');
        
        $totalExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');
        
        $balance = $totalIncome - $totalExpense;
        
        // 3. Transaction List (dengan filter)
        $transactions = $user->transactions()
            ->with('category')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->latest('transaction_date')
            ->latest('created_at')
            ->get();
        
        // 4. Pie Chart Data - Komposisi Pengeluaran per Kategori
        $expenseByCategory = $user->transactions()
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->whereNotNull('category_id')
            ->with('category')
            ->groupBy('category_id')
            ->get();
        
        // Format untuk Chart.js Pie Chart
        $pieChartData = [
            'labels' => [],
            'data' => []
        ];
        
        foreach ($expenseByCategory as $item) {
            $pieChartData['labels'][] = $item->category ? $item->category->name : 'Tanpa Kategori';
            $pieChartData['data'][] = (float) $item->total;
        }
        
        // 5. Bar Chart Data - Income vs Expense per Bulan (Tahun Berjalan)
        $currentYear = Carbon::now()->year;
        $monthlyData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $monthStart = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $monthEnd = Carbon::create($currentYear, $month, 1)->endOfMonth();
            
            $monthlyIncome = $user->transactions()
                ->where('type', 'income')
                ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                ->sum('amount');
            
            $monthlyExpense = $user->transactions()
                ->where('type', 'expense')
                ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                ->sum('amount');
            
            $monthlyData[] = [
                'month' => Carbon::create($currentYear, $month, 1)->format('M'),
                'income' => (float) $monthlyIncome,
                'expense' => (float) $monthlyExpense
            ];
        }
        
        // Format untuk Chart.js Bar Chart
        $barChartData = [
            'labels' => array_column($monthlyData, 'month'),
            'income' => array_column($monthlyData, 'income'),
            'expense' => array_column($monthlyData, 'expense')
        ];
        
        // 6. Daily Expense Trend (pada periode yang dipilih)
        $dailyExpenses = $user->transactions()
            ->select(DB::raw('DATE(transaction_date) as date'), DB::raw('SUM(amount) as total'))
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Format untuk Chart.js Line Chart
        $dailyExpenseTrend = [
            'labels' => [],
            'data' => []
        ];
        
        foreach ($dailyExpenses as $daily) {
            $dailyExpenseTrend['labels'][] = Carbon::parse($daily->date)->format('d M');
            $dailyExpenseTrend['data'][] = (float) $daily->total;
        }
        
        return view('reports', compact(
            'filterType',
            'startDate',
            'endDate',
            'totalIncome',
            'totalExpense',
            'balance',
            'transactions',
            'pieChartData',
            'barChartData',
            'dailyExpenseTrend'
        ));
    }
}
