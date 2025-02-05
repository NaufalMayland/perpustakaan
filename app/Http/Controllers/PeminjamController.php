<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function profil()
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->get();
        
        return view('peminjam.profil', [
            'title' => "Profil",
            'peminjam' => $peminjam
        ]);
    }
}
