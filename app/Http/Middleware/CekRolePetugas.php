<?php

namespace App\Http\Middleware;

use App\Models\Petugas;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRolePetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rolePetugas): Response
    {
        $user = Auth::user();
        $sesPetugas = Petugas::where('email', $user->email)->first();

        if($rolePetugas == 'admin'){
            if($sesPetugas->role == 'admin'){
                return $next($request);
            } else {
                return redirect()->back();
            }
        } elseif ($rolePetugas == 'petugas'){
            if($sesPetugas->role == 'petugas'){
                return $next($request);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
