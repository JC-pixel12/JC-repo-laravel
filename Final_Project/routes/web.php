<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth'])->group(function() {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    Route::get('/record-sale', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/record-sale', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales-history', [SaleController::class, 'index'])->name('sales.index');
});