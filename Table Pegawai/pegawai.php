<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $fillable = [
        'nama_pegawai',
        'no_hp_pegawai',
        'email_pegawai',
        'password_pegawai',
    ];
}
