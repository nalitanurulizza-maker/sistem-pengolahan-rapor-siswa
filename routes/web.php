<?php

use Illuminate\Support\Facades\Route;

// CONTROLLER UMUM
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// CONTROLLER ADMIN
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\GuruPengampuController; // <-- IMPORT BARU

// CONTROLLER GURU
use App\Http\Controllers\Guru\GuruDashboardController;

/*
|--------------------------------------------------------------------------
| AUTH & LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'tampilkan'])->name('home');
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact.index');
    Route::post('/contact', 'kirim')->name('contact.kirim');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard-admin');

        // DATA SISWA
        Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data-siswa');
        Route::post('/data-siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('/data-siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/data-siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // DATA GURU
        Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
        Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
        Route::put('/data-guru/{nip}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/data-guru/{nip}', [GuruController::class, 'destroy'])->name('guru.destroy');

        // DATA KELAS
        Route::get('/data-kelas', [KelasController::class, 'index'])->name('data-kelas');
        Route::post('/data-kelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::put('/data-kelas/{kode_kelas}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/data-kelas/{kode_kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

        // DATA MATA PELAJARAN
        Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('mata-pelajaran');
        Route::get('/data-mata-pelajaran', [MapelController::class, 'index'])->name('data-mata-pelajaran');
        Route::post('/mata-pelajaran', [MapelController::class, 'store'])->name('mata-pelajaran.store');
        Route::put('/mata-pelajaran/{kode_mp}', [MapelController::class, 'update'])->name('mata-pelajaran.update');
        Route::delete('/mata-pelajaran/{kode_mp}', [MapelController::class, 'destroy'])->name('mata-pelajaran.destroy');

        // TAHUN AKADEMIK
        Route::get('/tahun-akademik', [TahunAkademikController::class, 'index'])->name('tahun-akademik');
        Route::post('/tahun-akademik', [TahunAkademikController::class, 'store'])->name('tahun-akademik.store');
        Route::patch('/tahun-akademik/{id}/aktifkan', [TahunAkademikController::class, 'aktifkan'])->name('tahun-akademik.aktifkan');
        Route::delete('/tahun-akademik/{id}', [TahunAkademikController::class, 'destroy'])->name('tahun-akademik.destroy');

        // GURU PENGAMPU (PLOTING TUGAS MENGAJAR)
        Route::get('/guru-pengampu', [GuruPengampuController::class, 'index'])->name('guru-pengampu.index');
        Route::post('/guru-pengampu', [GuruPengampuController::class, 'store'])->name('guru-pengampu.store');
        Route::delete('/guru-pengampu/{id}', [GuruPengampuController::class, 'destroy'])->name('guru-pengampu.destroy');
    });

/*
|--------------------------------------------------------------------------
| GURU & WALI KELAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru,wali kelas'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard-guru');

        // NILAI
        Route::get('/cek-nilai', [GuruDashboardController::class, 'cekNilai'])->name('cek-nilai');
        Route::get('/input-nilai', [GuruDashboardController::class, 'inputNilai'])->name('input-nilai');
        Route::post('/simpan-nilai-batch', [GuruDashboardController::class, 'simpanNilaiBatch'])->name('simpan-nilai-batch');

        // RAPOR & NILAI AKHIR
        Route::get('/rapor', [GuruDashboardController::class, 'rapor'])->name('rapor');
        Route::post('/hitung-nilai-akhir', [GuruDashboardController::class, 'hitungNilaiAkhir'])->name('hitung-nilai-akhir');

        // KEHADIRAN
        Route::get('/input-kehadiran', [GuruDashboardController::class, 'inputKehadiran'])->name('input-kehadiran');
        Route::post('/simpan-kehadiran', [GuruDashboardController::class, 'simpanKehadiran'])->name('simpan-kehadiran');
        Route::post('/simpan-absensi-sesi', [GuruDashboardController::class, 'simpanAbsensiSesi'])->name('simpan-absensi-sesi');
        Route::post('/simpan-rekap-mingguan', [GuruDashboardController::class, 'simpanRekapMingguan'])->name('simpan-rekap-mingguan');

        // FITUR LAIN
        Route::get('/input-catatan', [GuruDashboardController::class, 'inputCatatan'])->name('input-catatan');
        Route::get('/input-predikat', [GuruDashboardController::class, 'inputPredikat'])->name('input-predikat');
        Route::get('/cetak-rapor', [GuruDashboardController::class, 'cetakRapor'])->name('cetak-rapor');
    });