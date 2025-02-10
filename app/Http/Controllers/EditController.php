<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function editListKategori()
    {
        
    }

    public function editListKategoriAction()
    {
        
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
