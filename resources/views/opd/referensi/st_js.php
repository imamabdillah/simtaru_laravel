<script>

$(document).ready(function(){
    defaultForm();   //pemanggilan fungsi tampil barang.
});

$('#modal-st').on('shown.bs.modal', function (e) {
    $("#nama_st").focus();
});

$('#modal-st').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_st(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url()?>opd/referensi/daftar_st',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].nama_st+'</td>'+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id_st+'"><i class="fa fa-edit"></i></button> '+
                            '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'+data[i].id_st+'"><i class="fa fa-trash"></i></button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable();
}

function defaultForm() {
    daftar_st();
    $("#nama_st").val("");
    $("#id_st").val("");
    $("h3.block-title").html("Tambah Status Tanah");
}

$('#form_st').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>opd/referensi/form_st',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){
            Swal.fire({
                title : 'Sukses!',
                text : 'Data Status Tanah berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-st').modal('hide');
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('opd/referensi/get_st')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $.each(data,function(nama){
                $("h3.block-title").html("Ubah Status Tanah");
                $('#modal-st').modal('show');
                $('[name="id_st"]').val(id);
                $('[name="nama_st"]').val(data.nama);
            });
        }
    });
    return false;
});

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('opd/referensi/hapus_st')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}
$('#mydata').on('click','.item_hapus',function(){
    var id = $(this).attr('data');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus sekarang!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            hapus(id);
            Swal.fire(
                'Terhapus!',
                'Status Tanah yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});

</script>