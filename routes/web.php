<?php

use Illuminate\Support\Facades\Route;

// ── CONTROLLER UMUM ────────────────────────────────────────────────────────
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// ── CONTROLLER ADMIN ────────────────────────────────────────────────────────
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController; 
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\TahunAkademikController;

// ── CONTROLLER GURU ─────────────────────────────────────────────────────────
use App\Http\Controllers\Guru\GuruDashboardController;

// ── LANDING PAGE & MAIN AUTH ────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'tampilkan'])->name('home');
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact.index');
    Route::post('/contact', 'kirim')->name('contact.kirim');
});

// ── KELOMPOK RUTE ADMIN ─────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard-admin');
        
        // Data Master Siswa
        Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data-siswa');
        Route::post('/data-siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('/data-siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/data-siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Data Master Guru
        Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
        Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
        Route::put('/data-guru/{nip}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/data-guru/{nip}', [GuruController::class, 'destroy'])->name('guru.destroy');
        
        // Data Master Kelas (Menggunakan kode_kelas)
        Route::get('/data-kelas', [KelasController::class, 'index'])->name('data-kelas');
        Route::post('/data-kelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::put('/data-kelas/{kode_kelas}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/data-kelas/{kode_kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

        // Data Master Akademik
        Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('mata-pelajaran');
        Route::get('/tahun-akademik', [TahunAkademikController::class, 'index'])->name('tahun-akademik');
    });

// ── KELOMPOK RUTE GURU ──────────────────────────────────────────────────────
Route::middleware(['auth', 'role:guru,walas'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard-guru');
        Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('cek-nilai');
        Route::get('/input-nilai', [GuruDashboardController::class, 'inputNilai'])->name('input-nilai');
        Route::post('/simpan-nilai-batch', [GuruDashboardController::class, 'simpanNilaiBatch'])->name('simpan-nilai-batch');
        Route::get('/input-kehadiran', [GuruDashboardController::class, 'inputKehadiran'])->name('input-kehadiran');
        Route::get('/input-catatan', [GuruDashboardController::class, 'inputCatatan'])->name('input-catatan');
        Route::get('/input-predikat', [GuruDashboardController::class, 'inputPredikat'])->name('input-predikat');
        Route::get('/cetak-rapor', [GuruDashboardController::class, 'cetakRapor'])->name('cetak-rapor');
    });