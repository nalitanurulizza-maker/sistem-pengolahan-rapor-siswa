<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/login', [LoginController::class, 'tampilkan']);
Route::post('/login', [LoginController::class, 'prosesLogin']);

<<<<<<< HEAD
Route::get('/', [HomeController::class, 'tampilkan']);
Route::get('/home', [HomeController::class, 'tampilkan']);
=======

Route::get('/login', [LoginController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/',  [DashboardController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
>>>>>>> 6cc23baeeeaf9d9c2eca028842fa070bd8b08cb2
