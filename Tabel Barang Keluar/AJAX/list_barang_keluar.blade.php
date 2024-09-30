@extends('layouts.barang_keluar')
@section('title','List Data Barang Keluar')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax Barang Keluar</title>
    
    <style>
    body {
        background-color: lightgray !important;
    }
    </style>
    @section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endsection
</head>

<body>
@section('content')
    <div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Tabel Barang Keluar </h4>
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Pegawai</th>
                                <th>Barang</th>
                                <th>Tanggal Keluar</th>
                                <th>Jumlah Barang Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-barang_keluars">
                            @foreach($barang_keluars as $barang_keluar)
                            <tr id="index_{{ $barang_keluar->id }}">
                                <td>{{ $barang_keluar-> id_pegawai }}</td>
                                <td>{{ $barang_keluar-> id_barang }}</td>
                                <td>{{ $barang_keluar-> tgl_keluar }}</td>
                                <td>{{ $barang_keluar-> jml_brg_keluar }}</td>
                                <td class="text-left">
                                <a href="javascript:void(0)"id="btn-edit-post" data-id="{{ $barang_keluar->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                <!--<a href="javascript:void(0)"id="btn-delete-post" data-id="{{ $barang_keluar->id }}" class="btn btn-danger btn-sm">DELETE</a>-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@include('barang_keluar.modal-create')
@include('barang_keluar.update')
@include('barang_keluar.delete')
@endsection
</body>
</html>