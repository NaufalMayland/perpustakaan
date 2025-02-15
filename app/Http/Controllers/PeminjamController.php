<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    public function index()
    {
        $buku = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNull('list_kategoris.deleted_at')
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul',
        )
        ->groupBy('bukus.id', 'bukus.judul')
        ->get();
        
        return view('peminjam.index', [
            'title' => "Home",
            'buku' => $buku
        ]);
    }

    public function detailBuku($id)
    {
        $buku = ListKategori::with(['buku', 'kategori'])->where('id_buku', $id)->first();
        $getKategori = DB::table('list_kategoris')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->where('list_kategoris.id_buku', $id)
        ->select(
            DB::raw("GROUP_CONCAT(kategoris.kategori SEPARATOR ', ') as kategori")
        )
        ->get();

        return view('peminjam.detailBuku', [
            'title' => $buku->buku->judul,
            'buku' => $buku,
            'getKategori' => $getKategori
        ]);
    }

    public function profil()
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();
        
        return view('peminjam.profil', [
            'title' => "Profil",
            'user' => $user,
            'peminjam' => $peminjam
        ]);
    }
}
