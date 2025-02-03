<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

    class InputController extends Controller
{
    public function addPetugas()
    {
        return view('petugas.user.dpetugas.addPetugas', [
            'title' => "Tambah Data",
        ]);
    }

    public function addPetugasAction(Request $request) 
    {
        $cekUser = User::all();
        
        foreach($cekUser as $user){
            if($request->email == $user->email){
                return redirect()->back()->withErrors('Email sudah tersedia, mohon gunakan email yang lain!')->withInput();
            }
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        if($user){
            Petugas::create([
                'nama' => $request->username,
                'email' => $request->email,
                'role' => $request->role
            ]);
        }

        return redirect(route('petugas.user.dpetugas.index'));
    }

    public function addPeminjam()
    {
        $roleData = Role::all();
        return view('petugas.user.dpeminjam.addPeminjam', [
            'title' => "Tambah Data",
            'roleData' => $roleData
        ]);
    }

    public function addPeminjamAction(Request $request)
    {
        $cekUser = User::all();
        
        foreach($cekUser as $user){
            if($request->email == $user->email){
                return redirect()->back()->withErrors('Email sudah tersedia, mohon gunakan email yang lain!')->withInput();
            }
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);

        if($request->role == 1){
            Peminjam::create([
                'nama' => $request->username,
                'email' => $request->email,
                'uid' => $request->password,
            ]);
        } elseif($request->role == 2){
            Petugas::create([
                'nama' => $request->username,
                'email' => $request->email,
                'uid' => $request->password,
            ]);
        }

        return redirect(route('petugas.user.dpeminjam.index'));
    }

    public function addBuku()
    {
        return view('petugas.buku.addBuku', [
            'title' => "Tambah Data"
        ]);
    }

    public function addBukuAction(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required',
        ]);
        
        Buku::insert([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('petugas.buku.index');
    }

    public function addKategoriAction(Request $request)
    {
        Kategori::updateOrCreate([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('petugas.kategori.index');
    }
    public function addListKategoriAction(Request $request)
    {
        ListKategori::create([
            'id_buku' => $request->buku,
            'id_kategori' => $request->kategori,
        ]);

        return redirect()->route('petugas.listKategori.index');
    }

    public function addPeminjaman()
    {
        $user = Auth::user();
        $petugas = Petugas::where('email', $user->email)->first();

        return view('petugas.peminjaman.addPeminjaman', [
            'title' => "Tambah Data",
            'petugas' => $petugas,
        ]);
    }
}
