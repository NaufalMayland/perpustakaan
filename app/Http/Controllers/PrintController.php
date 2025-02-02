<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printPetugas()
    {
        $petugas = Petugas::all();
        return view('petugas.user.dpetugas.printPetugas', [
            'title' => "Print",
            'petugas' => $petugas
        ]);
    }

    public function printBuku()
    {
        $buku = Buku::all();
        return view('petugas.buku.printBuku', [
            'title' => "Print",
            'buku' => $buku
        ]);
    }
    
    public function printKategori()
    {
        $kategori = Kategori::all();
        return view('petugas.kategori.printKategori', [
            'title' => "Print",
            'kategori' => $kategori
        ]);
    }

    public function printListKategori()
    {
        $listKategori = ListKategori::with(['buku', 'kategori'])->get();
        return view('petugas.listKategori.printListKategori', [
            'title' => "Print",
            'listKategori' => $listKategori
        ]);
    } 
    
    public function printPeminjam()
    {
        $peminjam = Peminjam::all();
        return view('petugas.user.dpeminjam.printPeminjam', [
            'title' => "Print",
            'peminjam' => $peminjam
        ]);
    }

    public function printPeminjaman()
    {
        $peminjaman = Peminjaman::with(['peminjam', 'buku', 'petugas'])->get();
        return view('petugas.peminjaman.printPeminjaman', [
            'title' => "Print",
            'peminjaman' => $peminjaman
        ]);
    }

    public function printDenda()
    {
        $denda = Denda::all();
        return view('petugas.denda.printDenda', [
            'title' => "Print",
            'denda' => $denda
        ]);
    }
}
