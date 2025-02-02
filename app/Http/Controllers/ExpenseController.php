<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())
                        ->orderBy('transaction_date', 'desc')
                        ->get();

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = ExpenseCategory::orderBy('name')->get();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Get category ID
        $category = ExpenseCategory::where('slug', $validated['category'])->firstOrFail();

        // Clean amount (remove dots)
        $amount = str_replace('.', '', $validated['amount']);

        // Create expense record
        Expense::create([
            'user_id' => auth()->id(),
            'expense_category_id' => $category->id,
            'amount' => $amount,
            'transaction_date' => $validated['date'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'notes' => $validated['notes']
        ]);

        return redirect()
            ->route('transactions')
            ->with('success', 'Expense has been recorded successfully!');
    }
}