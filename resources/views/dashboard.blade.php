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
    <!-- Introduction Card -->
    <div class="max-w-4xl mx-auto mb-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Hi, {{ Auth::user()->name }} 👋</h2>
                <p class="text-gray-600 mb-6">Here's what's happening with your money. Let's manage your expenses</p>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">AI Expense Tracker</h3>
                        <p class="mt-1 text-gray-600">
                            Welcome to your intelligent financial advisor! This application helps you make smarter financial decisions 
                            by tracking your expenses, managing your budget, and providing personalized recommendations.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ $transaction->type === 'expense' ? 'bg-red-100' : 'bg-green-100' }}">
                                            <span class="{{ $transaction->type === 'expense' ? 'text-red-600' : 'text-green-600' }} text-sm font-medium">
                                                {{ $transaction->type === 'expense' ? '-' : '+' }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $transaction->description }}</p>
                                        <p class="text-sm text-gray-500">{{ $transaction->transaction_date->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="{{ $transaction->type === 'expense' ? 'text-red-600' : 'text-green-600' }} text-sm font-semibold">
                                            {{ $transaction->type === 'expense' ? '-' : '+' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
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

    <!-- AI Financial Insights Section -->
    <div class="mt-12 mb-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-8">
                <div class="flex items-start space-x-6">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-teal-100 rounded-lg">
                            <svg class="h-8 w-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">AI Financial Insights</h3>
                        <div class="space-y-8">
                            <div class="prose prose-lg max-w-none text-gray-600">
                                {!! nl2br(e($aiRecommendations)) !!}
                            </div>
                            @if(isset($aiAnalysis))
                                <div class="mt-8 pt-8 border-t border-gray-200">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-4">Detailed Analysis</h4>
                                    <div class="prose prose-lg max-w-none text-gray-600">
                                        {!! nl2br(e($aiAnalysis)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection