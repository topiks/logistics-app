<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPB extends Model
{
    use HasFactory;

    protected $table = 'import_lpb';

    protected $fillable = 
    [
        'nama_material'
    ];
}
