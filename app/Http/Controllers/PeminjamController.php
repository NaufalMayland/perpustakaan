<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function home(){
        return view('peminjam.home.index');
    }
}
