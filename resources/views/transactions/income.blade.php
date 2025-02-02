@extends('layouts.dashboard')

@section('header')
    Add Income
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 bg-white">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Enter the details of your income transaction</h3>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('transactions') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            form="incomeForm"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-teal-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Income
                    </button>
                </div>
            </div>
        </div>

        <!-- Update the form ID -->
        <form id="incomeForm" action="{{ route('transactions.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <input type="hidden" name="type" value="income">
            
            <!-- Amount Field -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <span class="text-gray-500 sm:text-sm font-medium">Rp</span>
                        </div>
                        <input type="text" 
                               name="amount" 
                               id="amount" 
                               x-data
                               x-on:input="$el.value = $el.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                               class="block w-full rounded-md border-gray-300 pl-16 pr-4 py-2.5 focus:border-teal-500 focus:ring-teal-500 sm:text-sm text-right" 
                               placeholder="0"
                               required>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Enter amount without decimals or separators</p>
                </div>

                <!-- Date Field remains the same -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" 
                           name="date" 
                           id="date" 
                           class="block w-full px-4 py-3 border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" 
                           required>
                </div>
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <input type="text" 
                       name="description" 
                       id="description" 
                       class="block w-full px-4 py-3 border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" 
                       placeholder="e.g., Monthly Salary, Freelance Payment"
                       required>
            </div>

            <!-- Category Field -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" 
                        id="category" 
                        class="block w-full px-4 py-3 border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" 
                        required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Notes Field (Optional) -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                    Notes
                    <span class="text-gray-400 text-xs">(Optional)</span>
                </label>
                <textarea name="notes" 
                          id="notes" 
                          rows="3" 
                          class="block w-full px-4 py-3 border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" 
                          placeholder="Add any additional notes about this income"></textarea>
            </div>

            <!-- Form Actions -->
            <!-- Remove or comment out the bottom Form Actions section -->
            <!-- <div class="flex items-center justify-end space-x-4 pt-4 border-t"> ... </div> -->
        </form>
    </div>
</div>
@endsection