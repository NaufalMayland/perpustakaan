<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'dendas';
    protected $fillable = [
        'id_peminjaman',
        'status'
    ];
}
