<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use App\Models\Budget;
use Illuminate\Support\Facades\DB;
use App\Services\FinancialAnalysisService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $financialAnalysisService;

    public function __construct(FinancialAnalysisService $financialAnalysisService)
    {
        $this->financialAnalysisService = $financialAnalysisService;
    }

    public function index()
    {
        $userId = auth()->id();
        $currentMonth = Carbon::now();

        // Get current month data only
        $totalIncome = Income::where('user_id', $userId)
            ->whereYear('transaction_date', $currentMonth->year)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->sum('amount');

        $totalExpenses = Expense::where('user_id', $userId)
            ->whereYear('transaction_date', $currentMonth->year)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->sum('amount');

        // Get current budgets and total budget
        $currentBudgets = Budget::where('user_id', $userId)
            ->where('month', $currentMonth->month)
            ->where('year', $currentMonth->year)
            ->pluck('amount', 'category')
            ->toArray();
            
        $totalBudget = array_sum($currentBudgets);
        $budgetCount = count($currentBudgets);

        // Get category expenses
        $categoryExpenses = Expense::where('user_id', $userId)
            ->whereYear('transaction_date', $currentMonth->year)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->select('category', \DB::raw('sum(amount) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        // Get expenses by categories
        $expensesByCategory = Expense::where('user_id', $userId)
            ->whereYear('transaction_date', $currentMonth->year)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->select('category', \DB::raw('sum(amount) as total'))
            ->groupBy('category')
            ->get();

        // Get income by categories
        $incomesByCategory = Income::where('user_id', $userId)
            ->whereYear('transaction_date', $currentMonth->year)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->select('category', \DB::raw('sum(amount) as total'))
            ->groupBy('category')
            ->get();

        // Get recent transactions
        $recentTransactions = Income::select(
                'description', 
                'amount', 
                'transaction_date',
                DB::raw("'income' as type")
            )
            ->where('user_id', $userId)
            ->whereYear('transaction_date', $currentMonth->year)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->union(
                Expense::select(
                    'description', 
                    'amount', 
                    'transaction_date',
                    DB::raw("'expense' as type")
                )
                ->where('user_id', $userId)
                ->whereYear('transaction_date', $currentMonth->year)
                ->whereMonth('transaction_date', $currentMonth->month)
            )
            ->orderBy('transaction_date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($transaction) {
                $transaction->transaction_date = Carbon::parse($transaction->transaction_date);
                return $transaction;
            });

        // Get AI recommendations and analysis
        $aiRecommendations = $this->financialAnalysisService->getFinancialRecommendations(
            $totalIncome,
            $totalExpenses,
            $currentBudgets,
            $categoryExpenses
        );

        $aiAnalysis = $this->financialAnalysisService->getFinancialAnalysis(
            $totalIncome,
            $totalExpenses,
            $currentBudgets,
            $categoryExpenses,
            $expensesByCategory
        );

        return view('dashboard', compact(
            'totalIncome',
            'totalExpenses',
            'totalBudget',
            'budgetCount',
            'recentTransactions',
            'incomesByCategory',
            'expensesByCategory',
            'aiRecommendations',
            'aiAnalysis'
        ));
    }
}