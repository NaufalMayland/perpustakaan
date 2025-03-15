<?php

namespace App\Http\Controllers;

use App\Exports\TemplateBuku;
use App\Exports\TemplateKategori;
use App\Imports\ImportBuku;
use App\Imports\ImportKategori;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function importBuku()
    {
        return view('petugas.buku.importBuku', [
            'title' => "Import"
        ]);
    }

    public function DownloadTemplateBuku()
    {
        return Excel::download(new TemplateBuku, 'template_buku.xlsx');
    }

    public function importBukuAction(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ImportBuku, $request->file('file'));

        return redirect()->route('petugas.buku.index');
    }

    public function importKategori()
    {
        return view('petugas.kategori.importKategori', [
            'title' => "Import"
        ]);
    }

    public function DownloadTemplateKategori()
    {
        return Excel::download(new TemplateKategori, 'template_kategori.xlsx');
    }

    public function importKategoriAction(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ImportKategori, $request->file('file'));

        return redirect()->route('petugas.kategori.index');
    }
}
