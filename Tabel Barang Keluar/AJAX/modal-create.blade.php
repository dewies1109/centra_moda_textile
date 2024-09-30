<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Pegawai</label>
                        <input type="text" class="form-control" id="id_pegawai" name="pegawai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pegawai"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Barang</label>
                        <input type="text" class="form-control" id="id_barang" name="barang">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-barang"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Keluar</label>
                        <input type="text" class="form-control" id="tgl_keluar" name="tgl_keluar">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_keluar"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Barang Keluar</label>
                        <input type="text" class="form-control" id="jml_brg_keluar" name="jml_brg_keluar">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jml_brg_keluar"></div>
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
        data.append("id_pegawai", $('#id_pegawai').val());
        data.append("id_barang", $('#id_barang').val());
        data.append("tgl_keluar", $('#tgl_keluar').val());
        data.append("jml_brg_keluar", $('#jml_brg_keluar').val());
        $.ajax({
            url: '{{url('api/barang_keluars')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('id_pegawai') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let barang_keluars = `
                <tr id="index_${response.data.id}">
                <td>${response.data.id_pegawai}</td>
                <td>${response.data.id_barang}</td>
                <td>${response.data.tgl_keluar}</td>
                <td>${response.data.jml_brg_keluar}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                </td>
                </tr>
                `;
                $('#table-barang-keluars').prepend(barang_keluars);
                $('#id_pegawai').val('');
                $('#id_barang').val('');
                $('#tgl_keluar').val('');
                $('#jml_brg_keluar').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.id_pegawai[0]) {
                    $('#alert-pegawai').removeClass('d-none');
                    $('#alert-pegawai').addClass('d-block');
                    $('#alert-pegawai').html(error.responseJSON.id_pegawai[0]);

                }
                if(error.responseJSON.id_barang[0]) {
                    $('#alert-barang').removeClass('d-none');
                    $('#alert-barang').addClass('d-block');
                    $('#alert-barang').html(error.responseJSON.id_barang[0]);

                }
                if(error.responseJSON.tgl_keluar[0]) {
                    $('#alert-tgl_keluar').removeClass('d-none');
                    $('#alert-tgl_keluar').addClass('d-block');
                    $('#alert-tgl_keluar').html(error.responseJSON.tgl_keluar[0]);

                }
                if(error.responseJSON.jml_brg_keluar[0]) {
                    $('#alert-jml_brg_keluar').removeClass('d-none');
                    $('#alert-jml_brg_keluar').addClass('d-block');
                    $('#alert-jml_brg_keluar').html(error.responseJSON.jml_brg_keluar[0]);

                }
            }
        });
        });
</script>