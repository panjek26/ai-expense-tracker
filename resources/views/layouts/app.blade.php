<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI Expense Tracker</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Mobile Navigation -->
        <nav class="bg-white shadow-lg md:hidden">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">ExpenseAI</span>
                    </div>
                    <div class="flex items-center">
                        <button class="mobile-menu-button p-2">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <span class="text-xl font-bold">ExpenseAI</span>
                    </div>
                    <nav class="mt-5 flex-1 px-2 space-y-1">
                        <a href="/dashboard" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Dashboard
                        </a>
                        <a href="/transactions" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Transactions
                        </a>
                        <a href="/budget" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Budget
                        </a>
                        <a href="/reports" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            Reports
                        </a>
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile Menu -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t md:hidden">
        <div class="grid grid-cols-4 gap-1">
            <a href="/dashboard" class="flex flex-col items-center py-2">
                <span class="text-xs">Dashboard</span>
            </a>
            <a href="/transactions" class="flex flex-col items-center py-2">
                <span class="text-xs">Transactions</span>
            </a>
            <a href="/budget" class="flex flex-col items-center py-2">
                <span class="text-xs">Budget</span>
            </a>
            <a href="/reports" class="flex flex-col items-center py-2">
                <span class="text-xs">Reports</span>
            </a>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>
</html>