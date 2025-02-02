<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $incomes = Income::where('user_id', auth()->id())->get();
        $expenses = Expense::where('user_id', auth()->id())->get();
        
        $transactions = $incomes->concat($expenses)
            ->sortByDesc('transaction_date');

        return view('transactions.index', compact('transactions', 'incomes', 'expenses'));
    }

    public function income()
    {
        $categories = IncomeCategory::orderBy('name')->get();
        return view('transactions.income', compact('categories'));
    }

    public function expense()
        {
            $categories = ExpenseCategory::orderBy('name')->get();
            return view('transactions.expense', compact('categories'));
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Clean amount (remove dots)
        $amount = str_replace('.', '', $validated['amount']);

        if ($validated['type'] === 'income') {
            $category = IncomeCategory::where('slug', $validated['category'])->firstOrFail();
            
            Income::create([
                'user_id' => auth()->id(),
                'income_category_id' => $category->id,
                'amount' => $amount,
                'transaction_date' => $validated['date'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'notes' => $validated['notes']
            ]);
        } else {
            $category = ExpenseCategory::where('slug', $validated['category'])->firstOrFail();
            
            Expense::create([
                'user_id' => auth()->id(),
                'expense_category_id' => $category->id,
                'amount' => $amount,
                'transaction_date' => $validated['date'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'notes' => $validated['notes']
            ]);
        }

        $type = ucfirst($validated['type']);
        return redirect()
            ->route('transactions')
            ->with('success', "$type has been recorded successfully!");
    }
}