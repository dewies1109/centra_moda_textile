<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::latest()->paginate(5);
        return new AdminResource(true, 'List Data Admin', $admins);
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
            'nama_admin' => 'required',
            'no_hp_admin' => 'required',
            'email_admin' => 'required',
            'password_admin' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::create([
            'nama_admin' => $request->nama_admin,
            'no_hp_admin' => $request->no_hp_admin,
            'email_admin' => $request->email_admin,
            'password_admin' => $request->password_admin,
        ]);

        return new AdminResource(true, 'Data Admin Berhasil Ditambahkan!', $admin);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return new AdminResource(true, 'Data Admin Ditemukan!', $admin);
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
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required',
            'no_hp_admin' => 'required',
            'email_admin' => 'required',
            'password_admin' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $admin->update([
                'nama_admin' => $request->nama_admin,
                'no_hp_admin' => $request->no_hp_admin,
                'email_admin' => $request->email_admin,
                'password_admin'=> $request->password_admin,
            ]);
        } else {

            $admin->update([
                'nama_admin' => $request->nama_admin,
                'no_hp_admin' => $request->no_hp_admin,
                'email_admin' => $request->email_admin,
                'password_admin'=> $request->password_admin,
            ]);
        }
        return new AdminResource(true, 'Data Admin Berhasil Diubah!', $admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return new AdminResource(true, 'Data Admin Berhasil Dihapus!', null);
    }
}
