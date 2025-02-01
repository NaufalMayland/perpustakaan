<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deletePeminjam($id){
        $user = User::find($id);
        $user->delete();
        
        return redirect(route('petugas.user.peminjam.index'));
    }

    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect(route('petugas.buku.index'));
    }

    public function deleteKategori($id){
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect(route('petugas.kategori.index'));
    }

    public function deleteListKategori($id){
        $listKategori = ListKategori::find($id);
        $listKategori->delete();

        return redirect(route('petugas.listKategori.index'));
    }
}
