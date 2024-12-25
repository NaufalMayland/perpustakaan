<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ AuthController::class, 'login'])->name('auth.login');
Route::post('/login-action', [ AuthController::class, 'loginAction'])->name('auth.loginAction');

Route::get('/register', [ AuthController::class, 'register'])->name('auth.register');
Route::post('/register-action', [ AuthController::class, 'registerAction'])->name('auth.registerAction');

Route::post('/logout', [ AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('perpustakaan')->group(function () {
    Route::prefix('petugas')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [PetugasController::class, 'dashboard'])->name('petugas.dashboard.index');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', [PetugasController::class, 'user'])->name('petugas.user.index');
            Route::get('/tambah', [InputController::class, 'addUser'])->name('petugas.user.addUser');
            Route::post('/tambah-action', [InputController::class, 'addUserAction'])->name('petugas.user.addUserAction');
            Route::get('/print', [PrintController::class, 'userPrint'])->name('petugas.user.printUser');
            Route::get('/import', [ImportExcelController::class, 'importUser'])->name('petugas.user.importUser');
            Route::get('/template', [ImportExcelController::class, 'templateUser'])->name('petugas.user.templateUser');
        });
    });
});