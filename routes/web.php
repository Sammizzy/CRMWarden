<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
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


