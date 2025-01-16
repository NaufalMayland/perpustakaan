<?php

namespace App\Providers;

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
            // dd($user);
            $view->with([
                'user' => $user,
            ]);
        });
    }
}
