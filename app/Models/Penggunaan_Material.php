<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan_Material extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_material';

    protected $fillable = [
        'nama_material',
        'kode_material',
        'satuan',
        'jumlah_yang_dipinjam',
    ];
}
