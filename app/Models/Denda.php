<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denda extends Model
{
    use SoftDeletes;
    
    protected $table = 'dendas';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_peminjaman',
        'status'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id');
    }
}
