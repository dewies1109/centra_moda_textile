<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-supplier-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Barang</label>
                        <input type="text" class="form-control" id="barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-barang-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Admin</label>
                        <input type="text" class="form-control" id="admin-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Masuk</label>
                        <input type="text" class="form-control" id="tgl_masuk-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_masuk-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Barang Masuk</label>
                        <input type="text" class="form-control" id="jml_brg_masuk-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jml_brg_masuk-edit"></div>
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
        url: '{{url('api/barang_masuks')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#supplier-edit').val(response.data.id_supplier);
            $('#barang-edit').val(response.data.id_barang);
            $('#admin-edit').val(response.data.id_admin);
            $('#tgl_masuk-edit').val(response.data.tgl_masuk);
            $('#jml_brg_masuk-edit').val(response.data.jml_brg_masuk);
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
    form.append("id_supplier",$('#supplier-edit').val());
    form.append("id_barang",$('#barang-edit').val());
    form.append("id_admin",$('#admin-edit').val());
    form.append("tgl_masuk",$('#tgl_masuk-edit').val());
    form.append("jml_brg_masuk",$('#jml_brg_masuk-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/barang_masuks')}}/'+post_id,
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
                <td>${response.data.id_supplier}</td>
                <td>${response.data.id_barang}</td>
                <td>${response.data.id_admin}</td>
                <td>${response.data.tgl_masuk}</td>
                <td>${response.data.jml_brg_masuk}</td>
                <td class="text-left">
                <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
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
            if(error.responseJSON.id_supplier[0]) {
                
                //show alert
                $('#alert-supplier-edit').removeClass('d-none');
                $('#alert-supplier-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-supplier-edit').html(error.responseJSON.id_supplier[0]);
            }
            if(error.responseJSON.id_barang[0]) {
                
                //show alert
                $('#alert-barang-edit').removeClass('d-none');
                $('#alert-barang-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-barang-edit').html(error.responseJSON.id_barang[0]);
            }
            if(error.responseJSON.id_admin[0]) {
                
                //show alert
                $('#alert-admin-edit').removeClass('d-none');
                $('#alert-admin-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-admin-edit').html(error.responseJSON.id_admin[0]);
            }
            if(error.responseJSON.tgl_masuk[0]) {
                
                //show alert
                $('#alert-tgl_masuk-edit').removeClass('d-none');
                $('#alert-tgl_masuk-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-tgl_masuk-edit').html(error.responseJSON.tgl_masuk[0]);
            }
            if(error.responseJSON.jml_brg_masuk[0]) {
                
                //show alert
                $('#alert-jml_brg_masuk-edit').removeClass('d-none');
                $('#alert-jml_brg_masuk-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-jml_brg_masuk-edit').html(error.responseJSON.jml_brg_masuk[0]);
            }
        }
    });
});
</script>