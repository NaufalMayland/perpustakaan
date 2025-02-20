<?php

namespace App\Providers;

use App\Models\Kategori;
use App\Models\Koleksi;
use App\Models\Peminjam;
use Illuminate\Support\Facades\Auth;
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
            $kategori = Kategori::all();
            $countKoleksi = Koleksi::where('id_peminjam', $peminjam->id)->count();
            
            $view->with([
                'user' => $user,
                'kategori' => $kategori,
                'countKoleksi' => $countKoleksi,
            ]);
        });
    }
}
