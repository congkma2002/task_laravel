<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckJWT;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(CheckJWT::class)->group(function () {
    Route::resource('/task', TaskController::class);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/task/export', [TaskController::class, 'show']);
});

Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
