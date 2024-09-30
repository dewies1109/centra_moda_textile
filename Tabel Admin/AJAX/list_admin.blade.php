@extends('layouts.admin')
@section('title','List Data Admin')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>List Data Admin</title>
    
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
            <h4 class="text-center">Tabel Admin </h4>
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Admin</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-admins">
                            @foreach($admins as $admin)
                            <tr id="index_{{ $admin->id }}">
                                <td>{{ $admin-> nama_admin }}</td>
                                <td>{{ $admin-> no_hp_admin }}</td>
                                <td>{{ $admin-> email_admin }}</td>
                                <td>{{ $admin-> password_admin }}</td>
                                <td class="text-left">
                                <a href="javascript:void(0)"id="btn-edit-post" data-id="{{ $admin->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modal-create')
@include('admin.update')
@include('admin.delete')
@endsection
</body>
</html>