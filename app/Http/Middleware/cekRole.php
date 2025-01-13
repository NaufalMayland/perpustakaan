<?php

namespace App\Http\Middleware;

use App\Models\Peminjam;
use App\Models\Petugas;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors('Harap login terlebih dahulu!')->withInput();
        }

        $user = Auth::user();
        $petugas = Petugas::where('email', $user->email)->exists();
        $peminjam = Peminjam::where('email', $user->email)->exists();
        
        if (!$user) {
            return redirect('/')->withErrors('Harap login terlebih dahulu!')->withInput();
        }

        if($role == 'petugas'){
            if($petugas){
                return $next($request);
            } else {
                return redirect()->back()->withErrors('User tidak ditemukan')->withInput();
            }
        } elseif ($role == 'peminjam'){
            if($peminjam){
                return $next($request);
            } else {
                return redirect()->back()->withErrors('User tidak ditemukan')->withInput();
            }
        } else {
            return redirect()->back()->withErrors('User tidak ditemukan')->withInput();
        }

        return redirect()->back()->withErrors('Harap login terlebih dahulu!')->withInput();
    }
}
