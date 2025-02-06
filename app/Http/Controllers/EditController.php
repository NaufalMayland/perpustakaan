<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

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

    public function editKategori()
    {
        
    }

    public function editKategoriAction()
    {
        
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
}
