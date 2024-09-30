<?php

namespace App\Http\Controllers\Api;

use App\Models\supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SupplierResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(5);
        return new SupplierResource(true, 'List Data Supplier', $suppliers);
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
            'nama_supplier' => 'required',
            'no_hp_supplier' => 'required',
            'email_supplier' => 'required',
            'password_supplier' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier = Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'no_hp_supplier' => $request->no_hp_supplier,
            'email_supplier' => $request->email_supplier,
            'password_supplier' => $request->password_supplier,
        ]);

        return new SupplierResource(true, 'Data Supplier Berhasil Ditambahkan!', $supplier);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return new SupplierResource(true, 'Data Supplier Ditemukan!', $supplier);
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
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'no_hp_supplier' => 'required',
            'email_supplier' => 'required',
            'password_supplier' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $supplier->update([
                'nama_supplier' => $request->nama_supplier,
                'no_hp_supplier' => $request->no_hp_supplier,
                'email_supplier' => $request->email_supplier,
                'password_supplier'=> $request->password_supplier,
            ]);
        } else {

            $supplier->update([
                'nama_supplier' => $request->nama_supplier,
                'no_hp_supplier' => $request->no_hp_supplier,
                'email_supplier' => $request->email_supplier,
                'password_supplier'=> $request->password_supplier,
            ]);
        }
        return new SupplierResource(true, 'Data Supplier Berhasil Diubah!', $supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return new SupplierResource(true, 'Data Supplier Berhasil Dihapus!', null);
    }
}
