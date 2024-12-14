<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ AuthController::class, 'login'])->name('auth.login');
Route::post('/login-action', [ AuthController::class, 'loginAction'])->name('auth.loginAction');

Route::get('/register', [ AuthController::class, 'register'])->name('auth.register');
Route::post('/register-action', [ AuthController::class, 'registerAction'])->name('auth.registerAction');

Route::post('/logout', [ AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('petugas')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [PetugasController::class, 'dashboard'])->name('petugas.dashboard.index');
    });
});