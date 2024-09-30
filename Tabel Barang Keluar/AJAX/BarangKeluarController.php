<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang_keluar;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluars = Barang_Keluar::latest()->paginate(5);
        return view('barang_keluar.list_barang_keluar', compact('barang_keluars'));
    }
}
