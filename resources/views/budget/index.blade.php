@extends('layouts.dashboard')

@section('header')
    Budget Management
@endsection

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Monthly Budget</h2>
        <button class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Set Budget
        </button>
    </div>

    <!-- Placeholder for budget content -->
    <div class="space-y-6">
        <div class="border rounded-lg p-4">
            <h3 class="text-lg font-medium text-gray-900">Current Month's Budget</h3>
            <p class="text-3xl font-bold text-teal-600 mt-2">Rp 5,000,000</p>
        </div>
    </div>
</div>
@endsection