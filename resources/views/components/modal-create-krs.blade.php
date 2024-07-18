<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <input type="text" class="form-control" id="NMMHSMSMHS">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
                

                <div class="form-group">
                    <label class="control-label">Tempat Lahir</label>
                    <textarea class="form-control" id="TPLHRMSMHS" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create post
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let NMMHSMSMHS   = $('#NMMHSMSMHS').val();
        let TPLHRMSMHS = $('#TPLHRMSMHS').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/krs`,
            type: "POST",
            cache: false,
            data: {
                "NMMHSMSMHS": NMMHSMSMHS,
                "TPLHRMSMHS": TPLHRMSMHS,
                "_token": token
            },
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
                    <tr id="index_${response.data.NIMHSMSMHS}">
                        <td>${response.data.NMMHSMSMHS}</td>
                        <td>${response.data.TPLHRMSMHS}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $('#table-posts').prepend(post);
                
                //clear form
                $('#NMMHSMSMHS').val('');
                $('#TPLHRMSMHS').val('');

                //close modal
                $('#modal-create').modal('hide');
                

            },
            error:function(error){
                
                if(error.responseJSON.NMMHSMSMHS[0]) {

                    //show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    //add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                } 

                if(error.responseJSON.TPLHRMSMHS[0]) {

                    //show alert
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');

                    //add message to alert
                    $('#alert-content').html(error.responseJSON.content[0]);
                } 

            }

        });

    });

</script>