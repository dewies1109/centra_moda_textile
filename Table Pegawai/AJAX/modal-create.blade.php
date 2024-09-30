<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pegawai"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp_pegawai" name="no_hp_pegawai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pegawai"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email_pegawai" name="email_pegawai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email_pegawai"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Password</label>
                        <input type="text" class="form-control" id="password_pegawai" name="password_pegawai">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password_pegawai"></div>
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
        data.append("nama_pegawai", $('#nama_pegawai').val());
        data.append("no_hp_pegawai", $('#no_hp_pegawai').val());
        data.append("email_pegawai", $('#email_pegawai').val());
        data.append("password_pegawai", $('#password_pegawai').val());
        $.ajax({
            url: '{{url('api/pegawais')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama_pegawai') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let pegawais = `
                <tr id="index_${response.data.id}">
                <td>${response.data.nama_pegawai}</td>
                <td>${response.data.no_hp_pegawai}</td>
                <td>${response.data.email_pegawai}</td>
                <td>${response.data.password_pegawai}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                </td>
                </tr>
                `;
                $('#table-pegawais').prepend(pegawais);
                $('#nama_pegawai').val('');
                $('#no_hp_pegawai').val('');
                $('#email_pegawai').val('');
                $('#password_pegawai').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.nama_pegawai[0]) {
                    $('#alert-nama_pegawai').removeClass('d-none');
                    $('#alert-nama_pegawai').addClass('d-block');
                    $('#alert-nama_pegawai').html(error.responseJSON.nama_pegawai[0]);

                }
                if(error.responseJSON.no_hp_pegawai[0]) {
                    $('#alert-no_hp_pegawai').removeClass('d-none');
                    $('#alert-no_hp_pegawai').addClass('d-block');
                    $('#alert-no_hp_pegawai').html(error.responseJSON.no_hp_pegawai[0]);

                }
                if(error.responseJSON.email_pegawai[0]) {
                    $('#alert-email_pegawai').removeClass('d-none');
                    $('#alert-email_pegawai').addClass('d-block');
                    $('#alert-email_pegawai').html(error.responseJSON.email_pegawai[0]);

                }
                if(error.responseJSON.password_pegawai[0]) {
                    $('#alert-password_pegawai').removeClass('d-none');
                    $('#alert-password_pegawai').addClass('d-block');
                    $('#alert-password_pegawai').html(error.responseJSON.password_pegawai[0]);

                }
            }
        });
        });
</script>