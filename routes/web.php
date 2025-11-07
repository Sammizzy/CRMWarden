<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;


// Import the controllers


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

//lists resources
Route::get('/lists', [ListsController::class, 'index'])->name('lists.index');
Route::get('/lists/create', [ListsController::class, 'create'])->name('lists.create');
Route::post('/lists', [ListsController::class, 'store'])->name('lists.store');
Route::get('/lists/{list}', [ListsController::class, 'show'])->name('lists.show');
Route::get('/lists/{list}/edit', [ListsController::class, 'edit'])->name('lists.edit');
Route::put('/lists/{list}', [ListsController::class, 'update'])->name('lists.update');
Route::delete('/lists/{list}', [ListsController::class, 'destroy'])->name('lists.destroy');

//tasks resources
Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}', [TasksController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');



