<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function deletePetugas($id){
        $user = Petugas::findOrFail($id);
        $user->delete();
        
        return redirect()->route('petugas.user.dpetugas.index')->with('success', 'Data berhasil dihapus');
    }

    public function trashPetugas() 
    {
        $trash = Petugas::onlyTrashed()->get();
        
        return view('petugas.user.dpetugas.trashPetugas', [
            'title' => "Trash",
            'trash' => $trash,
        ]);
    }

    public function restorePetugas($id)
    {
        $restore = Petugas::onlyTrashed()->find($id);
        $restore->restore();

        return redirect()->route('petugas.user.dpetugas.trashPetugas')->with('success', 'Data berhasil direstore');
    }

    public function destroyPetugas($id)
    {
        $petugas = Petugas::onlyTrashed()->find($id);
        $petugas->forceDelete();

        return redirect()->route('petugas.user.dpetugas.trashPetugas')->with('success', 'Data berhasil dihapus');
    }

    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        $peminjaman = Peminjaman::where('id_buku', $id)->first();

        $check = Peminjaman::where('id_buku', $id)->exists();

        if ($check == false) {
            $buku->delete();
        } elseif($check == true && $peminjaman->status == 'proses'){
            $buku->delete();
            $deletePeminjaman = $peminjaman->forceDelete();
            if ($deletePeminjaman) {
                $buku->update([
                    'stok' => $buku->stok + $peminjaman->jumlah
                ]);
            }
        }
        elseif($peminjaman->status == 'siap diambil' || $peminjaman->status == 'dipinjam' || $peminjaman->status == 'diperpanjang'){
            return redirect()->back()->with('errors', 'Buku sedang dipinjam');
        }

        return redirect()->route('petugas.buku.index')->with('success', 'Data berhasil dihapus');
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

           return redirect()->route('petugas.buku.trashBuku')->with('success', 'Data berhasil direstore');
    }

    public function destroyBuku($id)
    {
        $buku = Buku::onlyTrashed()->find($id);
        $buku->forceDelete();

        return redirect()->route('petugas.buku.trashBuku')->with('success', 'Data berhasil dihapus');
    }

    public function deleteKategori($id){
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('petugas.kategori.index')->with('success', 'Data berhasil dihapus');
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

        return redirect()->route('petugas.kategori.trashKategori')->with('success', 'Data berhasil direstore');
    }

    public function destroyKategori($id)
    {
        $kategori = Kategori::onlyTrashed()->find($id);
        $kategori->forceDelete();

        return redirect()->route('petugas.kategori.trashKategori')->with('success', 'Data berhasil dihapus');
    }

    public function deleteListKategori($id){
        $listKategori = ListKategori::where('id_buku', $id)->delete(); 

        return redirect()->route('petugas.listKategori.index')->with('success', 'Data berhasil dihapus');
    }

    public function trashListKategori()
    {
        $trash = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNotNull('list_kategoris.deleted_at')
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul',
            DB::raw("GROUP_CONCAT(list_kategoris.id SEPARATOR ', ') as id_list"),
            DB::raw("GROUP_CONCAT(kategoris.kategori SEPARATOR ', ') as kategori")
        )
        ->groupBy('bukus.id', 'bukus.judul')
        ->get();

        return view('petugas.listKategori.trashListKategori', [
            'title' => "Trash",
            'trash' => $trash
        ]);
    }

    public function restoreListKategori($id)
    {
        $restore = ListKategori::onlyTrashed()->where('id_buku', $id)->restore();

        return redirect()->route('petugas.listKategori.trashListKategori')->with('success', 'Data berhasil direstore');
    }

    public function destroyListKategori($id)
    {
        $listKategori = ListKategori::onlyTrashed()->where('id_buku', $id)->forceDelete();

        return redirect()->route('petugas.listKategori.trashListKategori')->with('success', 'Data berhasil dihapus');
    }

    public function deletePeminjam($id){
        $user = Peminjam::find($id);
        $user->delete();
        
        return redirect()->route('petugas.user.dpeminjam.index')->with('success', 'Peminjam berhasil dihapus');
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

        return redirect()->route('petugas.user.dpeminjam.trashPeminjam')->with('success', 'Data berhasil direstore');
    }

    public function destroyPeminjam($id)
    {
        $peminjam = Peminjam::onlyTrashed()->find($id);
        $peminjam->forceDelete();

        return redirect()->route('petugas.user.dpeminjam.trashPeminjam')->with('success', 'Data berhasil dihapus');
    }

    public function destroyPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $delete = $peminjaman->forceDelete();
        if ($delete) {
            $buku = Buku::findOrFail($peminjaman->id_buku);
            $buku->update([
                'stok' => $buku->stok + $peminjaman->jumlah
            ]);
        }
        
        return redirect()->back();
    }

    public function destroyUlasan($id)
    {
        $peminjam = Peminjam::where('email', Auth::user()->email)->first();
        
        Ulasan::findOrFail($id)->forceDelete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus');
    }
}
