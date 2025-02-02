<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard() {
        return view('petugas.dashboard.index', [
            'title' => "Dashboard",
        ]);
    }

    public function dpetugas() {
        $petugas = Petugas::all();
        return view('petugas.user.dpetugas.index', [
            'title' => "Petugas",
            'petugas' => $petugas
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

    public function dpeminjam() {
        $peminjam = Peminjam::all();
        return view('petugas.user.dpeminjam.index', [
            'title' => "Peminjam",
            'peminjam' => $peminjam
        ]);
    }

    public function peminjaman() {
        return view('petugas.peminjaman.index', [
            'title' => "Peminjaman",
        ]);
    }

    public function denda() {
        return view('petugas.denda.index', [
            'title' => "Denda",
        ]);
    }

    public function ulasan() {
        return view('petugas.ulasan.index', [
            'title' => "Ulasan",
        ]);
    }
}
