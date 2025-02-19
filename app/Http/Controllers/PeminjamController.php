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
            'buku' => $buku,
        ]);
    }

    public function detailBuku($id)
    {
        $peminjam = Peminjam::where('email', Auth::user()->email)->first();
        $buku = ListKategori::where('id_buku', $id)->first();
        $ulasan = Ulasan::with(['peminjam'])
        ->where('id_buku', $id)
        ->whereNot('id_peminjam', $peminjam->id)
        ->get();

        $ulasanCount = Ulasan::where('id_buku', $id)->count();

        $ulasanKu = Ulasan::whereHas('buku', function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->whereHas('peminjam', function ($query) use ($peminjam) {
            $query->where('id', $peminjam->id);
        })
        ->get();
    
        $getKategori = ListKategori::with('kategori')->where('id_buku', $id)->get()->pluck('kategori.kategori')->implode(', ');

        return view('peminjam.detailBuku', [
            'title' => $buku->buku->judul,
            'buku' => $buku,
            'ulasan' => $ulasan,
            'ulasanCount' => $ulasanCount,
            'ulasanKu' => $ulasanKu,
            'getKategori' => $getKategori,
        ]);
    }

    public function profil()
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();
        $peminjam->alamat = json_decode($peminjam->alamat, true);

        return view('peminjam.profil', [
            'title' => "Profil",
            'user' => $user,
            'peminjam' => $peminjam,
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
        ->groupBy('bukus.id', 'bukus.judul', 'bukus.cover')
        ->get();

        return view('peminjam.searchBuku', [
            'title' => "Home",
            'buku' => $buku,
            'header' => $request->search
        ]);
    }

    public function searchByKategori(Request $request, $id)
    {
        $buku = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNull('list_kategoris.deleted_at')
        ->when($id, function ($query) use ($id) {
            $query->where('kategoris.id', $id);
        })
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul'
        )
        ->groupBy('bukus.id', 'bukus.judul', 'bukus.cover')
        ->get(); 

        $header = Kategori::where('id', $id)->first();

        return view('peminjam.searchKategori', [
            'title' => "Home",
            'buku' => $buku,
            'header' => $header,
        ]);
    }

    public function koleksiBuku()
    {
        $koleksi = DB::table('koleksis')
        ->join('bukus', 'bukus.id', '=', 'koleksis.id_buku')
        ->join('list_kategoris', 'list_kategoris.id_buku', '=', 'bukus.id')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul',
            'bukus.penulis',
            DB::raw("GROUP_CONCAT(kategoris.kategori SEPARATOR ', ') as kategori")
        )
        ->groupBy('bukus.id', 'bukus.judul')
        ->get();

        return view('peminjam.koleksi', [
            'title' => "Koleksi Buku",
            'koleksi' => $koleksi,
        ]);
    }
}
