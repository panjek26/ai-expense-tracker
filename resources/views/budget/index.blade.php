@extends('layouts.dashboard')

@section('header')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Budget Planning</h1>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Monthly Overview -->
    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-3">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-6">
                <h3 class="text-sm font-medium text-gray-500">Monthly Income</h3>
                <p class="mt-2 text-2xl font-semibold text-green-600">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-6">
                <h3 class="text-sm font-medium text-gray-500">Monthly Expenses</h3>
                <p class="mt-2 text-2xl font-semibold text-red-600">Rp {{ number_format($monthlyExpenses, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl">
            <div class="p-6">
                <h3 class="text-sm font-medium text-gray-500">Remaining Budget</h3>
                <p class="mt-2 text-2xl font-semibold {{ ($monthlyIncome - $monthlyExpenses) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    Rp {{ number_format($monthlyIncome - $monthlyExpenses, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Budget Form -->
    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900">Set Monthly Budget</h3>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            form="budgetForm"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-teal-700"
                            onclick="clearInputsAfterSubmit()">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Budget
                    </button>
                </div>
            </div>
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form id="budgetForm" action="{{ route('budget.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <!-- Month and Year Selection -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                            <select name="month" id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ date('n') == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                            <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                @foreach(range(date('Y'), date('Y')+5) as $year)
                                    <option value="{{ $year }}" {{ date('Y') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Category Budget Inputs -->
                    <div class="space-y-4">
                        @foreach($expenseCategories as $category)
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center p-4 rounded-lg {{ isset($categoryExpenses[$category->slug]) ? 'bg-gray-50' : '' }}">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ ucfirst($category->name) }}</label>
                                    @if(isset($categoryExpenses[$category->slug]))
                                        <p class="text-sm text-gray-500">Current spending: Rp {{ number_format($categoryExpenses[$category->slug], 0, ',', '.') }}</p>
                                    @endif
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="flex items-center">
                                        <span class="text-gray-500 mr-2">Rp</span>
                                        <input type="text" 
                                               name="budgets[{{ $category->slug }}]" 
                                               value="{{ old('budgets.' . $category->slug, isset($currentBudgets[$category->slug]) ? number_format($currentBudgets[$category->slug], 0, ',', '.') : '') }}"
                                               class="block w-full px-4 py-2 rounded-md border-gray-300 focus:ring-teal-500 focus:border-teal-500"
                                               placeholder="0"
                                               x-data
                                               x-on:input="$el.value = $el.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Remove the bottom buttons div -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function clearInputsAfterSubmit() {
    setTimeout(() => {
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.value = '';
        });
    }, 100);
}
</script>
@endsection