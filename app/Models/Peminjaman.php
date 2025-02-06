<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use SoftDeletes;
    
    protected $table = 'peminjamans';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_peminjam',
        'id_buku',
        'id_petugas',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status'
    ];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id');
    }
}
