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
        $validated = $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2024',
            'budgets' => 'required|array'
        ]);

        $userId = auth()->id();

        foreach ($validated['budgets'] as $category => $amount) {
            $amount = str_replace('.', '', $amount);

            Budget::updateOrCreate(
                [
                    'user_id' => $userId,
                    'category' => $category,
                    'month' => $validated['month'],
                    'year' => $validated['year']
                ],
                ['amount' => $amount]
            );
        }

        return redirect()->route('budget')->with('success', 'Budget has been updated successfully!');
    }
}