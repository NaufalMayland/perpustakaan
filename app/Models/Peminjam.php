<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $table = "peminjams";
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
        'foto',
    ];
}
