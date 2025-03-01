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
        'cover',
    ];

    public function listKategori()
    {
        return $this->hasMany(ListKategori::class, 'id_buku', 'id')->withTrashed();
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_buku', 'id');
    }
    
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku', 'id');
    }
}
