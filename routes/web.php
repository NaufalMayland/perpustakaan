<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [PeminjamController::class, 'home'])->name('peminjam.home.index')->middleware('multirole');
Route::get('/', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');

Route::prefix('perpustakaan')->group(function () {
    Route::prefix('login')->middleware('guest')->group(function (){
        Route::get('/', [ AuthController::class, 'login'])->name('auth.login')->middleware('guest');
        Route::post('/login-action', [ AuthController::class, 'loginAction'])->name('auth.loginAction')->middleware('guest');
    });
    
    Route::prefix('register')->middleware('guest')->group(function (){
        Route::get('/', [ AuthController::class, 'register'])->name('auth.register')->middleware('guest');
        Route::post('/register-action', [ AuthController::class, 'registerAction'])->name('auth.registerAction')->middleware('guest');
    });
    
    Route::post('/logout', [ AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('home')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'home'])->name('peminjam.home.index');
    });

    Route::prefix('petugas')->middleware('role:petugas')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [PetugasController::class, 'dashboard'])->name('petugas.dashboard.index');
        });
        
        Route::prefix('buku')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'buku'])->name('petugas.buku.index');
            Route::get('/tambah', [InputController::class, 'addBuku'])->name('petugas.buku.addBuku');
            Route::post('/tambah-action', [InputController::class, 'addBukuAction'])->name('petugas.buku.addBukuAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteBuku'])->name('petugas.buku.deleteBuku');
        });

        Route::prefix('kategori')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'kategori'])->name('petugas.kategori.index');
            Route::post('/tambah-action', [InputController::class, 'addKategoriAction'])->name('petugas.kategori.addKategoriAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteKategori'])->name('petugas.kategori.deleteKategori');
        });

        Route::prefix('listkategori')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'listKategori'])->name('petugas.listKategori.index');
            Route::post('/tambah-action', [InputController::class, 'addListKategoriAction'])->name('petugas.kategori.addListKategoriAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteListKategori'])->name('petugas.listKategori.deleteListKategori');
        });

        Route::prefix('peminjaman')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'peminjaman'])->name('petugas.peminjaman.index');
            Route::get('/tambah', [InputController::class, 'addPeminjaman'])->name('petugas.peminjaman.addPeminjaman');
        });

        Route::prefix('ulasan')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'ulasan'])->name('petugas.ulasan.index');
        });

        Route::prefix('user')->middleware('rolePetugas:petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'user'])->name('petugas.user.index');
            Route::get('/tambah', [InputController::class, 'addUser'])->name('petugas.user.addUser');
            Route::post('/tambah-action', [InputController::class, 'addUserAction'])->name('petugas.user.addUserAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteUser'])->name('petugas.user.deleteUser');
            Route::get('/print', [PrintController::class, 'userPrint'])->name('petugas.user.printUser');
            Route::get('/import', [ImportExcelController::class, 'importUser'])->name('petugas.user.importUser');
            Route::get('/template', [ImportExcelController::class, 'templateUser'])->name('petugas.user.templateUser');
        });
    });
});