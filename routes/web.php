<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

// Default Route
Route::get('/', [LoginController::class, 'showLoginForm']);

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout Route
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Home Route
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Profile Route
Route::get('profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');


// ----- Lists Routes -----
Route::prefix('lists')->middleware('auth')->group(function () {

    Route::get('/', [ListsController::class, 'index'])->name('lists.index');
    Route::get('/create', [ListsController::class, 'create'])->name('lists.create');
    Route::post('/', [ListsController::class, 'store'])->name('lists.store');
    Route::get('/{list}', [ListsController::class, 'show'])->name('lists.show');
    Route::get('/{list}/edit', [ListsController::class, 'edit'])->name('lists.edit');
    Route::put('/{list}', [ListsController::class, 'update'])->name('lists.update');
    Route::delete('/{list}', [ListsController::class, 'destroy'])->name('lists.destroy');

    // Nested task creation under a specific list
    Route::get('/{list}/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
});

// ----- Tasks Routes -----
Route::prefix('tasks')->middleware('auth')->group(function () {
    Route::get('/', [TasksController::class, 'index'])->name('tasks.index');
    Route::post('/', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/{task}', [TasksController::class, 'show'])->name('tasks.show');
    Route::get('/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::get('/{task}/complete', [TasksController::class, 'complete'])->name('tasks.complete');
    Route::put('/{task}', [TasksController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
});
