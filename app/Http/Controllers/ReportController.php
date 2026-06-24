<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Traits\HasChartColors;

class ReportController extends Controller
{
    use HasChartColors;
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
        
        // Calculate previous period for trend comparison
        $periodDays = $endDate->diffInDays($startDate);
        $previousStartDate = (clone $startDate)->subDays($periodDays + 1);
        $previousEndDate = (clone $startDate)->subDay();
        
        $previousIncome = $user->transactions()
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$previousStartDate, $previousEndDate])
            ->sum('amount');
        
        $previousExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$previousStartDate, $previousEndDate])
            ->sum('amount');
        
        // Calculate trend (positive = increase, negative = decrease)
        $incomeTrend = $previousIncome > 0 ? (($totalIncome - $previousIncome) / $previousIncome) * 100 : 0;
        $expenseTrend = $previousExpense > 0 ? (($totalExpense - $previousExpense) / $previousExpense) * 100 : 0;
        
        // Format month display for current period
        $monthDisplay = $startDate->format('M');
        if ($startDate->month !== $endDate->month) {
            $monthDisplay = $startDate->format('M') . ' - ' . $endDate->format('M');
        }
        
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
        
        // 5. Bar Chart Data - Income vs Expense per 4 Minggu (Weekly comparison)
        // Split the period into 4 weeks
        $weeklyData = [];
        $periodDays = $endDate->diffInDays($startDate) + 1;
        $daysPerWeek = ceil($periodDays / 4);
        
        for ($week = 1; $week <= 4; $week++) {
            $weekStart = (clone $startDate)->addDays(($week - 1) * $daysPerWeek);
            $weekEnd = (clone $weekStart)->addDays($daysPerWeek - 1);
            
            // Ensure we don't go beyond the selected end date
            if ($weekEnd > $endDate) {
                $weekEnd = $endDate;
            }
            
            if ($weekStart <= $endDate) {
                $weeklyIncome = $user->transactions()
                    ->where('type', 'income')
                    ->whereBetween('transaction_date', [$weekStart, $weekEnd])
                    ->sum('amount');
                
                $weeklyExpense = $user->transactions()
                    ->where('type', 'expense')
                    ->whereBetween('transaction_date', [$weekStart, $weekEnd])
                    ->sum('amount');
            } else {
                $weeklyIncome = 0;
                $weeklyExpense = 0;
            }
            
            $weeklyData[] = [
                'week' => "Minggu $week",
                'income' => (float) $weeklyIncome,
                'expense' => (float) $weeklyExpense
            ];
        }
        
        // Format untuk Chart.js Bar Chart
        $barChartData = [
            'labels' => array_column($weeklyData, 'week'),
            'income' => array_column($weeklyData, 'income'),
            'expense' => array_column($weeklyData, 'expense')
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
            'monthDisplay',
            'totalIncome',
            'totalExpense',
            'balance',
            'incomeTrend',
            'expenseTrend',
            'transactions',
            'pieChartData',
            'barChartData',
            'dailyExpenseTrend'
        ));
    }


}
