<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Koleksi;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\Role;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user){
            Peminjam::create([
                'nama' => $request->username,
                'email' => $request->email,
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

        if ($request->hasFile('cover_file')) {
            $filename = time() . '.' . $request->file('cover_file')->getClientOriginalExtension();
            $imagePath = $request->file('cover_file')->storeAs('cover', $filename, 'public');
        } else {
            $imagePath = $request->cover_url; 
        }

        Buku::insert([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'cover' => $imagePath,
        ]);

        return redirect()->route('petugas.buku.index');
    }

    public function addKategori()
    {
        return view('petugas.kategori.addKategori', [
            'title' => "Tambah Data"
        ]);
    }
  
    public function addKategoriAction(Request $request)
    {
        Kategori::updateOrCreate([
            'kategori' => $request->kategori,
        ]);
        
        return redirect()->route('petugas.kategori.index');
    }

    public function addListKategori()
    {
        $dataBuku = Buku::withoutTrashed()->get();
        $dataKategori = Kategori::withoutTrashed()->get();

        return view('petugas.listKategori.addListKategori', [
            'title' => "Tambah Data",
            'dataBuku' => $dataBuku,
            'dataKategori' => $dataKategori
        ]);
    }

    public function addListKategoriAction(Request $request)
    {
        $checkedKategori = $request->kategori ?? [];

        foreach ($checkedKategori as $kategori) {
            ListKategori::create([
                'id_buku' => $request->buku,
                'id_kategori' => $kategori,
            ]);
        }

        return redirect()->route('petugas.listKategori.index');
    }

    public function addPeminjaman()
    {
        return view('petugas.peminjaman.addPeminjaman', [
            'title' => "Tambah Data",
        ]);
    }

    public function addUlasanAction(Request $request, $id)
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();

        Ulasan::create([
            'id_buku' => $id,
            'id_peminjam' => $peminjam->id,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->back();
    }

    public function addKoleksiAction($id)
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();

        $check = Koleksi::whereHas('buku', function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->whereHas('peminjam', function ($query) use ($peminjam) {
            $query->where('id', $peminjam->id);
        })
        ->exists();

        if ($check) {
            return redirect()->back();
        } else {
            Koleksi::create([
                'id_peminjam' => $peminjam->id,
                'id_buku' => $id,
            ]);
        }

        return redirect()->back();
    }

    public function addPeminjamanAction(Request $request, $id)
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();

        $checkProfil = Peminjam::where('email', $user->email)
        ->where('alamat', null)
        ->where('telepon', null)
        ->exists();

        if ($checkProfil == true) {
            return redirect()->route('peminjam.profil')->withErrors('Lengkapi profil terlebih dahulu!');
        }
        
        $peminjaman = Peminjaman::create([
            'id_peminjam' => $peminjam->id,
            'id_buku' => $id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
        ]);

        if($peminjaman){
            $buku = Buku::where('id', $id)->first();
            $buku->update([
                'stok' => $buku->stok - $request->jumlah
            ]);
        }

        return redirect()->back();
    }
}
