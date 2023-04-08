<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Stock extends Model
{
    use HasFactory;

    protected $table = 'request_stock';

    protected $fillable = [
        'status',
        'nama_material',
        'kode_material',
    ];
}
