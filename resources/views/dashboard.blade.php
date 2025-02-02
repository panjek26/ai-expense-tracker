@extends('layouts.dashboard')

@section('header')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Financial Overview</h1>
        <div class="flex space-x-3">
            <a href="{{ route('transactions.income') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Income
            </a>
            <a href="{{ route('transactions.expense') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Expense
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Income Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-xl transition-all hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Income</dt>
                            <dd class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalIncome, 0, ',', '.') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Budget Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-xl transition-all hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Budget</dt>
                            <dd class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalBudget, 0, ',', '.') }}</dd>
                            <dt class="mt-1 text-sm text-gray-500">{{ $budgetCount }} Categories</dt>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Expenses Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-xl transition-all hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-red-100 rounded-lg">
                        <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Expenses</dt>
                            <dd class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar updates for other stat cards... -->

    </div>

    <!-- Main Content Grid -->
    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Transactions -->
        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Transactions</h3>
                <div class="flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-100">
                        @forelse($recentTransactions as $transaction)
                            <li class="py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ $transaction instanceof \App\Models\Expense ? 'bg-red-100' : 'bg-green-100' }}">
                                            <span class="{{ $transaction instanceof \App\Models\Expense ? 'text-red-600' : 'text-green-600' }} text-sm font-medium">
                                                {{ $transaction instanceof \App\Models\Expense ? '-' : '+' }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $transaction->description }}</p>
                                        <p class="text-sm text-gray-500">{{ $transaction->transaction_date->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="{{ $transaction instanceof \App\Models\Expense ? 'text-red-600' : 'text-green-600' }} text-sm font-semibold">
                                            {{ $transaction instanceof \App\Models\Expense ? '-' : '+' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-4">
                                <div class="text-center text-gray-500">No recent transactions</div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Categories Summary -->
        <div class="space-y-6">
            <!-- Income Categories -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Income by Category</h3>
                    <div class="flow-root">
                        <ul role="list" class="-my-5 divide-y divide-gray-100">
                            @forelse($incomesByCategory as $category)
                                <li class="py-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">{{ ucfirst($category->category) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-green-600 text-sm font-semibold">
                                                Rp {{ number_format($category->total, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4">
                                    <div class="text-center text-gray-500">No income recorded</div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Expense Categories -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Expenses by Category</h3>
                    <div class="flow-root">
                        <ul role="list" class="-my-5 divide-y divide-gray-100">
                            @forelse($expensesByCategory as $category)
                                <li class="py-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">{{ ucfirst($category->category) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-red-600 text-sm font-semibold">
                                                Rp {{ number_format($category->total, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4">
                                    <div class="text-center text-gray-500">No expenses recorded</div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection