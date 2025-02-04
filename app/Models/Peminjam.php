<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjam extends Model
{
    use SoftDeletes;
    
    protected $table = "peminjams";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
        'foto',
    ];
}
