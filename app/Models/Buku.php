<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'deskripsi',
        'tahun_terbit',
        'kode',
        'stok',
    ];
}
