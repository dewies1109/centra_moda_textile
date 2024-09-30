<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenis_barang;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenis_barangs = Jenis_Barang::latest()->paginate(5);
        return view('jenis_barang.list_jenis_barang', compact('jenis_barangs'));
    }
}
