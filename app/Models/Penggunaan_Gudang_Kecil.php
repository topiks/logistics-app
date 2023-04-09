<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan_Gudang_Kecil extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_gudang_kecil';
    protected $fillable = [
        'nama_material',
        'status',
        'spesifikasi',
        'kode_material',
        'satuan',
        'jumlah_yang_dipinjam',
        'project',
    ];
}
