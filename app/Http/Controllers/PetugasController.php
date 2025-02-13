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
use Illuminate\Support\Facades\DB;

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
        $dataListKategori = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNull('list_kategoris.deleted_at')
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul',
            DB::raw("GROUP_CONCAT(list_kategoris.id SEPARATOR ', ') as id_list"),
            DB::raw("GROUP_CONCAT(kategoris.kategori SEPARATOR ', ') as kategori")
        )
        ->groupBy('bukus.id', 'bukus.judul')
        ->get();

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
