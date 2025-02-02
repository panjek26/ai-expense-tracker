<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AI Expense Tracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Add after Alpine.js script -->
    <script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 h-full">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-white w-64 min-h-screen shadow-lg">
            <div class="p-4 border-b">
                <div class="flex items-center justify-center">
                    <svg class="w-8 h-8 text-teal-600 mr-2" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="currentColor"/>
                        <path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="currentColor"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-800">ExpenseAI</span>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-teal-50 hover:text-teal-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <!-- Transactions Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2z"/>
                        </svg>
                        <span class="flex-1 text-left">Transactions</span>
                        <svg class="w-4 h-4 transform transition-transform duration-300 ease-in-out" 
                             :class="{'rotate-180': open}"
                             fill="none" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="transform opacity-0 -translate-y-2" 
                         x-transition:enter-end="transform opacity-100 translate-y-0" 
                         x-transition:leave="transition ease-in duration-200" 
                         x-transition:leave-start="transform opacity-100 translate-y-0" 
                         x-transition:leave-end="transform opacity-0 -translate-y-2" 
                         class="pl-14">
                        <a href="{{ route('transactions.income') }}" 
                           class="flex items-center py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                            </svg>
                            Income
                        </a>
                        <a href="{{ route('transactions.expense') }}" 
                           class="flex items-center py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                            </svg>
                            Expense
                        </a>
                    </div>
                </div>

                <a href="{{ route('budget') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-teal-50 hover:text-teal-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Budget
                </a>

                <!-- New Forecasting Menu -->
                <a href="{{ route('forecasting') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-teal-50 hover:text-teal-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Forecasting
                </a>

                <a href="{{ route('reports') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-teal-50 hover:text-teal-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Reports
                </a>
            </nav>

            <!-- User profile section -->
            <div class="absolute bottom-0 w-64 border-t">
                <div class="flex items-center p-4">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-gray-500 hover:text-teal-600">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('header')</h1>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>