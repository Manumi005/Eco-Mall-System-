<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

// User endpoint for authenticated users
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Customer registration and login
Route::post('/customer/register', [CustomerController::class, 'register']);
Route::post('/customer/login', [CustomerController::class, 'login']);

// Admin routes
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');
