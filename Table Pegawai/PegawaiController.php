<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Http\Resources\PegawaiResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::latest()->paginate(5);
        return new PegawaiResource(true, 'List Data Pegawai', $pegawais);
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
            'nama_pegawai' => 'required',
            'no_hp_pegawai' => 'required',
            'email_pegawai' => 'required',
            'password_pegawai' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pegawai = Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'no_hp_pegawai' => $request->no_hp_pegawai,
            'email_pegawai' => $request->email_pegawai,
            'password_pegawai' => $request->password_pegawai,
        ]);

        return new PegawaiResource(true, 'Data Pegawai Berhasil Ditambahkan!', $pegawai);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return new PegawaiResource(true, 'Data Pegawai Ditemukan!', $pegawai);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required',
            'no_hp_pegawai' => 'required',
            'email_pegawai' => 'required',
            'password_pegawai' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $pegawai->update([
                'nama_pegawai' => $request->nama_pegawai,
                'no_hp_pegawai' => $request->no_hp_pegawai,
                'email_pegawai' => $request->email_pegawai,
                'password_pegawai'=> $request->password_pegawai,
            ]);
        } else {

            $pegawai->update([
                'nama_pegawai' => $request->nama_pegawai,
                'no_hp_pegawai' => $request->no_hp_pegawai,
                'email_pegawai' => $request->email_pegawai,
                'password_pegawai'=> $request->password_pegawai,
            ]);
        }
        return new PegawaiResource(true, 'Data Pegawai Berhasil Diubah!', $pegawai);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return new PegawaiResource(true, 'Data Pegawai Berhasil Dihapus!', null);
    }
}
