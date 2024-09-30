<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Admin</label>
                        <input type="text" class="form-control" id="nama_admin-edit" name="nama_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp_admin-edit" name="no_hp_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email_admin-edit" name="email_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email_admin-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Password</label>
                        <input type="text" class="form-control" id="password_admin-edit" name="password_admin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password_admin-edit"></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

//button create post event
$('body').on('click', '#btn-edit-post', function () {
    let post_id = $(this).data('id');

    //fetch detail post with ajax
    $.ajax({
        url: '{{url('api/admins')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama_admin-edit').val(response.data.nama_admin);
            $('#no_hp_admin-edit').val(response.data.no_hp_admin);
            $('#email_admin-edit').val(response.data.email_admin);
            $('#password_admin-edit').val(response.data.password_admin);
        //open modal
        $('#modal-edit').modal('show');
    }
});
});
//action update post
$('#update').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let post_id=$('#post_id').val()
    var form = new FormData();
    form.append("nama_admin",$('#nama_admin-edit').val());
    form.append("no_hp_admin",$('#no_hp_admin-edit').val());
    form.append("email_admin",$('#email_admin-edit').val());
    form.append("password_admin",$('#password_admin-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/admins')}}/'+post_id,
        type: "POST",
        data: form,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout: 0,
        mimeType: "multipart/form-data",
        
        success:function(response){
            //show success message
            Swal.fire({
                type: 'success',
                icon: 'success',
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000
            });
            
            //data post
            let post = `
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
            
            //append to post data
            $(`#index_${response.data.id}`).replaceWith(post);
            
            //close modal
            $('#modal-edit').modal('hide');
        },
        error:function(error){
            console.log(error)
            if(error.responseJSON.nama_admin[0]) {
                
                //show alert
                $('#alert-nama_admin-edit').removeClass('d-none');
                $('#alert-nama_admin-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-nama_admin-edit').html(error.responseJSON.nama_admin[0]);
            }
            if(error.responseJSON.no_hp_admin[0]) {
                
                //show alert
                $('#alert-no_hp_admin-edit').removeClass('d-none');
                $('#alert-no_hp_admin-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-no_hp_admin-edit').html(error.responseJSON.no_hp_admin[0]);
            }
            if(error.responseJSON.email_admin[0]) {
                
                //show alert
                $('#alert-email_admin-edit').removeClass('d-none');
                $('#alert-email_admin-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-email_admin-edit').html(error.responseJSON.email_admin[0]);
            }
            if(error.responseJSON.password_admin[0]) {
                
                //show alert
                $('#alert-password_admin-edit').removeClass('d-none');
                $('#alert-password_admin-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-password_admin-edit').html(error.responseJSON.password_admin[0]);
            }
        }
    });
});
</script>