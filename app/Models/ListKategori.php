<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListKategori extends Model
{
    protected $table = 'list_kategoris';
    protected $fillable = [
        'id_buku',
        'id_kategori',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
