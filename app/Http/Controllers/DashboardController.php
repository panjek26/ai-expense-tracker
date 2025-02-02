<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use App\Models\Budget;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $currentMonth = now();
    
        // Get total expenses
        $totalExpenses = Expense::where('user_id', $userId)->sum('amount');
    
        // Get total income
        $totalIncome = Income::where('user_id', $userId)->sum('amount');
    
        // Get total budget and count
        $totalBudget = Budget::where('user_id', $userId)
            ->where('month', $currentMonth->month)
            ->where('year', $currentMonth->year)
            ->sum('amount');
        
        $budgetCount = Budget::where('user_id', $userId)
            ->where('month', $currentMonth->month)
            ->where('year', $currentMonth->year)
            ->count();
    
        // Calculate savings
        $savings = $totalIncome - $totalExpenses;

        // Get expense categories count
        $categoriesCount = ExpenseCategory::count();

        // Get recent transactions (both income and expenses)
        $recentIncomes = Income::where('user_id', $userId)
            ->select('id', 'description', 'amount', 'transaction_date')
            ->get();
        
        $recentExpenses = Expense::where('user_id', $userId)
            ->select('id', 'description', 'amount', 'transaction_date')
            ->get();

        $recentTransactions = $recentIncomes->concat($recentExpenses)
            ->sortByDesc('transaction_date')
            ->take(5);

        // Get expense and income by categories
        $expensesByCategory = Expense::where('user_id', $userId)
            ->select('category', DB::raw('sum(amount) as total'))
            ->groupBy('category')
            ->get();

        $incomesByCategory = Income::where('user_id', $userId)
            ->select('category', DB::raw('sum(amount) as total'))
            ->groupBy('category')
            ->get();

        // Update categories count to include both types
        $categoriesCount = ExpenseCategory::count() + IncomeCategory::count();

        return view('dashboard', compact(
            'totalExpenses',
            'totalIncome',
            'savings',
            'totalBudget',
            'budgetCount',
            'categoriesCount',
            'recentTransactions',
            'expensesByCategory',
            'incomesByCategory'
        ));
    }
}