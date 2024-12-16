<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard()
    {
        return view('petugas.dashboard.index', [
            'title' => "Dashboard",
        ]);
    }

    public function user()
    {
        return view('petugas.user.index', [
            'title' => "User"
        ]);
    }
}
