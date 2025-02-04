<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;
    
    protected $table = 'kategoris';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'kategori',
    ];
}
