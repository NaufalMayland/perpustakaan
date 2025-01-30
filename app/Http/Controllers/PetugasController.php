<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard() {
        return view('petugas.dashboard.index', [
            'title' => "Dashboard",
        ]);
    }

    public function buku() {
        $dataBuku = Buku::all();

        return view('petugas.buku.index', [
            'title' => "Buku",
            'dataBuku' => $dataBuku,
        ]);
    }

    public function kategori() {
        $dataKategori = Kategori::all();

        return view('petugas.kategori.index', [
            'title' => "Kategori",
            'dataKategori' => $dataKategori,
        ]);
    }

    public function listKategori() {
        $dataBuku = Buku::all();
        $dataKategori = Kategori::all();
        $dataListKategori = ListKategori::with(['buku', 'kategori'])->get();
        
        return view('petugas.listKategori.index', [
            'title' => "List Kategori",
            'dataBuku' => $dataBuku,
            'dataKategori' => $dataKategori,
            'dataListKategori' => $dataListKategori,
        ]);
    }

    public function user() {
        $dataUser = User::with(['role'])->get();
        return view('petugas.user.index', [
            'title' => "User",
            'dataUser' => $dataUser
        ]);
    }

    public function peminjaman() {
        return view('petugas.peminjaman.index', [
            'title' => "Peminjaman",
        ]);
    }

    public function ulasan() {
        return view('petugas.ulasan.index', [
            'title' => "Ulasan",
        ]);
    }
}
