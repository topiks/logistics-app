<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_Inventory extends Model
{
    use HasFactory;

    protected $table = 'material_inventory';

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
        'dokumen_material',
        'dokumen_an',
        'acc_notice_pqc',
        'op_no',
        'bpm_no',
        'dokumen_bpm',
    ];
}
