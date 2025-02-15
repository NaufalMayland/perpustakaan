<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function editPetugas()
    {
        
    }

    public function editPetugasAction()
    {
        
    }

    public function editBuku($id)
    {
        $buku = Buku::findOrFail($id);

        return view('petugas.buku.editBuku', [
            'title' => "Edit",
            'buku' => $buku
        ]);
    }

    public function editBukuAction(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        
        return redirect()->route('petugas.buku.detailBuku', $id);
    }

    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('petugas.kategori.editKategori', [
            'title' => "Edit",
            'kategori' => $kategori
        ]);
    }

    public function editKategoriAction(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('petugas.kategori.index');
    }

    public function editListKategori($id)
    {
        $buku = Buku::where('id', $id)->first();
        // dd($buku);
        $kategori = Kategori::all();

        $selectedKategori = ListKategori::where('id_buku', $id)->pluck('id_kategori')->toArray();

        return view('petugas.listKategori.editListKategori', [
            'title' => "Edit",
            'buku' => $buku,
            'kategori' => $kategori,
            'selectedKategori' => $selectedKategori,
        ]);        
    }

    public function editListKategoriAction(Request $request, $id)
    {
        $checkedKategori = $request->kategori ?? [];
        $listKategori = ListKategori::where('id_buku', $id)->forceDelete();
        
        foreach($checkedKategori as $kategori) {
            ListKategori::create([
                'id_buku' => $id,
                'id_kategori' => $kategori
            ]);
        }

        return redirect()->route('petugas.listKategori.index');
    }

    public function editPeminjam()
    {
        
    }

    public function editPeminjamAction()
    {
        
    }

    public function editPeminjaman()
    {
        
    }

    public function editPeminjamanAction()
    {
        
    }

    public function editProfilPeminjam($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        // dd($peminjam);

        return view('peminjam.editProfil', [
            'title' => "Edit Profil",
            'peminjam' => $peminjam
        ]);
    }
}
