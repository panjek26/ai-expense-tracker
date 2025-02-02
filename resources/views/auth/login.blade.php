@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="text-center mb-8">
            <!-- Finance Logo -->
            <div class="mb-6">
                <svg class="w-16 h-16 mx-auto text-teal-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z" fill="currentColor"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">AI Expense Tracker</h1>
            <p class="text-sm text-gray-500">Smart financial management powered by AI</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-md mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </span>
                        </div>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="block w-full rounded-md border-gray-300 pl-10 focus:border-teal-500 focus:ring-teal-500 sm:text-sm" 
                               placeholder="Enter your email"
                               required 
                               autofocus>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="block w-full rounded-md border-gray-300 pl-10 focus:border-teal-500 focus:ring-teal-500 sm:text-sm" 
                               placeholder="Enter your password"
                               required>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" 
                               class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50" 
                               id="show-password">
                        <span class="ml-2 text-sm text-gray-600">Show Password</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary group relative">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-teal-500 group-hover:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </span>
                    Sign In
                </button>

                <div class="text-center space-y-2 text-sm">
                    <p class="text-gray-600">
                        Forgot 
                        <a href="{{ route('password.request') }}" class="link font-medium">
                            Username / Password
                        </a>?
                    </p>
                    <p class="text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="link font-medium">
                            Sign up
                        </a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('show-password').addEventListener('change', function() {
    var passwordInput = document.getElementById('password');
    passwordInput.type = this.checked ? 'text' : 'password';
});
</script>
@endsection