<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\barang_keluar;
use App\Http\Resources\BarangKeluarResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_keluar = Barang_Keluar::latest()->paginate(5);
        return new BarangKeluarResource(true, 'List Data Barang Keluar', $barang_keluar);
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
            'id_pegawai' => 'required',
            'id_barang' => 'required',
            'tgl_keluar' => 'required',
            'jml_brg_keluar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang_keluar = Barang_Keluar::create([
            'id_pegawai' => $request->id_pegawai,
            'id_barang' => $request->id_barang,
            'tgl_keluar' => $request->tgl_keluar,
            'jml_brg_keluar' => $request->jml_brg_keluar,
        ]);

        return new BarangKeluarResource(true, 'Data Barang Keluar Berhasil Ditambahkan!', $barang_keluar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Barang_Keluar $barang_keluar)
    {
        return new BarangKeluarResource(true, 'Data Barang Ditemukan!', $barang_keluar);
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
    public function update(Request $request, Barang_Keluar $barang_keluar)
    {
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required',
            'id_barang' => 'required',
            'tgl_keluar' => 'required',
            'jml_brg_keluar' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $barang_keluar->update([
                'id_pegawai' => $request->id_pegawai,
                'id_barang' => $request->id_barang,
                'tgl_keluar' => $request->tgl_keluar,
                'jml_brg_keluar' => $request->jml_brg_keluar,
            ]);
        } else {

            $barang_keluar->update([
                'id_pegawai' => $request->id_pegawai,
                'id_barang' => $request->id_barang,
                'tgl_keluar' => $request->tgl_keluar,
                'jml_brg_keluar' => $request->jml_brg_keluar,
            ]);
        }
        return new BarangKeluarResource(true, 'Data Barang Keluar Berhasil Diubah!', $barang_keluar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang_Keluar $barang_keluar)
    {
        $barang_keluar->delete();
        return new BarangKeluarResource(true, 'Data Barang Keluar Berhasil Dihapus!', null);
    }
}
