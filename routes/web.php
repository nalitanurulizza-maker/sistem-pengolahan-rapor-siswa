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
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/data-siswa', function () {
    return view('admin.data-siswa');
})->name('admin.data-siswa');
Route::get('/admin/data-guru', function () {
    return view('admin.data-guru');
})->name('admin.data-guru');
Route::get('/admin/data-wali-kelas', function () {
    return view('admin.data-wali-kelas');
})->name('admin.data-wali-kelas');
Route::get('/admin/mata-pelajaran', function () {
    return view('admin.mata-pelajaran');
})->name('admin.mata-pelajaran');
Route::get('/admin/tahun-akademik', function () {
    return view('admin.tahun-akademik');
})->name('admin.tahun-akademik');

// AUTH
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// DASHBOARD GURU
Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru-dashboard');
Route::get('/wali/dashboard', function () {
    return view('wali.dashboard');
})->name('wali.dashboard');
