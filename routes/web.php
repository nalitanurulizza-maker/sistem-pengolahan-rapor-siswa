<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

// Landing page
Route::get('/', [HomeController::class, 'tampilkan']);

// Login
Route::get('/login', [LoginController::class, 'tampilkan']);
Route::post('/login', [LoginController::class, 'prosesLogin']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

