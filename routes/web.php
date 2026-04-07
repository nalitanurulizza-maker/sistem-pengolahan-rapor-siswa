<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/login', [LoginController::class, 'tampilkan']);
Route::post('/login', [LoginController::class, 'prosesLogin']);

Route::get('/', [HomeController::class, 'tampilkan']);
Route::get('/home', [HomeController::class, 'tampilkan']);