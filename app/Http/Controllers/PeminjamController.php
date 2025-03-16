<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\ListKategori;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    public function index()
    {
        $buku = Buku::withCount('peminjaman')
        ->orderByDesc('peminjaman_count')
        ->having('peminjaman_count', '>', 0)
        ->get();

        $bukuKategori = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNull('bukus.deleted_at')
        ->select(
            'kategoris.id as id_kategori',
            'kategoris.kategori',
            'bukus.id as id_buku',
            'bukus.cover',
            'bukus.judul',
            'bukus.slug',
        )
        ->get()
        ->groupBy('id_kategori');

        return view('peminjam.index', [
            'title' => "Home",
            'buku' => $buku,
            'bukuKategori' => $bukuKategori,
        ]);
    }

    public function detailBuku($slug)
    {
        $peminjam = Peminjam::where('email', Auth::user()->email)->first();
        $buku = ListKategori::whereHas('buku', function ($query) use ($slug){
            $query->where('slug', $slug);
        })
        ->first();

        $ulasan = Ulasan::with(['peminjam'])
        ->whereHas('buku', function ($query) use ($slug){
            $query->where('slug', $slug);
        })
        ->whereNot('id_peminjam', $peminjam->id)
        ->get();

        $ulasanCount = Ulasan::whereHas('buku', function ($query) use ($slug){
            $query->where('slug', $slug);
        })
        ->count();

        $ulasanKu = Ulasan::whereHas('buku', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
        ->whereHas('peminjam', function ($query) use ($peminjam) {
            $query->where('id', $peminjam->id);
        })
        ->get();
    
        $getKategori = ListKategori::with('kategori')
        ->whereHas('buku', function ($query) use ($slug){
            $query->where('slug', $slug);
        })
        ->get()
        ->pluck('kategori.kategori')->implode(', ');

        return view('peminjam.detailBuku', [
            'title' => $buku->buku->judul,
            'buku' => $buku,
            'ulasan' => $ulasan,
            'ulasanCount' => $ulasanCount,
            'ulasanKu' => $ulasanKu,
            'getKategori' => $getKategori,
        ]);
    }

    public function profil()
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();
        $peminjam->alamat = json_decode($peminjam->alamat, true);

        return view('peminjam.profil', [
            'title' => "Profil",
            'user' => $user,
            'peminjam' => $peminjam,
        ]);
    }

    public function searchBuku(Request $request)
    {
        if($request->search !== null){
            $buku = DB::table('list_kategoris')
            ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
            ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
            ->whereNull('list_kategoris.deleted_at')
            ->when($request->search, function ($query) use ($request) {
                $query->where('bukus.judul', 'like', '%' . $request->search . '%');
            })
            ->select(
                'bukus.id',
                'bukus.cover',
                'bukus.judul'
            )
            ->groupBy('bukus.id', 'bukus.judul', 'bukus.cover')
            ->get();
        } else{
            return redirect()->back();
        }

        return view('peminjam.searchBuku', [
            'title' => "Home",
            'buku' => $buku,
            'header' => $request->search
        ]);
    }

    public function searchByKategori(Request $request, $slug)
    {
        $buku = DB::table('list_kategoris')
        ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->whereNull('list_kategoris.deleted_at')
        ->when($slug, function ($query) use ($slug) {
            $query->where('kategoris.slug', $slug);
        })
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul',
            'bukus.slug'
        )
        ->groupBy('bukus.id', 'bukus.judul', 'bukus.cover')
        ->get(); 

        $header = Kategori::where('slug', $slug)->first();

        return view('peminjam.searchKategori', [
            'title' => "Home",
            'buku' => $buku,
            'header' => $header,
        ]);
    }

    public function koleksiBuku()
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();

        $koleksi = DB::table('koleksis')
        ->join('bukus', 'bukus.id', '=', 'koleksis.id_buku')
        ->join('list_kategoris', 'list_kategoris.id_buku', '=', 'bukus.id')
        ->join('kategoris', 'kategoris.id', '=', 'list_kategoris.id_kategori')
        ->where('koleksis.id_peminjam', $peminjam->id)
        ->whereNull('bukus.deleted_at')
        ->select(
            'bukus.id',
            'bukus.cover',
            'bukus.judul',
            'bukus.slug',
            'bukus.penulis',
            'bukus.stok',
            DB::raw("GROUP_CONCAT(kategoris.kategori SEPARATOR ', ') as kategori")
        )
        ->groupBy('bukus.id', 'bukus.judul')
        ->get();

        return view('peminjam.koleksi', [
            'title' => "Koleksi",
            'koleksi' => $koleksi,
        ]);
    }

    public function peminjamanBuku()
    {
        $user = Auth::user();
        $peminjam = Peminjam::where('email', $user->email)->first();
        $peminjaman = Peminjaman::with(['buku', 'peminjam'])->where('id_peminjam', $peminjam->id)->withTrashed()->get();

        return view('peminjam.peminjaman', [
            'title' => "Peminjaman",
            'peminjaman' => $peminjaman,
        ]);
    }

    public function detailPeminjaman($id)
    {
        $peminjaman = Peminjaman::with(['buku', 'peminjam', 'petugas'])->findOrFail($id);

        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);
        $hariPerpanjangan = $tanggalKembali->subDay()->format('Y-m-d');
        $hariSekarang = Carbon::now()->format('Y-m-d');

        $perpanjangan = $hariPerpanjangan == $hariSekarang;
        
        return view('peminjam.detailPeminjaman', [
            'title' => "Detail",
            'peminjaman' => $peminjaman,
            'perpanjangan' => $perpanjangan,
        ]);
    }
}
