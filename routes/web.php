<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ForecastingController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;

// Authentication Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('/transactions/income', [TransactionController::class, 'income'])->name('transactions.income');
    Route::get('/transactions/expense', [TransactionController::class, 'expense'])->name('transactions.expense');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Add Budget route
    Route::get('/budget', [BudgetController::class, 'index'])->name('budget');
    Route::get('/forecasting', [ForecastingController::class, 'index'])->name('forecasting');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::post('/budget', [BudgetController::class, 'store'])->name('budget.store');
});
