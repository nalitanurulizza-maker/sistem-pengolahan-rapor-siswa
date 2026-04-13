<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;


Route::get('/login', [LoginController::class, 'tampilkan']);
Route::post('/login', [LoginController::class, 'prosesLogin']);


Route::get('/', [HomeController::class, 'tampilkan']);
Route::get('/home', [HomeController::class, 'tampilkan']);

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'kirim'])->name('contact.kirim');


Route::get('/login', [LoginController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/',  [DashboardController::class, 'index']);

