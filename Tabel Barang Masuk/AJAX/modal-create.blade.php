<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Supplier</label>
                        <input type="text" class="form-control" id="id_supplier" name="supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-supplier"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Barang</label>
                        <input type="text" class="form-control" id="id_barang" name="barang">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-barang"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Admin</label>
                        <input type="text" class="form-control" id="id_admin" name="admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Masuk</label>
                        <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_masuk"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Barang Masuk</label>
                        <input type="text" class="form-control" id="jml_brg_masuk" name="jml_brg_masuk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jml_brg_masuk"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
    $('body').on('click', '#btn-create-post', function () {
        $('#modal-create').modal('show');
    });
    $('#store').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = new
        FormData(document.getElementById("formData"));
        data.append("id_supplier", $('#id_supplier').val());
        data.append("id_barang", $('#id_barang').val());
        data.append("id_admin", $('#id_admin').val());
        data.append("tgl_masuk", $('#tgl_masuk').val());
        data.append("jml_brg_masuk", $('#jml_brg_masuk').val());
        $.ajax({
            url: '{{url('api/barang_masuks')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('id_supplier') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let barang_masuks = `
                <tr id="index_${response.data.id}">
                <td>${response.data.id_supplier}</td>
                <td>${response.data.id_barang}</td>
                <td>${response.data.id_admin}</td>
                <td>${response.data.tgl_masuk}</td>
                <td>${response.data.jml_brg_masuk}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-dangerbtn-sm">DELETE</a>
                </td>
                </tr>
                `;
                $('#table-barang-masuks').prepend(barang_masuks);
                $('#id_supplier').val('');
                $('#id_barang').val('');
                $('#id_admin').val('');
                $('#tgl_masuk').val('');
                $('#jml_brg_masuk').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.id_supplier[0]) {
                    $('#alert-supplier').removeClass('d-none');
                    $('#alert-supplier').addClass('d-block');
                    $('#alert-supplier').html(error.responseJSON.id_supplier[0]);

                }
                if(error.responseJSON.id_barang[0]) {
                    $('#alert-barang').removeClass('d-none');
                    $('#alert-barang').addClass('d-block');
                    $('#alert-barang').html(error.responseJSON.id_barang[0]);

                }
                if(error.responseJSON.id_admin[0]) {
                    $('#alert-admin').removeClass('d-none');
                    $('#alert-admin').addClass('d-block');
                    $('#alert-admin').html(error.responseJSON.id_admin[0]);

                }
                if(error.responseJSON.tgl_masuk[0]) {
                    $('#alert-tgl_masuk').removeClass('d-none');
                    $('#alert-tgl_masuk').addClass('d-block');
                    $('#alert-tgl_masuk').html(error.responseJSON.tgl_masuk[0]);

                }
                if(error.responseJSON.jml_brg_masuk[0]) {
                    $('#alert-jml_brg_masuk').removeClass('d-none');
                    $('#alert-jml_brg_masuk').addClass('d-block');
                    $('#alert-jml_brg_masuk').html(error.responseJSON.jml_brg_masuk[0]);

                }
            }
        });
        });
</script>