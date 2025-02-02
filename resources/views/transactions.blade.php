@extends('layouts.dashboard')

@section('header')
    Transactions
@endsection

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">All Transactions</h2>
        <div class="flex space-x-3">
            <a href="{{ route('transactions.income') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Income
            </a>
            <a href="{{ route('transactions.expense') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Expense
            </a>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Sample transaction row -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-02-02</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Grocery Shopping</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Food</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Expense
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">-Rp 150.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-teal-600 hover:text-teal-900 mr-3">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection