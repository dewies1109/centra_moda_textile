<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_keluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pegawai',
        'id_barang',
        'tgl_keluar',
        'jml_brg_keluar',
    ];
}
