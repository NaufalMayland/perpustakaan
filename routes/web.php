<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\GetWilayahController;
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
        Route::get('/', [ AuthController::class, 'login'])->name('auth.login');
        Route::post('/login-action', [ AuthController::class, 'loginAction'])->name('auth.loginAction');
    });
    
    Route::prefix('register')->middleware('guest')->group(function (){
        Route::get('/', [ AuthController::class, 'register'])->name('auth.register');
        Route::post('/register-action', [ AuthController::class, 'registerAction'])->name('auth.registerAction');
    });
    
    Route::post('/logout', [ AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('home')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'index'])->name('peminjam.index');
        Route::get('/search', [PeminjamController::class, 'searchBuku'])->name('peminjam.searchBuku');
        Route::get('/kategori/{id}', [PeminjamController::class, 'searchByKategori'])->name('peminjam.searchByKategori');
    });

    Route::prefix('profil')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'profil'])->name('peminjam.profil');
        Route::get('/edit/{id}', [EditController::class, 'editProfilPeminjam'])->name('peminjam.editProfil');
        Route::put('/edit-action/{id}', [EditController::class, 'editProfilPeminjamAction'])->name('peminjam.editProfilAction');
        Route::get('/provinsi', [GetWilayahController::class, 'getProvinsi']);
        Route::get('/kabupaten/{provinsiId}', [GetWilayahController::class, 'getKabupaten']);
        Route::get('/kecamatan/{kabupatenId}', [GetWilayahController::class, 'getKecamatan']);
        Route::get('/kelurahan/{kecamatanId}', [GetWilayahController::class, 'getKelurahan']);
    });

    Route::prefix('buku')->middleware('role:peminjam')->group(function () {
        Route::get('/{id}', [PeminjamController::class, 'detailBuku'])->name('peminjam.detailBuku');
        Route::post('ulasan-action/{id}', [InputController::class, 'addUlasanAction'])->name('peminjam.addUlasanAction');
        Route::delete('/destroy/{id}', [DeleteController::class, 'destroyUlasan'])->name('peminjam.destroyUlasan');
        
    });
    
    Route::prefix('koleksi')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'koleksiBuku'])->name('peminjam.koleksiBuku');
        Route::post('simpan/{id}', [InputController::class, 'addKoleksiAction'])->name('peminjam.addKoleksiAction');
    });
    
    Route::prefix('peminjaman')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'peminjamanBuku'])->name('peminjam.peminjamanBuku');
        Route::delete('batal/{id}', [DeleteController::class, 'batalPeminjaman'])->name('peminjam.batalPeminjaman');
        Route::post('pinjam-buku/{id}', [InputController::class, 'addPeminjamanAction'])->name('peminjam.addPeminjamanAction');
    });

    Route::prefix('petugas')->middleware('role:petugas')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [PetugasController::class, 'dashboard'])->name('petugas.dashboard.index');
        });

        Route::prefix('petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'dpetugas'])->name('petugas.user.dpetugas.index');
            Route::get('/tambah', [InputController::class, 'addPetugas'])->name('petugas.user.dpetugas.addPetugas');
            Route::post('/tambah-action', [InputController::class, 'addPetugasAction'])->name('petugas.user.dpetugas.addPetugasAction');
            Route::get('/detail/{id}', [PetugasController::class, 'detailPetugas'])->name('petugas.user.dpetugas.detailPetugas');
            Route::get('edit/{id}', [EditController::class, 'editPetugas'])->name('petugas.user.dpetugas.editPetugas');
            Route::delete('/delete/{id}', [DeleteController::class, 'deletePetugas'])->name('petugas.user.dpetugas.deletePetugas');
            Route::get('/trash', [DeleteController::class, 'trashPetugas'])->name('petugas.user.dpetugas.trashPetugas');
            Route::post('/restore/{id}', [DeleteController::class, 'restorePetugas'])->name('petugas.user.dpetugas.restorePetugas');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyPetugas'])->name('petugas.user.dpetugas.destroyPetugas');
            Route::get('/import', [ImportExcelController::class, 'importPetugas'])->name('petugas.user.dpetugas.importPetugas');
            Route::get('/print', [PrintController::class, 'printPetugas'])->name('petugas.user.dpetugas.printPetugas');
        });
        
        Route::prefix('buku')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'buku'])->name('petugas.buku.index');
            Route::get('/tambah', [InputController::class, 'addBuku'])->name('petugas.buku.addBuku');
            Route::post('/tambah-action', [InputController::class, 'addBukuAction'])->name('petugas.buku.addBukuAction');
            Route::get('/detail/{id}', [PetugasController::class, 'detailBuku'])->name('petugas.buku.detailBuku');
            Route::get('/edit/{id}', [EditController::class, 'editBuku'])->name('petugas.buku.editBuku');
            Route::put('/edit-action/{id}', [EditController::class, 'editBukuAction'])->name('petugas.buku.editBukuAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteBuku'])->name('petugas.buku.deleteBuku');
            Route::get('/trash', [DeleteController::class, 'trashBuku'])->name('petugas.buku.trashBuku');
            Route::post('/restore/{id}', [DeleteController::class, 'restoreBuku'])->name('petugas.buku.restoreBuku');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyBuku'])->name('petugas.buku.destroyBuku');
            Route::get('/import', [ImportExcelController::class, 'importBuku'])->name('petugas.buku.importBuku');
            Route::get('/print', [PrintController::class, 'printBuku'])->name('petugas.buku.printBuku');
        });

        Route::prefix('kategori')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'kategori'])->name('petugas.kategori.index');
            Route::get('/tambah', [InputController::class, 'addKategori'])->name('petugas.kategori.addKategori');
            Route::post('/tambah-action', [InputController::class, 'addKategoriAction'])->name('petugas.kategori.addKategoriAction');
            Route::get('/edit/{id}', [EditController::class, 'editKategori'])->name('petugas.kategori.editKategori');
            Route::put('/edit-action/{id}', [EditController::class, 'editKategoriAction'])->name('petugas.kategori.editKategoriAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteKategori'])->name('petugas.kategori.deleteKategori');
            Route::get('/trash', [DeleteController::class, 'trashKategori'])->name('petugas.kategori.trashKategori');
            Route::post('/restore/{id}', [DeleteController::class, 'restoreKategori'])->name('petugas.kategori.restoreKategori');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyKategori'])->name('petugas.kategori.destroyKategori');
            Route::get('/import', [ImportExcelController::class, 'importKategori'])->name('petugas.kategori.importKategori');
            Route::get('/print', [PrintController::class, 'printKategori'])->name('petugas.kategori.printKategori');
        });

        Route::prefix('listkategori')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'listKategori'])->name('petugas.listKategori.index');
            Route::get('/tambah', [InputController::class, 'addListKategori'])->name('petugas.listKategori.addListKategori');
            Route::post('/tambah-action', [InputController::class, 'addListKategoriAction'])->name('petugas.listKategori.addListKategoriAction');
            Route::get('/edit/{id}', [EditController::class, 'editListKategori'])->name('petugas.listKategori.editListKategori');
            Route::put('/edit-action/{id}', [EditController::class, 'editListKategoriAction'])->name('petugas.listKategori.editListKategoriAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteListKategori'])->name('petugas.listKategori.deleteListKategori');
            Route::get('/trash', [DeleteController::class, 'trashListKategori'])->name('petugas.listKategori.trashListKategori');
            Route::post('/restore/{id}', [DeleteController::class, 'restoreListKategori'])->name('petugas.listKategori.restoreListKategori');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyListKategori'])->name('petugas.listKategori.destroyListKategori');
            Route::get('/import', [ImportExcelController::class, 'importListKategori'])->name('petugas.listKategori.importListKategori');
            Route::get('/print', [PrintController::class, 'printListKategori'])->name('petugas.ListKategori.printListKategori');
        });
        
        Route::prefix('peminjam')->middleware('rolePetugas:petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'dpeminjam'])->name('petugas.user.dpeminjam.index');
            Route::get('/tambah', [InputController::class, 'addPeminjam'])->name('petugas.user.dpeminjam.addPeminjam');
            Route::post('/tambah-action', [InputController::class, 'addPeminjamAction'])->name('petugas.user.dpeminjam.addPeminjamAction');
            Route::get('/detail/{id}', [PetugasController::class, 'detailPeminjam'])->name('petugas.user.dpeminjam.detailPeminjam');
            Route::delete('/delete/{id}', [DeleteController::class, 'deletePeminjam'])->name('petugas.user.dpeminjam.deletePeminjam');
            Route::get('/trash', [DeleteController::class, 'trashPeminjam'])->name('petugas.user.dpeminjam.trashPeminjam');
            Route::post('/restore/{id}', [DeleteController::class, 'restorePeminjam'])->name('petugas.user.dpeminjam.restorePeminjam');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyPeminjam'])->name('petugas.user.dpeminjam.destroyPeminjam');
            Route::get('/print', [PrintController::class, 'printPeminjam'])->name('petugas.user.dpeminjam.printPeminjam');
            Route::get('/import', [ImportExcelController::class, 'importPeminjam'])->name('petugas.user.dpeminjam.importPeminjam');
            Route::get('/template', [ImportExcelController::class, 'templatePeminjam'])->name('petugas.user.dpeminjam.templatePeminjam');
        });
        
        Route::prefix('peminjaman')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'peminjaman'])->name('petugas.peminjaman.index');
            Route::get('/tambah', [InputController::class, 'addPeminjaman'])->name('petugas.peminjaman.addPeminjaman');
            Route::put('/edit-status/{id}', [EditController::class, 'editStatusPeminjaman'])->name('petugas.peminjaman.editStatusPeminjaman');
            Route::get('/import', [ImportExcelController::class, 'importPeminjaman'])->name('petugas.peminjaman.importPeminjaman');
            Route::get('/print', [PrintController::class, 'printPeminjaman'])->name('petugas.peminjaman.printPeminjaman');
        });

        Route::prefix('denda')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'denda'])->name('petugas.denda.index');
        });

        Route::prefix('ulasan')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'ulasan'])->name('petugas.ulasan.index');
            Route::get('/{id}', [PetugasController::class, 'detailUlasan'])->name('petugas.ulasan.detailUlasan');
        });
    });
});