<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp_admin" name="no_hp_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email_admin" name="email_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_keluar"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Password</label>
                        <input type="text" class="form-control" id="password_admin" name="password_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password_admin"></div>
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
        data.append("nama_admin", $('#nama_admin').val());
        data.append("no_hp_admin", $('#no_hp_admin').val());
        data.append("email_admin", $('#email_admin').val());
        data.append("password_admin", $('#password_admin').val());
        $.ajax({
            url: '{{url('api/admins')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama_admin') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let admins = `
                <tr id="index_${response.data.id}">
                <td>${response.data.nama_admin}</td>
                <td>${response.data.no_hp_admin}</td>
                <td>${response.data.email_admin}</td>
                <td>${response.data.password_admin}</td>
                <td class="text-left">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    
                </td>
                </tr>
                `;
                $('#table-admins').prepend(admins);
                $('#nama_admin').val('');
                $('#no_hp_admin').val('');
                $('#email_admin').val('');
                $('#password_admin').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.nama_admin[0]) {
                    $('#alert-nama_admin').removeClass('d-none');
                    $('#alert-nama_admin').addClass('d-block');
                    $('#alert-nama_admin').html(error.responseJSON.nama_admin[0]);

                }
                if(error.responseJSON.no_hp_admin[0]) {
                    $('#alert-no_hp_admin').removeClass('d-none');
                    $('#alert-no_hp_admin').addClass('d-block');
                    $('#alert-no_hp_admin').html(error.responseJSON.no_hp_admin[0]);

                }
                if(error.responseJSON.email_admin[0]) {
                    $('#alert-email_admin').removeClass('d-none');
                    $('#alert-email_admin').addClass('d-block');
                    $('#alert-email_admin').html(error.responseJSON.email_admin[0]);

                }
                if(error.responseJSON.password_admin[0]) {
                    $('#alert-password_admin').removeClass('d-none');
                    $('#alert-password_admin').addClass('d-block');
                    $('#alert-password_admin').html(error.responseJSON.password_admin[0]);

                }
            }
        });
        });
</script>