<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deletePetugas($id){
        $user = Petugas::findOrFail($id);
        $user->delete();
        
        return redirect()->route('petugas.user.dpetugas.index');
    }

    public function trashPetugas() 
    {
        $trash = Petugas::onlyTrashed()->get();
        
        return view('petugas.user.dpetugas.trashPetugas', [
            'title' => "Trash",
            'trashPetugas' => $trash,
        ]);
    }

    public function restorePetugas($id)
    {
        $restore = Petugas::onlyTrashed()->find($id);
        $restore->restore();

        return redirect()->route('petugas.user.dpetugas.trashPetugas');
    }

    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect()->route('petugas.buku.index');
    }

    public function trashBuku()
    {
        $trash = Buku::onlyTrashed()->get();

        return view('petugas.buku.trashBuku', [
            'title' => "Trash",
            'trash' => $trash
        ]);
    }

    public function restoreBuku($id) 
    {
           $restore = Buku::onlyTrashed()->find($id);
           $restore->restore();

           return redirect()->route('petugas.buku.trashBuku');
    }

    public function deleteKategori($id){
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('petugas.kategori.index');
    }

    public function trashKategori()
    {
        $trash = Kategori::onlyTrashed()->get();

        return view('petugas.kategori.trashKategori', [
            'title' => "Trash",
            'trash' => $trash,
        ]);
    }

    public function restoreKategori($id)
    {
        $restore = Kategori::onlyTrashed()->find($id);
        $restore->restore();

        return redirect()->route('petugas.kategori.trashKategori');
    }

    public function deleteListKategori($id){
        $listKategori = ListKategori::find($id);
        $listKategori->delete();

        return redirect()->route('petugas.listKategori.index');
    }

    public function trashListKategori()
    {
        $trash = ListKategori::onlyTrashed()->get();
        
        return view('petugas.listKategori.trashListKategori', [
            'title' => "Trash",
            'trash' => $trash
        ]);
    }

    public function restoreListKategori($id)
    {
        $restore = ListKategori::onlyTrashed()->find($id);
        $restore->restore();

        return redirect()->route('petugas.listKategori.trashListKategori');
    }

    public function deletePeminjam($id){
        $user = Peminjam::find($id);
        $user->delete();
        
        return redirect()->route('petugas.user.dpeminjam.index');
    }

    public function trashPeminjam()
    {
        $trash = Peminjam::onlyTrashed()->get();

        return view('petugas.user.dpeminjam.trashPeminjam', [
            'title' => "Trash",
            'trash' => $trash
        ]);
    }

    public function restorePeminjam($id)
    {
        $restore = Peminjam::onlyTrashed()->find($id);
        $restore->restore();

        return redirect()->route('petugas.user.dpeminjam.trashPeminjam');
    }
}
