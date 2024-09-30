<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\barang;
use App\Http\Resources\BarangResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(5);
        return new BarangResource(true, 'List Data Barang', $barangs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jenis_barang'=> 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'lebar_kain' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stok' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $gambar = $request->file('gambar');
        $gambar -> storeAs('public/barangs', $gambar->hashName());

        $barang = Barang::create([
            'id_jenis_barang' => $request->id_jenis_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'lebar_kain' => $request->lebar_kain,
            'gambar' => $gambar->hashName(),
            'stok' => $request->stok,
        ]);

        return new BarangResource(true, 'Data Barang Berhasil Ditambahkan!', $barang);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return new BarangResource(true, 'Data Barang Ditemukan!', $barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'id_jenis_barang'=> 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'lebar_kain' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stok' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('gambar')){

            $gambar = $request->file('gambar');
            $gambar -> storeAs('public/posts', $gambar->hashName());

            Storage::delete('public/posts/'.$barang->gambar);

            $barang->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'lebar_kain' => $request->lebar_kain,
                'gambar' => $gambar->hashName(),
                'stok' => $request->stok,
            ]);
        } else {

            $barang->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'lebar_kain' => $request->lebar_kain,
                'gambar' => $gambar->hashName(),
                'stok' => $request->stok,
            ]);
        }
        return new BarangResource(true, 'Data Barang Berhasil Diubah!', $barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    }
}
