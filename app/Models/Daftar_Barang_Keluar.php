<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Barang_Keluar extends Model
{
    use HasFactory;

    protected $table = 'daftar_barang_keluar';

    protected $fillable = [
        'nama_material',
        'status',
        'spesifikasi',
        'kode_material',
        'satuan',
        'jumlah_yang_dipinjam',
        'project',
        'no_bpg',
    ];
}
