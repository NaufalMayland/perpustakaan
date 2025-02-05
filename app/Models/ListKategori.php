<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListKategori extends Model
{
    use SoftDeletes;
    
    protected $table = 'list_kategoris';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_buku',
        'id_kategori',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id')->withTrashed();
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id')->withTrashed();
    }
}
