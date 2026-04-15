<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;

// Landing page
Route::get('/', [HomeController::class, 'tampilkan']);

// Login
Route::get('/login', [LoginController::class, 'tampilkan']);
Route::post('/login', [LoginController::class, 'prosesLogin']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

=======
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// HALAMAN UTAMA (Langsung ke Login)
// Pastikan di LoginController ada fungsi bernama 'index'
Route::get('/', [LoginController::class, 'index']);

// LOGIN
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'prosesLogin']);

// DASHBOARD & HOME
Route::get('/home', [HomeController::class, 'tampilkan']);
Route::get('/dashboard', [DashboardController::class, 'index']);

// CONTACT
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'kirim'])->name('contact.kirim');
>>>>>>> 239af2a99e0977dc10b00116e131ebd68ffe9bd1
