<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_Datang extends Model
{
    use HasFactory;

    protected $table = 'material_datang';

    protected $fillable = [
        'nama_material',
        'nomor_po',
        'nomor_order',
        'nomor_pr',
        'jumlah',
        'kode_material',
        'nomor_spbb_nota',
        'pemasok',
        'eda',
        'dokumen_material'
    ];
}
