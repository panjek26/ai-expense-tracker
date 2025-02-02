<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BudgetController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $currentMonth = Carbon::now();

        // Get expense categories
        $expenseCategories = ExpenseCategory::orderBy('name')->get();

        // Get current budgets
        $currentBudgets = Budget::where('user_id', $userId)
            ->where('month', $currentMonth->month)
            ->where('year', $currentMonth->year)
            ->pluck('amount', 'category')
            ->toArray();

        // Get monthly totals
        $monthlyIncome = Income::where('user_id', $userId)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->sum('amount');

        $monthlyExpenses = Expense::where('user_id', $userId)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->sum('amount');

        // Get category expenses
        $categoryExpenses = Expense::where('user_id', $userId)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->select('category', \DB::raw('sum(amount) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        return view('budget.index', compact(
            'monthlyIncome',
            'monthlyExpenses',
            'expenseCategories',
            'currentBudgets',
            'categoryExpenses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2024',
            'budgets' => 'required|array',
            'budgets.*' => 'nullable|string',
        ]);
    
        foreach ($request->budgets as $category => $amount) {
            // Skip if amount is empty or only contains dots/commas
            if (empty($amount) || $amount === '0') {
                continue;
            }
    
            // Clean the amount string (remove dots and convert to integer)
            $cleanAmount = (int) str_replace('.', '', $amount);
    
            Budget::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'category' => $category,
                    'month' => $request->month,
                    'year' => $request->year,
                ],
                [
                    'amount' => $cleanAmount
                ]
            );
        }
    
        return redirect()->back()->with('success', 'Budget has been saved successfully.');
    }
}