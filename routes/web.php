<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;

// Landing page route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes for regular users using Jetstream authentication
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin routes group
Route::prefix('admin')->as('admin.')->group(function () {

    // Admin login & registration routes (accessible to non-authenticated admins)
    Route::middleware('guest:admin')->group(function () {
        Route::view('/login', 'admin.login')->name('login');
        Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

        Route::view('/register', 'admin.register')->name('register');
        Route::post('/register', [AdminController::class, 'register'])->name('register.submit');
    });

    // Admin authenticated routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Customer management routes
        Route::prefix('customers')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
            Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
            Route::get('/{customer}', [CustomerController::class, 'show'])->name('customers.show');
            Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
            Route::put('/{customer}', [CustomerController::class, 'update'])->name('customers.update');
            Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        });

        // Supplier management routes
        Route::prefix('suppliers')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
            Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
            Route::post('/', [SupplierController::class, 'store'])->name('suppliers.store');
            Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
            Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
            Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
        });
    });
});

// Supplier routes group
Route::prefix('supplier')->as('supplier.')->group(function () {

    // Supplier login & registration routes (accessible to non-authenticated suppliers)
    Route::middleware('guest:supplier')->group(function () {
        Route::view('/login', 'supplier.login')->name('login');
        Route::post('/login', [SupplierController::class, 'login'])->name('login.submit');

        Route::view('/register', 'supplier.register')->name('register');
        Route::post('/register', [SupplierController::class, 'register'])->name('register.submit');
    });

    // Supplier authenticated routes
    Route::middleware(['auth:supplier'])->group(function () {
        Route::get('/dashboard', function () {
            return view('supplier.dashboard');
        })->name('dashboard');
    });
});

