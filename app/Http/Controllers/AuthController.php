<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => "Login",
        ]);
    } 

    public function loginAction(Request $request)
    {
        $cek = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $cek['email'])->first(['password', 'role_id']);

        if($user == null){
            return redirect()->back()->withErrors('Pengguna tidak ditemukan')->withInput();
        }
        
        if(!Hash::check($cek['password'], $user->password)){
            return redirect()->back()->withErrors('Password tidak sesuai')->withInput();
        }

        if(Auth::attempt($cek)){
            $request->session()->regenerate();

            if($user->role_id == 1){
                return redirect(route('peminjam.home'));
            } elseif($user->role_id == 2){
                return redirect(route('petugas.dashboard.index'));
            } else {
                return redirect()->back()->withErrors('Akun tidak ada')->withInput();
            }
        }
    }

    public function register()
    {
        return view('auth.register', [
            'title' => "Register",
        ]);
    }

    public function RegisterAction(Request $request)
    {
        $dataRegist = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        if($dataRegist){
            Peminjam::create([
                'nama' => $request->username,
                'email' => $request->email,
                'uid' => $request->password,
            ]);
        }

        return redirect(route('auth.login'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('auth.login'));
    }
}
