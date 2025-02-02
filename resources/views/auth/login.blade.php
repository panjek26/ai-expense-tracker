@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="text-center mb-8">
            <svg class="w-12 h-12 mx-auto mb-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM17 16H7a2 2 0 01-2-2V8m14 0v6a2 2 0 01-2 2h-2"></path>
            </svg>
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
                    <label for="email" class="form-label">Email</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" 
                               class="form-input pl-10" 
                               id="email"
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email">
                    </div>
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" 
                               class="form-input pl-10" 
                               id="password"
                               name="password" 
                               placeholder="Enter your password">
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