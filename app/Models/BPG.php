<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPG extends Model
{
    use HasFactory;

    protected $table = 'export_bpg';

    protected $fillable = [
        'material',
        'spesifikasi',
        'jumlah',
        'kode_barang',
        'nomor_bpm',
        'qty_penyerahan',
        'no_seri',
        'no_order',
        'pemesan',
        'nomor_bpg',
    ];
}
