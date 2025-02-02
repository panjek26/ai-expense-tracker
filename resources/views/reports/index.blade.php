@extends('layouts.dashboard')

@section('header')
    Financial Reports
@endsection

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Financial Reports</h2>
        <div class="flex space-x-3">
            <button class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export Report
            </button>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Monthly Summary -->
        <div class="border rounded-lg p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Summary</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="text-sm text-green-600">Total Income</p>
                    <p class="text-2xl font-bold text-green-700">Rp 8,000,000</p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <p class="text-sm text-red-600">Total Expenses</p>
                    <p class="text-2xl font-bold text-red-700">Rp 5,345,000</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-sm text-blue-600">Net Savings</p>
                    <p class="text-2xl font-bold text-blue-700">Rp 2,655,000</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection