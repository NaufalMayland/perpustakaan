<?php

namespace App\Providers;

use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PetugasProvider extends ServiceProvider
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
        View::composer(['petugas.layout.layout', 'petugas.layout.nav'], function($view){
            $user = Auth::user();
            $sesPetugas = Petugas::where('email', $user->email)->first();

            $view->with([
                'sesPetugas' => $sesPetugas,
            ]);
        });
    }
}
