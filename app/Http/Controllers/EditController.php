<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function editPetugas($id)
    {
        $petugas = Petugas::findOrFail($id);

        return view('petugas.user.dpetugas.editPetugas', [
            'title' => "Edit",
            'petugas' => $petugas
        ]);
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
    $buku = Buku::findOrfail($id);
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'stok' => 'required',
        'kode' => 'required',
        'deskripsi' => 'required',
        'cover_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'cover_url' => 'nullable',
    ]);

    if ($request->hasFile('cover_file')) {
        $filename = time() . '.' . $request->file('cover_file')->getClientOriginalExtension();
        $imagePath = $request->file('cover_file')->storeAs('cover', $filename, 'public');
    } elseif ($request->cover_url) {
        $imagePath = $request->cover_url;
    }

    $buku->update([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'deskripsi' => $request->deskripsi,
        'tahun_terbit' => $request->tahun_terbit,
        'kode' => $request->kode,
        'stok' => $request->stok,
        'cover' => $imagePath,
    ]);

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

        return view('peminjam.editProfil', [
            'title' => "Edit Profil",
            'peminjam' => $peminjam
        ]);
    }

    public function editProfilPeminjamAction(Request $request, $id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->update([
            'alamat' => $request->wilayah,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('peminjam.profil');
    }

    public function editStatusPeminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }
}
