<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\ListKategori;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $buku = ListKategori::with(['buku', 'kategori'])->get();
        
        return view('peminjam.index', [
            'title' => "Home",
            'buku' => $buku
        ]);
    }

    public function detailBuku($id)
    {
        $buku = ListKategori::with(['buku', 'kategori'])->where('id', $id)->first();
        return view('peminjam.detailBuku', [
            'title' => $buku->buku->judul,
            'buku' => $buku
        ]);
    }
}
