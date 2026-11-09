<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

Route::get('/', [TaskController::class, 'welcome'])->name('welcome');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/about', [PageController::class, 'about'])->name('about');