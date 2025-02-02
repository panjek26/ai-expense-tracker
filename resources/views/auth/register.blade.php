@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="text-primary fw-bold mb-2">Create Account</h3>
                        <p class="text-muted">Get started with your free account</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-person text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Full Name" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-primary"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Email Address" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock text-primary"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                       id="password" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock-fill text-primary"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 ps-0"
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                            <i class="bi bi-person-plus me-2"></i>Create Account
                        </button>

                        <p class="text-center text-muted mb-0">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none">Sign In</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection