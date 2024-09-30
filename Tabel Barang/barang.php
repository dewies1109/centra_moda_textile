<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jenis_barang',
        'nama_barang',
        'harga_barang',
        'gambar',
        'lebar_kain',
        'stok',
    ];
}
