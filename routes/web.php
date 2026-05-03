<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\guru\GuruDashboardController;
use App\Http\Controllers\walas\WalasDashboardController;

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

// Tambahkan ->name() agar sinkron dengan yang kamu panggil di sidebar.blade.php
Route::get('/admin/data-siswa', function () {
    return view('admin.data-siswa');
})->name('data-siswa');

Route::get('/admin/data-guru', function () {
    return view('admin.data-guru');
})->name('data-guru');

Route::get('/admin/data-wali-kelas', function () {
    return view('admin.data-wali-kelas');
})->name('data-wali-kelas');

// Tambahkan juga untuk bagian Akademik jika diperlukan
Route::get('/admin/mata-pelajaran', function () {
    return view('admin.mata-pelajaran');
})->name('mata-pelajaran');

Route::get('/admin/tahun-akademik', function () {
    return view('admin.tahun-akademik');
})->name('tahun-akademik');

// DASHBOARD GURU
Route::prefix('guru')->group(function () {
    // URL: /guru/dashboard
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');

    // URL: /guru/cek-nilai
    Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('guru.cek-nilai');
 
    // URL: /guru/input-nilai
    Route::get('/input-nilai', [GuruDashboardController::class, 'inputNilai'])->name('guru.input-nilai');
});

// DASHBOARD WALI KELAS
Route::prefix('walas')->group(function () {
    // Dashboard Utama Walas
    Route::get('/dashboard', [WalasDashboardController::class, 'index'])->name('walas-dashboard');

    // Group untuk Input Data Rapor
    Route::get('/input-kehadiran', [WalasDashboardController::class, 'inputKehadiran'])->name('walas.input-kehadiran');
    Route::get('/input-catatan', [WalasDashboardController::class, 'inputCatatan'])->name('walas.input-catatan');
    Route::get('/input-predikat', [WalasDashboardController::class, 'inputPredikat'])->name('walas.input-predikat');

    // Group untuk Cetak Rapor
    Route::get('/cetak-pdf', [WalasDashboardController::class, 'cetakPdf'])->name('walas.cetak-pdf');
});