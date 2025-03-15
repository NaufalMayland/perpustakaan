<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index', [
            'title' => "Perpustakaan",
        ]);
    }
    public function login()
    {
        return view('auth.login', [
            'title' => "Login",
        ]);
    } 

    public function loginAction(Request $request)
    {
        $cek = $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
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
                return redirect()->route('peminjam.index');
            } elseif($user->role_id == 2){
                return redirect()->route('petugas.dashboard.index');
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
        $cekUser = User::all();

        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
            'password' => 'min:6'
        ]);

        foreach($cekUser as $user){
            if($request->email == $user->email){
                return redirect()->back()->withErrors('Email sudah tersedia, mohon gunakan email yang lain!')->withInput();
            }
        }

        if($request->konfirmasiPw !== $request->password){
            return redirect()->back()->withErrors('Konfirmasi password salah')->withInput();
        }

        $dataRegist = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($dataRegist){
            Peminjam::create([
                'nama' => $request->username,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword', [
            'title' => 'Login'
        ]);
    }

    public function forgotPasswordAction(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user == null){
            return redirect()->back()->withErrors('Pengguna tidak ditemukan')->withInput();
        }

        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
            'password' => 'min:6'
        ]);

        if($request->konfirmasiPw !== $request->password){
            return redirect()->back()->withErrors('Konfirmasi password salah')->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('auth.login');
    }

    public function ubahPasswordPeminjam(Request $request, $id)
    {
        $request->validate([
            'password' => 'min:6'
        ]);

        $peminjam = Peminjam::findOrFail($id);
        $user = User::where('email', $peminjam->email)->first();    

        if($request->konfirmasiPassword !== $request->password){
            return redirect()->back()->with('errors', 'Konfirmasi password salah');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back();
    }

    public function ubahPasswordPetugas(Request $request, $id)
    {
        $request->validate([
            'password' => 'min:6'
        ]);

        $petugas = Petugas::findOrFail($id);
        $user = User::where('email', $petugas->email)->first();    

        if($request->konfirmasiPassword !== $request->password){
            return redirect()->back()->with('errors', 'Konfirmasi password salah');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back();
    }

    public function ubahPasswordDpeminjam(Request $request, $id)
    {
        $request->validate([
            'password' => 'min:6'
        ]);

        $peminjam = Peminjam::findOrFail($id);
        $user = User::where('email', $peminjam->email)->first();    

        if($request->konfirmasiPassword !== $request->password){
            return redirect()->back()->with('errors', 'Konfirmasi password salah');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back();
    }
}
