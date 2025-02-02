@extends('layouts.dashboard')

@section('header')
    Add Expense
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="expense">
            
            <div class="space-y-4">
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount (Rp)</label>
                    <input type="number" name="amount" id="amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                        <option value="food">Food & Drinks</option>
                        <option value="transportation">Transportation</option>
                        <option value="utilities">Utilities</option>
                        <option value="shopping">Shopping</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="health">Health</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('transactions') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        Add Expense
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection