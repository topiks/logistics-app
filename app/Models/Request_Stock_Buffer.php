<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Stock_Buffer extends Model
{
    use HasFactory;

    protected $table = 'request_stock_buffer';

    protected $fillable = [
        'nama_material',
        'kode_material',
    ];
}
