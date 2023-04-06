<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_Sampai extends Model
{
    use HasFactory;

    protected $table = 'material_sampai';

    protected $fillable = [
        'status',
        'nama_material',
        'nomor_po',
        'nomor_order',
        'nomor_pr',
        'jumlah',
        'satuan',
        'kode_material',
        'nomor_spbb_nota',
        'pemasok',
        'eda',
        'dokumen_material'
    ];
}
