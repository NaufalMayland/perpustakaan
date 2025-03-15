<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportExcelController extends Controller
{
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
}
