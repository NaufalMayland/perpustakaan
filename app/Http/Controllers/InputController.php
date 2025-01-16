<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Petugas;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InputController extends Controller
{
    public function addUser()
    {
        $roleData = Role::all();
        return view('petugas.user.addUser', [
            'title' => "Tambah Data",
            'roleData' => $roleData
        ]);
    }

    public function addUserAction(Request $request)
    {
        $cekUser = User::all();
        
        foreach($cekUser as $user){
            if($request->email == $user->email){
                return redirect()->back()->withErrors('Email sudah tersedia, mohon gunakan email yang lain!')->withInput();
            }
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);

        if($request->role == 1){
            Peminjam::create([
                'nama' => $request->username,
                'email' => $request->email,
                'uid' => $request->password,
            ]);
        } elseif($request->role == 2){
            Petugas::create([
                'nama' => $request->username,
                'email' => $request->email,
                'uid' => $request->password,
            ]);
        }

        return redirect(route('petugas.user.index'));
    }


}
