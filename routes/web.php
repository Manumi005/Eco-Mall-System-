<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;  

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
    // Admin login & registration routes (for non-authenticated admins)
    Route::middleware('guest:admin')->group(function () {
        Route::view('/login', 'admin.login')->name('login');
        Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

        Route::view('/register', 'admin.register')->name('register');
        Route::post('/register', [AdminController::class, 'register'])->name('register.submit');
    });

    // Admin authenticated routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Customer management routes (Admin)
        Route::resource('customers', CustomerController::class);

        // Supplier management routes (Admin)
        Route::resource('suppliers', SupplierController::class);

        // Product management routes (Admin)
        Route::resource('products', ProductController::class);

        // Order management routes (Admin)
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::put('/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        });
    });
});

// Supplier routes group
Route::prefix('supplier')->as('supplier.')->group(function () {
    // Supplier login & registration routes (for non-authenticated suppliers)
    Route::middleware('guest:supplier')->group(function () {
        Route::view('/login', 'supplier.login')->name('login');
        Route::post('/login', [SupplierController::class, 'login'])->name('login.submit');

        Route::view('/register', 'supplier.register')->name('register');
        Route::post('/register', [SupplierController::class, 'register'])->name('register.submit');
    });

    // Supplier authenticated routes
    Route::middleware(['auth:supplier'])->group(function () {
        Route::get('/dashboard', [SupplierController::class, 'dashboard'])->name('dashboard');

        // Supplier-specific product management
        Route::resource('products', ProductController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

        // Supplier-specific order management
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'supplierOrders'])->name('orders.index');
            Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::put('/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        });

        // Supplier logout route
        Route::post('/logout', [SupplierController::class, 'logout'])->name('logout');
    });
});

// Customer routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('customer')->as('customer.')->group(function () {
        Route::get('/products', [CustomerController::class, 'index'])->name('products.index');
        Route::get('/orders', [CustomerController::class, 'ordersIndex'])->name('orders.index'); // List all orders
        Route::get('/orders/{order}', [CustomerController::class, 'ordersShow'])->name('orders.show'); // View a specific order
    });
});


