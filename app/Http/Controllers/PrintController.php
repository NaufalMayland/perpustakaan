<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printPeminjam()
    {
        $userData = User::with('role')->get();
        return view('petugas.user.dpeminjam.printPeminjam', [
            'title' => "Print",
            'userData' => $userData
        ]);
    }
}
