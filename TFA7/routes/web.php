<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/customers',            [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/new',        [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers',           [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}/edit',  [CustomerController::class, 'edit'])
    ->whereNumber('id')
    ->name('customers.edit');
Route::put('/customers/{id}',       [CustomerController::class, 'update'])
    ->whereNumber('id')
    ->name('customers.update');


Route::get('/users',                [UserController::class, 'index'])->name('users.index');
Route::get('/users/new',            [UserController::class, 'create'])->name('users.create');
Route::post('/users',               [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit',      [UserController::class, 'edit'])
    ->whereNumber('id')
    ->name('users.edit');
Route::put('/users/{id}',           [UserController::class, 'update'])
    ->whereNumber('id')
    ->name('users.update');