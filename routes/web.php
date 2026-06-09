<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\TahunAkademikController;

use App\Http\Controllers\Guru\GuruDashboardController;

// Auth Routes
Route::get('/', [HomeController::class, 'tampilkan'])->name('home');
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Contact
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact.index');
    Route::post('/contact', 'kirim')->name('contact.kirim');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard-admin');
        
        Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data-siswa');
        Route::post('/data-siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('/data-siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/data-siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
        Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
        Route::put('/data-guru/{nip}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/data-guru/{nip}', [GuruController::class, 'destroy'])->name('guru.destroy');

        Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('mata-pelajaran');
        Route::get('/tahun-akademik', [TahunAkademikController::class, 'index'])->name('tahun-akademik');
    });

// Guru & Wali Kelas Routes
Route::middleware(['auth', 'role:guru,wali kelas'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard-guru');
        
        // Nilai
        Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('cek-nilai');
        Route::get('/input-nilai', [GuruDashboardController::class, 'inputNilai'])->name('input-nilai');
        Route::post('/simpan-nilai-batch', [GuruDashboardController::class, 'simpanNilaiBatch'])->name('simpan-nilai-batch');

        // Absensi & Kehadiran
    
        Route::get('/input-kehadiran', [GuruDashboardController::class, 'inputKehadiran'])->name('input-kehadiran');
        Route::post('/simpan-kehadiran', [GuruDashboardController::class, 'simpanKehadiran'])->name('simpan-kehadiran'); 

        
        // Baru: Absensi Sesi & Rekap Mingguan
        Route::post('/simpan-absensi-sesi', [GuruDashboardController::class, 'simpanAbsensiSesi'])->name('simpan-absensi-sesi');
        Route::post('/simpan-rekap-mingguan', [GuruDashboardController::class, 'simpanRekapMingguan'])->name('simpan-rekap-mingguan');
        
        // Lainnya
        Route::get('/input-catatan', [GuruDashboardController::class, 'inputCatatan'])->name('input-catatan');
        Route::get('/input-predikat', [GuruDashboardController::class, 'inputPredikat'])->name('input-predikat');
        Route::get('/cetak-rapor', [GuruDashboardController::class, 'cetakRapor'])->name('cetak-rapor');
    });