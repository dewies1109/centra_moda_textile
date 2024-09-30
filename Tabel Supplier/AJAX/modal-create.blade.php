<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-supplier"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp_supplier" name="no_hp_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-supplier"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email_supplier" name="email_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email_supplier"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Password</label>
                        <input type="text" class="form-control" id="password_supplier" name="password_supplier">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password_supplier"></div>
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
        data.append("nama_supplier", $('#nama_supplier').val());
        data.append("no_hp_supplier", $('#no_hp_supplier').val());
        data.append("email_supplier", $('#email_supplier').val());
        data.append("password_supplier", $('#password_supplier').val());
        $.ajax({
            url: '{{url('api/suppliers')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama_supplier') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let suppliers = `
                <tr id="index_${response.data.id}">
                <td>${response.data.nama_supplier}</td>
                <td>${response.data.no_hp_supplier}</td>
                <td>${response.data.email_supplier}</td>
                <td>${response.data.password_supplier}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                </td>
                </tr>
                `;
                $('#table-suppliers').prepend(suppliers);
                $('#nama_supplier').val('');
                $('#no_hp_supplier').val('');
                $('#email_supplier').val('');
                $('#password_supplier').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.nama_supplier[0]) {
                    $('#alert-nama_supplier').removeClass('d-none');
                    $('#alert-nama_supplier').addClass('d-block');
                    $('#alert-nama_supplier').html(error.responseJSON.nama_supplier[0]);

                }
                if(error.responseJSON.no_hp_supplier[0]) {
                    $('#alert-no_hp_supplier').removeClass('d-none');
                    $('#alert-no_hp_supplier').addClass('d-block');
                    $('#alert-no_hp_supplier').html(error.responseJSON.no_hp_supplier[0]);

                }
                if(error.responseJSON.email_supplier[0]) {
                    $('#alert-email_supplier').removeClass('d-none');
                    $('#alert-email_supplier').addClass('d-block');
                    $('#alert-email_supplier').html(error.responseJSON.email_supplier[0]);

                }
                if(error.responseJSON.password_supplier[0]) {
                    $('#alert-password_supplier').removeClass('d-none');
                    $('#alert-password_supplier').addClass('d-block');
                    $('#alert-password_supplier').html(error.responseJSON.password_supplier[0]);

                }
            }
        });
        });
</script>