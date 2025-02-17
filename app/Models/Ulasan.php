<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';
    protected $fillable = [
        'id_buku',
        'id_peminjam', 
        'ulasan'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id');
    }
}
