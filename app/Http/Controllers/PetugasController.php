<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard() {
        return view('petugas.dashboard.index', [
            'title' => "Dashboard",
        ]);
    }

    public function user() {
        $dataUser = User::with(['role'])->get();
        return view('petugas.user.index', [
            'title' => "User",
            'dataUser' => $dataUser
        ]);
    }

    public function buku() {
        return view('petugas.buku.index', [
            'title' => "Buku",
        ]);
    }

    public function kategori() {
        return view('petugas.kategori.index', [
            'title' => "Kategori",
        ]);
    }

    public function listKategori() {
        return view('petugas.listKategori.index', [
            'title' => "List Kategori",
        ]);
    }

    public function peminjaman() {
        return view('petugas.peminjaman.index', [
            'title' => "Peminjaman",
        ]);
    }

    public function ulasan() {
        return view('petugas.ulasan.index', [
            'title' => "Ulasan",
        ]);
    }
}
