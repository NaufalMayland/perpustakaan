<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;
    
    protected $table = 'bukus';
    protected $dates = ['deleted_at'];
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
