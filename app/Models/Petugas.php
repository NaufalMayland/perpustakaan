<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petugas extends Model
{
    use SoftDeletes;
    
    protected $table = "petugas";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
        'foto',
        'role'
    ];
}
