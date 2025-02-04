<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\ListKategori;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function home(){
        $buku = ListKategori::with(['buku', 'kategori'])->get();
        return view('peminjam.home.index', [
            'title' => "Home",
            'buku' => $buku
        ]);
    }
}
