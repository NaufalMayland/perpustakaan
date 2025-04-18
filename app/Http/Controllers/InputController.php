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
use Illuminate\Support\Facades\DB;
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
        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
            'password' => 'min:6'
        ]);

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

        return redirect()->route('petugas.user.dpetugas.index')->with('success', 'Data berhasil ditambahkan!');
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
        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
            'password' => 'min:6'
        ]);
        
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
                'id' => $request->nik,
                'nama' => $request->username,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('petugas.user.dpeminjam.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function addBuku()
    {
        $kategori = Kategori::all();
        return view('petugas.buku.addBuku', [
            'title' => "Tambah Data",
            'kategori' => $kategori
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

        $buku = Buku::create([
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

        if($buku){
            ListKategori::insert([
                'id_buku' => $buku->id,
                'id_kategori' => $request->kategori
            ]);
        }

        return redirect()->route('petugas.buku.index')->with('success', 'Data berhasil ditambahkan!');
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
            'slug' => Str::slug($request->kategori),
        ]);
        
        return redirect()->route('petugas.kategori.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function addListKategori()
    {
        $dataBuku = DB::table('bukus')
        ->leftJoin('list_kategoris', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->whereNull('list_kategoris.id_buku')
        ->select(
            'bukus.id',
            'bukus.judul',
            'bukus.slug',
            'bukus.kode',
        )
        ->get();

        $dataKategori = Kategori::withoutTrashed()->get();

        return view('petugas.listKategori.addListKategori', [
            'title' => "Tambah Data",
            'dataBuku' => $dataBuku,
            'dataKategori' => $dataKategori
        ]);
    }

    public function addListKategoriAction(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);
        $checkedKategori = $request->kategori ?? [];

        foreach ($checkedKategori as $kategori) {
            ListKategori::create([
                'id_buku' => $request->buku,
                'id_kategori' => $kategori,
            ]);
        }

        return redirect()->route('petugas.listKategori.index')->with('success', 'Data berhasil ditambahkan!');
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

    public function addPeminjamanAction(Request $request)
    {
        $peminjam = Peminjam::where('id', $request->peminjam)->first();
        $buku = Buku::where('kode', $request->buku)->first();

        if($peminjam == null){
            return redirect()->back()->withErrors('Peminjam tidak ditemukan!');
        } 

        if($buku == null){
            return redirect()->back()->withErrors('Buku tidak ditemukan!');
        } 

        $peminjaman = Peminjaman::create([
            'id_peminjam' => $peminjam->id,
            'id_buku' => $buku->id,
            'id_petugas' => $request->petugas,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        if($peminjaman){
            $buku = Buku::where('kode', $request->buku)->first();
            $buku->update([
                'stok' => $buku->stok - $request->jumlah
            ]);
        }

        return redirect()->route('petugas.peminjaman.index')->with('success', 'Data berhasil ditambahkan!');
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

        return redirect()->back()->with('success', 'Ditambahkan ke koleksi!');
    }

    public function PeminjamanAction(Request $request, $id)
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();

        $checkProfil = Peminjam::where('email', $user->email)
        ->where('alamat', null)
        ->where('telepon', null)
        ->exists();

        if ($checkProfil == true) {
            return redirect()->route('peminjam.profil')->with('error', 'Lengkapi profil terlebih dahulu!');
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

        return redirect()->back()->with('success', 'Peminjaman berhasil!');
    }

    public function addDenda(Request $request)
    {
        dd($request->all());
    }
}
