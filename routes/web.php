<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\guru\GuruDashboardController;

// LANDING PAGE
Route::get('/', [HomeController::class, 'tampilkan']);

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');

// CONTACT
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'kirim'])->name('contact.kirim');

// DASHBOARD ADMIN
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

// DASHBOARD GURU
Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru-dashboard');
Route::prefix('guru')->group(function () {
    
    // URL: /guru/dashboard
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');

    // URL: /guru/cek-nilai
    Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('guru.cek-nilai');

});