<?php

namespace App\Providers;

use App\Models\Kategori;
use App\Models\Koleksi;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PeminjamProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['peminjam.layout.layout', 'peminjam.layout.nav'], function($view){
            $user = Auth::check();
            $cekUser = Auth::user();
            $peminjam = Peminjam::where('email', $cekUser->email)->first();
            
            $kategori = DB::table('kategoris')
            ->join('list_kategoris', 'list_kategoris.id_kategori', '=', 'kategoris.id')
            ->join('bukus', 'bukus.id', '=', 'list_kategoris.id_buku')
            ->select(
                'kategoris.id',
                'kategoris.kategori',
                'kategoris.slug',
                )
            ->distinct()
            ->get();

            $countKoleksi = Koleksi::where('id_peminjam', $peminjam->id)->count();
            $countPeminjaman = Peminjaman::where('id_peminjam', $peminjam->id)->withTrashed()->count();
            
            $view->with([
                'user' => $user,
                'kategori' => $kategori,
                'peminjam' => $peminjam,
                'countKoleksi' => $countKoleksi,
                'countPeminjaman' => $countPeminjaman,
            ]);
        });
    }
}
