<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\Ulasan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        $petugas = Petugas::where('email', $user->email)->first();
        $petugas->alamat = json_decode($petugas->alamat, true);

        return view('petugas.profil.index', [
            'title' => "Profil",
            'user' => $user,
            'petugas' => $petugas,
        ]);    
    }

    public function dashboard() {
        $buku = Buku::withTrashed()->get();
        $peminjaman = Peminjaman::withTrashed()->get();
        $denda = Denda::all();
        $peminjamanToday = Peminjaman::with(['buku', 'peminjam', 'petugas'])
        ->whereDate('created_at', Carbon::today())
        ->whereNot('status', 'dikembalikan')
        ->get();
        
        return view('petugas.dashboard.index', [
            'title' => "Dashboard",
            'buku' => $buku,
            'peminjaman' => $peminjaman,
            'denda' => $denda,
            'peminjamanToday' => $peminjamanToday,
        ]);
    }

    public function dpetugas() {
        $user = Auth::user();
        $petugas = Petugas::whereNot('email', $user->email)->get();

        return view('petugas.user.dpetugas.index', [
            'title' => "Petugas",
            'petugas' => $petugas
        ]);
    }

    public function detailPetugas($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->alamat = json_decode($petugas->alamat, true);
        
        return view('petugas.user.dpetugas.detailPetugas', [
            'title' => "Detail",
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

    public function detailBuku($slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        
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

    public function detailPeminjam($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->alamat = json_decode($peminjam->alamat, true);

        return view('petugas.user.dpeminjam.detailPeminjam', [
            'title' => "Detail",
            'peminjam' => $peminjam
        ]);
    }

    public function peminjaman(Request $request)
    {
        $peminjaman = Peminjaman::with(['buku', 'peminjam', 'petugas'])->whereNot('status', 'dikembalikan')->get();
        
        return view('petugas.peminjaman.index', [
            'title' => "Peminjaman",
            'peminjaman' => $peminjaman
        ]);
    }

    public function riwayatPeminjaman(Request $request)
    {
        $query = Peminjaman::where('status', 'dikembalikan');

        $filterBulan = $request->input('filterBulan');

        if ($filterBulan && $filterBulan !== 'semua') {
            $query->whereMonth('created_at', $filterBulan)
                ->whereYear('created_at', Carbon::now()->year);
        }

        $riwayatPeminjaman = $query->get();

        $riwayatPeminjaman->each(function ($peminjaman) {
            $peminjaman->has_denda = Denda::where('id_peminjaman', $peminjaman->id)->exists();
        });

        return view('petugas.riwayatPeminjaman.index', [
            'title' => "Riwayat Peminjaman",
            'riwayatPeminjaman' => $riwayatPeminjaman,
        ]);
    }

    public function denda(Request $request) {
        $query = Denda::with(['peminjaman.buku', 'peminjaman.peminjam']);
        $filterBulan = $request->input('filterBulan');

        if ($filterBulan && $filterBulan !== 'semua') {
            $query->whereMonth('created_at', $filterBulan)
                ->whereYear('created_at', Carbon::now()->year);
        }

        $denda = $query->get();

        $denda->each(function ($peminjaman) {
            $peminjaman->has_denda = Denda::where('id_peminjaman', $peminjaman->id)->exists();
        });
        
        return view('petugas.denda.index', [
            'title' => "Denda",
            'denda' => $denda,
        ]);
    }

    public function ulasan() 
    {
        $buku = ListKategori::with(['buku', 'kategori'])->get();

        return view('petugas.ulasan.index', [
            'title' => "Ulasan",
            'buku' => $buku,
        ]);
    }

    public function detailUlasan($slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        $ulasan = Ulasan::with(['buku', 'peminjam'])->where('id_buku', $buku->id)->get();
        $check = Ulasan::where('id_buku', $buku->id)->exists();

        return view('petugas.ulasan.detailUlasan', [
            'title' => "Ulasan",
            'buku' => $buku,
            'ulasan' => $ulasan,
            'check' => $check,
        ]);
    }
}
