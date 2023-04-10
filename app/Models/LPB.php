<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPB extends Model
{
    use HasFactory;

    protected $table = 'export_lpb';

    protected $fillable = 
    [
        'nama_barang',
        'qty',
        'sat',
        'no_spbb_nota',
        'pemasok',
        'no_order'
    ];
}
