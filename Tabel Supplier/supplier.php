<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_supplier',
        'no_hp_supplier',
        'email_supplier',
        'password_supplier',
    ];
}
