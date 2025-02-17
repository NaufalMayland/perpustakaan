<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Ulasan;
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
        $buku = ListKategori::where('id_buku', $id)->first();
        $ulasan = Ulasan::with(['peminjam'])->where('id_buku', $id)->get();
        $getKategori = ListKategori::with('kategori')->where('id_buku', $id)->get()->pluck('kategori.kategori')->implode(', ');

        return view('peminjam.detailBuku', [
            'title' => $buku->buku->judul,
            'buku' => $buku,
            'ulasan' => $ulasan,
            'getKategori' => $getKategori,
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

    public function searchBuku(Request $request)
    {
        $buku = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNull('list_kategoris.deleted_at')
        ->when($request->search, function ($query) use ($request) {
            $query->where('bukus.judul', 'like', '%' . $request->search . '%');
        })
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul'
        )
        ->groupBy('bukus.id', 'bukus.judul', 'bukus.cover') // tambahkan 'bukus.cover' untuk menghindari error
        ->get();


        return view('peminjam.resultSearch', [
            'title' => "Home",
            'buku' => $buku
        ]);
    }
}
