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
use Carbon\Carbon;
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
        $peminjaman = Peminjaman::with(['peminjam', 'buku', 'petugas'])->whereNot('status', 'dikembalikan')->get();
        return view('petugas.peminjaman.printPeminjaman', [
            'title' => "Print",
            'peminjaman' => $peminjaman
        ]);
    }

    public function printRiwayatPeminjaman(Request $request)
    {
        $query = Peminjaman::with(['buku', 'peminjam', 'petugas'])->where('status', 'dikembalikan');

        $filterBulan = $request->input('filterBulan');

        if ($filterBulan && $filterBulan !== 'semua') {
            $query->whereMonth('tanggal_pinjam', $filterBulan)
                  ->whereYear('tanggal_pinjam', Carbon::now()->year);
        }
    
        $riwayatPeminjaman = $query->get();
        return view('petugas.riwayatPeminjaman.printRiwayatPeminjaman', [
            'title' => "Print",
            'riwayatPeminjaman' => $riwayatPeminjaman
        ]);
    }

    public function printDenda(Request $request)
    {
        $query = Denda::with(['peminjaman.buku', 'peminjaman.peminjam']);

        $filterBulan = $request->input('filterBulan');

        if ($filterBulan && $filterBulan !== 'semua') {
            $query->whereHas('peminjaman', function ($query) use ($filterBulan) {
                $query->whereMonth('tanggal_pinjam', $filterBulan)
                    ->whereYear('tanggal_pinjam', Carbon::now()->year);
            });
        }
    
        $denda = $query->get();
        return view('petugas.denda.printDenda', [
            'title' => "Print",
            'denda' => $denda
        ]);
    }
}
