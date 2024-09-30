<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang_masuk;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuks = Barang_Masuk::latest()->paginate(5);
        return view('barang_masuk.list_barang_masuk', compact('barang_masuks'));
    }
}
