<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $incomes = Income::where('user_id', auth()->id())
                        ->orderBy('transaction_date', 'desc')
                        ->get();

        return view('transactions.index', compact('incomes'));
    }

    public function income()
    {
        $categories = IncomeCategory::orderBy('name')->get();
        return view('transactions.income', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income',
            'amount' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Get category ID
        $category = IncomeCategory::where('slug', $validated['category'])->firstOrFail();

        // Clean amount (remove dots)
        $amount = str_replace('.', '', $validated['amount']);

        // Create income record
        Income::create([
            'user_id' => auth()->id(),
            'income_category_id' => $category->id,
            'amount' => $amount,
            'transaction_date' => $validated['date'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'notes' => $validated['notes']
        ]);

        return redirect()
            ->route('transactions')
            ->with('success', 'Income has been recorded successfully!');
    }
}