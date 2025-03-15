<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Exports\DendaExport;
use App\Exports\KategoriExport;
use App\Exports\ListKategoriExport;
use App\Exports\PeminjamanExport;
use App\Exports\PeminjamExport;
use App\Exports\PetugasExport;
use App\Exports\RiwayatPeminjamanExport;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPetugas(Request $request)
    {
        $dataPetugas = Petugas::all();

        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.user.dpetugas.export-pdf', compact('dataPetugas'));
            return $pdf->download('data_petugas.pdf');
        } else {
            return Excel::download(new PetugasExport, 'data_petugas.xlsx');
        }
    }

    public function exportBuku(Request $request)
    {
        $dataBuku = Buku::all();
        
        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.buku.export-pdf', compact('dataBuku'));
            return $pdf->download('data_buku.pdf');
        } else {
            return Excel::download(new BukuExport, 'data_buku.xlsx');
        }
    }

    public function exportKategori(Request $request)
    {
        $dataKategori = Kategori::all();
        
        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.kategori.export-pdf', compact('dataKategori'));
            return $pdf->download('data_kategori.pdf');
        } else {
            return Excel::download(new KategoriExport, 'data_kategori.xlsx');
        }
    }

    public function exportListKategori(Request $request)
    {
        $dataListKategori = ListKategori::with(['buku', 'kategori'])->whereNull('deleted_at')->get();
        
        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.listKategori.export-pdf', compact('dataListKategori'));
            return $pdf->download('data_list_kategori.pdf');
        } else {
            return Excel::download(new ListKategoriExport, 'data_list_kategori.xlsx');
        }
    }

    public function exportPeminjam(Request $request)
    {
        $dataPeminjam = Peminjam::all();

        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.user.dpeminjam.export-pdf', compact('dataPeminjam'));
            return $pdf->download('data_peminjam.pdf');
        } else {
            return Excel::download(new PeminjamExport, 'data_peminjam.xlsx');
        }   
    }

    public function exportPeminjaman(Request $request)
    {
        $dataPeminjaman = Peminjaman::with(['buku', 'peminjam', 'petugas'])->whereNot('status', 'dikembalikan')->get();

        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.peminjaman.export-pdf', compact('dataPeminjaman'));
            return $pdf->download('data_peminjaman.pdf');
        } else {
            return Excel::download(new PeminjamanExport, 'data_peminjaman.xlsx');
        }   
    }

    public function exportRiwayatPeminjaman(Request $request)
    {
        $dataRiwayatPeminjaman = Peminjaman::with(['buku', 'peminjam', 'petugas'])->where('status', 'dikembalikan')->get();

        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.riwayatPeminjaman.export-pdf', compact('dataRiwayatPeminjaman'));
            return $pdf->download('data_riwayat_peminjaman.pdf');
        } else {
            return Excel::download(new RiwayatPeminjamanExport, 'data_riwayat_peminjaman.xlsx');
        } 
    }

    public function exportDenda(Request $request)
    {
        $dataDenda = Denda::with(['peminjaman.buku', 'peminjaman.peminjam'])->get();

        if($request->format == 'pdf'){
            $pdf = Pdf::loadView('petugas.denda.export-pdf', compact('dataDenda'));
            return $pdf->download('data_denda.pdf');
        } else {
            return Excel::download(new DendaExport, 'data_denda.xlsx');
        } 
    }
}
