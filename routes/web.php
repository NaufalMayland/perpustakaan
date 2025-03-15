<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\ExportController;
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
        Route::get('/forgot-password', [ AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');
        Route::post('/forgot-password-action', [ AuthController::class, 'forgotPasswordAction'])->name('auth.forgotPasswordAction');
    });
    
    Route::prefix('register')->middleware('guest')->group(function (){
        Route::get('/', [ AuthController::class, 'register'])->name('auth.register');
        Route::post('/register-action', [ AuthController::class, 'registerAction'])->name('auth.registerAction');
    });
    
    Route::post('/logout', [ AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('home')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'index'])->name('peminjam.index');
        Route::get('/search', [PeminjamController::class, 'searchBuku'])->name('peminjam.searchBuku');
        Route::get('/kategori/{slug}', [PeminjamController::class, 'searchByKategori'])->name('peminjam.searchByKategori');
    });

    Route::prefix('profil')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'profil'])->name('peminjam.profil');
        Route::post('/ubah-password/{id}', [AuthController::class, 'ubahPasswordPeminjam'])->name('peminjam.ubahPasswordPeminjam');
        Route::get('/edit/{id}', [EditController::class, 'editProfilPeminjam'])->name('peminjam.editProfil');
        Route::put('/edit-action/{id}', [EditController::class, 'editProfilPeminjamAction'])->name('peminjam.editProfilAction');
        Route::get('/provinsi', [GetWilayahController::class, 'getProvinsi']);
        Route::get('/kabupaten/{provinsiId}', [GetWilayahController::class, 'getKabupaten']);
        Route::get('/kecamatan/{kabupatenId}', [GetWilayahController::class, 'getKecamatan']);
        Route::get('/kelurahan/{kecamatanId}', [GetWilayahController::class, 'getKelurahan']);
    });

    Route::prefix('buku')->middleware('role:peminjam')->group(function () {
        Route::get('/{slug}', [PeminjamController::class, 'detailBuku'])->name('peminjam.detailBuku');
        Route::post('ulasan-action/{id}', [InputController::class, 'addUlasanAction'])->name('peminjam.addUlasanAction');
        Route::delete('/destroy/{id}', [DeleteController::class, 'destroyUlasan'])->name('peminjam.destroyUlasan');
    });
    
    Route::prefix('koleksi')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'koleksiBuku'])->name('peminjam.koleksiBuku');
        Route::post('simpan/{id}', [InputController::class, 'addKoleksiAction'])->name('peminjam.addKoleksiAction');
    });
    
    Route::prefix('peminjaman')->middleware('role:peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'peminjamanBuku'])->name('peminjam.peminjamanBuku');
        Route::get('detail/{id}', [PeminjamController::class, 'detailPeminjaman'])->name('peminjam.detailPeminjaman');
        Route::put('/pembatalan/{id}', [EditController::class, 'editStatusPeminjaman'])->name('peminjaman.editStatusPeminjaman');
        Route::post('pinjam-buku/{id}', [InputController::class, 'PeminjamanAction'])->name('peminjam.PeminjamanAction');
        Route::put('/perpanjangan/{id}', [EditController::class, 'requestPerpanjangan'])->name('peminjaman.requestPerpanjangan');
    });

    Route::prefix('petugas')->middleware('role:petugas')->group(function () {
        Route::prefix('profil')->group(function () {
            Route::get('/', [PetugasController::class, 'profil'])->name('petugas.profil.index');
            Route::post('/ubah-password/{id}', [AuthController::class, 'ubahPasswordPetugas'])->name('petugas.ubahPasswordPetugas');
            Route::get('/edit/{id}', [EditController::class, 'editProfilPetugas'])->name('petugas.profil.editProfil');
            Route::put('/edit-action/{id}', [EditController::class, 'editProfilPetugasAction'])->name('petugas.profil.editProfilAction');
            Route::get('/provinsi', [GetWilayahController::class, 'getProvinsi']);
            Route::get('/kabupaten/{provinsiId}', [GetWilayahController::class, 'getKabupaten']);
            Route::get('/kecamatan/{kabupatenId}', [GetWilayahController::class, 'getKecamatan']);
            Route::get('/kelurahan/{kecamatanId}', [GetWilayahController::class, 'getKelurahan']);
        });

        Route::prefix('dashboard')->group(function () {
            Route::get('/', [PetugasController::class, 'dashboard'])->name('petugas.dashboard.index');
        });

        Route::prefix('petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'dpetugas'])->name('petugas.user.dpetugas.index');
            Route::get('/tambah', [InputController::class, 'addPetugas'])->name('petugas.user.dpetugas.addPetugas');
            Route::post('/tambah-action', [InputController::class, 'addPetugasAction'])->name('petugas.user.dpetugas.addPetugasAction');
            Route::get('/detail/{id}', [PetugasController::class, 'detailPetugas'])->name('petugas.user.dpetugas.detailPetugas');
            Route::get('edit/{id}', [EditController::class, 'editPetugas'])->name('petugas.user.dpetugas.editPetugas');
            Route::put('/edit-action/{id}', [EditController::class, 'editPetugasAction'])->name('petugas.user.dpetugas.editPetugasAction');
            Route::get('/provinsi', [GetWilayahController::class, 'getProvinsi']);
            Route::get('/kabupaten/{provinsiId}', [GetWilayahController::class, 'getKabupaten']);
            Route::get('/kecamatan/{kabupatenId}', [GetWilayahController::class, 'getKecamatan']);
            Route::get('/kelurahan/{kecamatanId}', [GetWilayahController::class, 'getKelurahan']);
            Route::delete('/delete/{id}', [DeleteController::class, 'deletePetugas'])->name('petugas.user.dpetugas.deletePetugas');
            Route::get('/trash', [DeleteController::class, 'trashPetugas'])->name('petugas.user.dpetugas.trashPetugas');
            Route::post('/restore/{id}', [DeleteController::class, 'restorePetugas'])->name('petugas.user.dpetugas.restorePetugas');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyPetugas'])->name('petugas.user.dpetugas.destroyPetugas');
            Route::get('/import', [ImportExcelController::class, 'importPetugas'])->name('petugas.user.dpetugas.importPetugas');
            Route::get('/export', [ExportController::class, 'exportPetugas'])->name('petugas.user.dpetugas.exportPetugas');
            Route::get('/print', [PrintController::class, 'printPetugas'])->name('petugas.user.dpetugas.printPetugas');
        });
        
        Route::prefix('buku')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'buku'])->name('petugas.buku.index');
            Route::get('/tambah', [InputController::class, 'addBuku'])->name('petugas.buku.addBuku');
            Route::post('/tambah-action', [InputController::class, 'addBukuAction'])->name('petugas.buku.addBukuAction');
            Route::get('/detail/{slug}', [PetugasController::class, 'detailBuku'])->name('petugas.buku.detailBuku');
            Route::get('/edit/{slug}', [EditController::class, 'editBuku'])->name('petugas.buku.editBuku');
            Route::put('/edit-action/{id}', [EditController::class, 'editBukuAction'])->name('petugas.buku.editBukuAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteBuku'])->name('petugas.buku.deleteBuku');
            Route::get('/trash', [DeleteController::class, 'trashBuku'])->name('petugas.buku.trashBuku');
            Route::post('/restore/{id}', [DeleteController::class, 'restoreBuku'])->name('petugas.buku.restoreBuku');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyBuku'])->name('petugas.buku.destroyBuku');
            Route::get('/import', [ImportExcelController::class, 'importBuku'])->name('petugas.buku.importBuku');
            Route::get('/export', [ExportController::class, 'exportBuku'])->name('petugas.buku.exportBuku');
            Route::get('/print', [PrintController::class, 'printBuku'])->name('petugas.buku.printBuku');
        });

        Route::prefix('kategori')->middleware('rolePetugas:admin')->group(function (){
            Route::get('/', [PetugasController::class, 'kategori'])->name('petugas.kategori.index');
            Route::get('/tambah', [InputController::class, 'addKategori'])->name('petugas.kategori.addKategori');
            Route::post('/tambah-action', [InputController::class, 'addKategoriAction'])->name('petugas.kategori.addKategoriAction');
            Route::get('/edit/{slug}', [EditController::class, 'editKategori'])->name('petugas.kategori.editKategori');
            Route::put('/edit-action/{id}', [EditController::class, 'editKategoriAction'])->name('petugas.kategori.editKategoriAction');
            Route::delete('/delete/{id}', [DeleteController::class, 'deleteKategori'])->name('petugas.kategori.deleteKategori');
            Route::get('/trash', [DeleteController::class, 'trashKategori'])->name('petugas.kategori.trashKategori');
            Route::post('/restore/{id}', [DeleteController::class, 'restoreKategori'])->name('petugas.kategori.restoreKategori');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyKategori'])->name('petugas.kategori.destroyKategori');
            Route::get('/import', [ImportExcelController::class, 'importKategori'])->name('petugas.kategori.importKategori');
            Route::get('/export', [ExportController::class, 'exportKategori'])->name('petugas.kategori.exportKategori');
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
            Route::get('/export', [ExportController::class, 'exportListKategori'])->name('petugas.listKategori.exportListKategori');
            Route::get('/print', [PrintController::class, 'printListKategori'])->name('petugas.ListKategori.printListKategori');
        });
        
        Route::prefix('peminjam')->middleware('rolePetugas:petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'dpeminjam'])->name('petugas.user.dpeminjam.index');
            Route::get('/tambah', [InputController::class, 'addPeminjam'])->name('petugas.user.dpeminjam.addPeminjam');
            Route::post('/tambah-action', [InputController::class, 'addPeminjamAction'])->name('petugas.user.dpeminjam.addPeminjamAction');
            Route::get('/edit/{id}', [EditController::class, 'editPeminjam'])->name('petugas.user.dpeminjam.editPeminjam');
            Route::get('/detail/{id}', [PetugasController::class, 'detailPeminjam'])->name('petugas.user.dpeminjam.detailPeminjam');
            Route::post('/ubah-password/{id}', [AuthController::class, 'ubahPasswordDpeminjam'])->name('petugas.user.dpeminjam.ubahPasswordDpeminjam');
            Route::delete('/delete/{id}', [DeleteController::class, 'deletePeminjam'])->name('petugas.user.dpeminjam.deletePeminjam');
            Route::get('/trash', [DeleteController::class, 'trashPeminjam'])->name('petugas.user.dpeminjam.trashPeminjam');
            Route::post('/restore/{id}', [DeleteController::class, 'restorePeminjam'])->name('petugas.user.dpeminjam.restorePeminjam');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyPeminjam'])->name('petugas.user.dpeminjam.destroyPeminjam');
            Route::get('/print', [PrintController::class, 'printPeminjam'])->name('petugas.user.dpeminjam.printPeminjam');
            Route::get('/import', [ImportExcelController::class, 'importPeminjam'])->name('petugas.user.dpeminjam.importPeminjam');
            Route::get('/export', [ExportController::class, 'exportPeminjam'])->name('petugas.user.dpeminjam.exportPeminjam');
            Route::get('/template', [ImportExcelController::class, 'templatePeminjam'])->name('petugas.user.dpeminjam.templatePeminjam');
        });
        
        Route::prefix('peminjaman')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'peminjaman'])->name('petugas.peminjaman.index');
            Route::get('/tambah', [InputController::class, 'addPeminjaman'])->name('petugas.peminjaman.addPeminjaman');
            Route::post('/tambah-action', [InputController::class, 'addPeminjamanAction'])->name('petugas.peminjaman.addPeminjamanAction');
            Route::put('/edit-status/{id}', [EditController::class, 'editStatusPeminjaman'])->name('petugas.peminjaman.editStatusPeminjaman');
            Route::delete('/destroy/{id}', [DeleteController::class, 'destroyPeminjaman'])->name('petugas.peminjaman.destroyPeminjaman');
            Route::get('/import', [ImportExcelController::class, 'importPeminjaman'])->name('petugas.peminjaman.importPeminjaman');
            Route::get('/export', [ExportController::class, 'exportPeminjaman'])->name('petugas.peminjaman.exportPeminjaman');
            Route::get('/print', [PrintController::class, 'printPeminjaman'])->name('petugas.peminjaman.printPeminjaman');
            Route::put('/perpanjangan/{id}', [EditController::class, 'perpanjangan'])->name('petugas.peminjaman.perpanjangan');
            Route::post('/denda', [InputController::class, 'addDenda'])->name('petugas.peminjaman.addDenda');
        });
        Route::prefix('riwayat-peminjaman')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'riwayatPeminjaman'])->name('petugas.riwayatPeminjaman.index');
            Route::get('/export', [ExportController::class, 'exportRiwayatPeminjaman'])->name('petugas.riwayatPeminjaman.exportRiwayatPeminjaman');
            Route::get('/print', [PrintController::class, 'printRiwayatPeminjaman'])->name('petugas.riwayatPeminjaman.printRiwayatPeminjaman');
        });
        
        Route::prefix('denda')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'denda'])->name('petugas.denda.index');
            Route::get('/print', [PrintController::class, 'printDenda'])->name('petugas.denda.printDenda');
            Route::get('/export', [ExportController::class, 'exportDenda'])->name('petugas.denda.exportDenda');
        });

        Route::prefix('ulasan')->middleware('rolePetugas:petugas')->group(function (){
            Route::get('/', [PetugasController::class, 'ulasan'])->name('petugas.ulasan.index');
            Route::get('/{slug}', [PetugasController::class, 'detailUlasan'])->name('petugas.ulasan.detailUlasan');
        });
    });
});