<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportExcelController extends Controller
{
    public function importPetugas()
    {
        return view('petugas.user.dpetugas.importPetugas', [
            'title' => "Import"
        ]);
    }

    public function importBuku()
    {
        return view('petugas.buku.importBuku', [
            'title' => "Import"
        ]);
    }

    public function importKategori()
    {
        return view('petugas.kategori.importKategori', [
            'title' => "Import"
        ]);
    }

    public function importListKategori()
    {
        return view('petugas.listKategori.importListKategori', [
            'title' => "Import"
        ]);
    }

    public function importPeminjam()
    {
        return view('petugas.user.dpeminjam.importPeminjam', [
            'title' => "Import"
        ]);
    }

    public function templatePeminjam()
    {
        $templatePath = storage_path('app/public/templateExcel/UserTemplate.xlsx');

        if (!file_exists($templatePath)) {
            abort(404, 'File template tidak ditemukan.');
        }

        $fileName = 'UserTemplate.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return response()->download($templatePath, $fileName, $headers);
    }

    public function importPeminjaman()
    {
        return view('petugas.peminjaman.importPeminjaman', [
            'title' => "Import"
        ]);
    }
}
