<?php

use Illuminate\Support\Facades\Route;

// ── CONTROLLER UMUM (Di Folder Luar) ────────────────────────────────────────
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// ── CONTROLLER ADMIN (Di Dalam Sub-Folder Admin dengan A Kapital) ────────────
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\TahunAkademikController;

// ── CONTROLLER GURU (Di Dalam Sub-Folder Guru dengan G Kapital) ───────────
use App\Http\Controllers\Guru\GuruDashboardController;

// ── LANDING PAGE & UTAMA ────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'tampilkan'])->name('home');

// ── PROSES AUTH (LOGIN & LOGOUT) ────────────────────────────────────────────
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// ── HALAMAN CONTACT ─────────────────────────────────────────────────────────
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact.index');
    Route::post('/contact', 'kirim')->name('contact.kirim');
});

// ── KELOMPOK RUTE ADMIN (Gunakan Middleware & Prefix) ───────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // Halaman Dashboard Utama Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard-admin');
        
       // ── KELOLA DATA MASTER ADMIN ─────────────────────────────────────────
        // Manajemen Data Master Siswa
        Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data-siswa');
        Route::post('/data-siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('/data-siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/data-siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Manajemen Data Master Guru
        Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
        Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
        Route::put('/data-guru/{nip}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/data-guru/{nip}', [GuruController::class, 'destroy'])->name('guru.destroy');

        // Data Master Akademik
        Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('mata-pelajaran');
        Route::get('/tahun-akademik', [TahunAkademikController::class, 'index'])->name('tahun-akademik');
    });

// ── KELOMPOK RUTE GURU & WALI KELAS ──────────────────────────────────────────
Route::middleware(['auth', 'role:guru,walas'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        
        // Fitur Utama Guru & Walas
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard-guru');
        Route::get('/input-nilai', [GuruDashboardController::class, 'inputNilai'])->name('input-nilai');
        Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('cek-nilai');

        // Khusus Fitur Tambahan Wali Kelas (Role: Walas)
        Route::middleware('role:walas')->group(function () {
            Route::get('/input-kehadiran', [GuruDashboardController::class, 'inputKehadiran'])->name('input-kehadiran');
            Route::get('/input-catatan', [GuruDashboardController::class, 'inputCatatan'])->name('input-catatan');
            Route::get('/input-predikat', [GuruDashboardController::class, 'inputPredikat'])->name('input-predikat');
            Route::get('/cetak-rapor', [GuruDashboardController::class, 'cetakRapor'])->name('cetak-rapor');
        });
    });