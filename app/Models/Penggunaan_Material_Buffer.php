<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan_Material_Buffer extends Model
{
    use HasFactory;

    protected $table =  'penggunaan_material_buffer';

    protected $fillable = [
        'nama_material',
        'spesifikasi',
        'kode_material',
        'satuan',
        'jumlah_akan_digunakan',
        'project',
        'nomor_bpm',
    ];
}
