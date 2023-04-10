<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPM extends Model
{
    use HasFactory;

    protected $table = 'export_bpm';

    protected $fillable = [
        'order_masuk_no',
        'acc_notice_pqc',
        'op_no',
        'bpm_no',
        'uraian_material',
        'no_kode',
        'satuan',
        'qty',
        'nama_supplier',
    ];
}
