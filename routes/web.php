<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'tampilkan']);
Route::post('/login', [LoginController::class, 'prosesLogin']);


Route::get('/', [HomeController::class, 'tampilkan']);
Route::get('/home', [HomeController::class, 'tampilkan']);


Route::view('/login', 'login');