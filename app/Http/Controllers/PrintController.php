<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function userPrint()
    {
        $userData = User::with('role')->get();
        return view('petugas.user.printUser', [
            'title' => "Print",
            'userData' => $userData
        ]);
    }
}
