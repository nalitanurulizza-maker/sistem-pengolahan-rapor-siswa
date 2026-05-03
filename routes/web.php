<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
// Opsional: Jika ingin langsung ke login, gunakan LoginController
Route::get('/', [HomeController::class, 'tampilkan']);

// Login System
Route::get('/login', [LoginController::class, 'tampilkan'])->name('login');
Route::post('/login', [LoginController::class, 'prosesLogin']);

// Dashboard
Route::get('/admin/dashboard-admin', [AdminDashboard::class, 'index'])->name('dashboard');

// Home (Tambahan dari versi Incoming)
Route::get('/home', [HomeController::class, 'tampilkan'])->name('home');

// Contact System
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'kirim'])->name('contact.kirim');