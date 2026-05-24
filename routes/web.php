<?php

use Illuminate\Support\Facades\Route;

// Import Group Controller Umum
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// Import Group Controller Khusus ADMIN
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\admin\GuruController;
use App\Http\Controllers\admin\WalasController;
use App\Http\Controllers\admin\MapelController;
use App\Http\Controllers\admin\TahunAkademikController;

// Import Group Controller Khusus GURU & WALAS
use App\Http\Controllers\guru\GuruDashboardController;
use App\Http\Controllers\walas\WalasDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', [HomeController::class, 'tampilkan']);

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');

// CONTACT
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'kirim'])->name('contact.kirim');


// ==========================================
// ROUTE GRUP DASHBOARD ADMIN
// ==========================================
Route::prefix('admin')->group(function () {
    
    // Dashboard Utama Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

    // Data Master Admin
    Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data-siswa');
    Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
    Route::get('/data-wali-kelas', [WalasController::class, 'index'])->name('data-wali-kelas');

    // Data Akademik Admin
    Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('mata-pelajaran');
    Route::get('/tahun-akademik', [TahunAkademikController::class, 'index'])->name('tahun-akademik');

    // Sediakan space di bawah ini untuk route POST/Store data master Anda nanti:
    // Route::post('/data-siswa', [SiswaController::class, 'store'])->name('siswa.store');
    // Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
});


// ==========================================
// ROUTE GRUP DASHBOARD GURU
// ==========================================
Route::prefix('guru')->group(function () {
    
    // Dashboard Utama Guru
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');

    // Menu Halaman Guru
    Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('guru.cek-nilai');
    Route::get('/input-nilai', [GuruDashboardController::class, 'inputNilai'])->name('guru.input-nilai');
});


// ==========================================
// ROUTE GRUP DASHBOARD WALI KELAS (WALAS)
// ==========================================
Route::prefix('walas')->group(function () {
    
    // Dashboard Utama Walas
    Route::get('/dashboard', [WalasDashboardController::class, 'index'])->name('walas-dashboard');

    // Input Data Rapor oleh Walas
    Route::get('/input-kehadiran', [WalasDashboardController::class, 'inputKehadiran'])->name('walas.input-kehadiran');
    Route::get('/input-catatan', [WalasDashboardController::class, 'inputCatatan'])->name('walas.input-catatan');
    Route::get('/input-predikat', [WalasDashboardController::class, 'inputPredikat'])->name('walas.input-predikat');

    // Cetak Rapor
    Route::get('/cetak-pdf', [WalasDashboardController::class, 'cetakPdf'])->name('walas.cetak-pdf');
});