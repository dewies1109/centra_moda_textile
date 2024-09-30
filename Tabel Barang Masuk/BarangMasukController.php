<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\barang_masuk;
use App\Http\Resources\BarangMasukResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_masuks = Barang_Masuk::latest()->paginate(5);
        return new BarangMasukResource(true, 'List Data Barang Masuk', $barang_masuks);
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
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'id_admin' => 'required',
            'tgl_masuk' => 'required',
            'jml_brg_masuk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang_masuk = Barang_Masuk::create([
            'id_supplier' => $request->id_supplier,
            'id_barang' => $request->id_barang,
            'id_admin' => $request->id_admin,
            'tgl_masuk' => $request->tgl_masuk,
            'jml_brg_masuk' => $request->jml_brg_masuk,
        ]);

        return new BarangMasukResource(true, 'Data Barang Masuk Berhasil Ditambahkan!', $barang_masuk);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Barang_Masuk $barang_masuk)
    {
        return new BarangMasukResource(true, 'Data Barang Ditemukan!', $barang_masuk);
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
    public function update(Request $request, Barang_Masuk $barang_masuk)
    {
        $validator = Validator::make($request->all(), [
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'id_admin' => 'required',
            'tgl_masuk' => 'required',
            'jml_brg_masuk' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $barang_masuk->update([
                'id_supplier' => $request->id_supplier,
                'id_barang' => $request->id_barang,
                'id_admin' => $request->id_admin,
                'tgl_masuk' => $request->tgl_masuk,
                'jml_brg_masuk' => $request->jml_brg_masuk,
            ]);
        } else {

            $barang_masuk->update([
                'id_supplier' => $request->id_supplier,
                'id_barang' => $request->id_barang,
                'id_admin' => $request->id_admin,
                'tgl_masuk' => $request->tgl_masuk,
                'jml_brg_masuk' => $request->jml_brg_masuk,
            ]);
        }
        return new BarangMasukResource(true, 'Data Barang Masuk Berhasil Diubah!', $barang_masuk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang_Masuk $barang_masuk)
    {
        $barang_masuk->delete();
        return new BarangMasukResource(true, 'Data Barang Masuk Berhasil Dihapus!', null);
    }
}
