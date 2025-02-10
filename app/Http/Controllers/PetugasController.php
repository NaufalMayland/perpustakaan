<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function dashboard() {
        return view('petugas.dashboard.index', [
            'title' => "Dashboard",
        ]);
    }

    public function dpetugas() {
        $user = Auth::user();
        $petugas = Petugas::whereNot('email', $user->email)->get();
        // dd($petugas);

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

    public function detailBuku($id)
    {
        $buku = Buku::findOrFail($id);

        return view('petugas.buku.detailBuku', [
            'title' => "Detail",
            'buku' => $buku
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
        $dataListKategori = ListKategori::with(['buku', 'kategori'])->get();
        
        return view('petugas.listKategori.index', [
            'title' => "List Kategori",
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
