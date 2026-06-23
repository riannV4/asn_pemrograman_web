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
            'data' => [],
            'colors' => []
        ];

        foreach ($expenseByCategory as $item) {
            $pieChartData['labels'][] = $item->category ? $item->category->name : 'Tanpa Kategori';
            $pieChartData['data'][] = (float) $item->total;
        }

        $pieChartData['colors'] = $this->generateColors(count($pieChartData['labels']));
        
        // 5. Bar Chart Data - Income vs Expense per Bulan (Tahun Berjalan)
        // Filter: Only include transactions within user's selected date range
        $currentYear = Carbon::now()->year;
        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthStart = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $monthEnd = Carbon::create($currentYear, $month, 1)->endOfMonth();

            // Calculate intersection of month with user's selected date range
            $rangeStart = max($monthStart, $startDate);
            $rangeEnd = min($monthEnd, $endDate);

            // Only query if there's an overlap between month and selected range
            if ($rangeStart <= $rangeEnd) {
                $monthlyIncome = $user->transactions()
                    ->where('type', 'income')
                    ->whereBetween('transaction_date', [$rangeStart, $rangeEnd])
                    ->sum('amount');

                $monthlyExpense = $user->transactions()
                    ->where('type', 'expense')
                    ->whereBetween('transaction_date', [$rangeStart, $rangeEnd])
                    ->sum('amount');
            } else {
                $monthlyIncome = 0;
                $monthlyExpense = 0;
            }

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
