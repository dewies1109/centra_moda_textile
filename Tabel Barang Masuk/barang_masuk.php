<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_masuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_supplier',
        'id_barang',
        'id_admin',
        'tgl_masuk',
        'jml_brg_masuk',
    ];
}
