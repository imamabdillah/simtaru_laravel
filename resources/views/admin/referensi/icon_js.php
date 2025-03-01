<script>
var nama_icon = '';
$(document).ready(function(){
    
    defaultForm();   //pemanggilan fungsi tampil barang.
    $('#btn_tambah_icon').click(function(){
        nama_icon = '';
        $('input[name="file_icon"]').prop('required',true);
        $('button[type="submit"]').prop('disabled',true);
        $('input[name="file_icon"]').val('');
    })
    $('#nama_icon').blur(function(){
        $.ajax({
            url: '<?=base_url()?>admin/referensi/cek_nama_icon',
            type: 'POST',
            data: {name: $(this).val()},
            dataType: 'JSON'
        })
        .then(res=>{
            if(res.status == 'success')
            {
                $('button[type="submit"]').prop('disabled',false);
            }
            else
            {
                if($(this).val() == nama_icon)
                {
                    $('button[type="submit"]').prop('disabled',false);
                }
                else
                {
                    $('button[type="submit"]').prop('disabled',true);
                }
                
            }
        })
    })
});

$('#modal-icon').on('shown.bs.modal', function (e) {
    $("#nama_icon").focus();
});

$('#modal-icon').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_icon(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url()?>admin/referensi/daftar_icon',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: center;"><img style="width:25px;height:25px" src="<?=base_url()?>assets/uploads/marker_icon/'+data[i].nama_icon+'.png"></td>'+
                        '<td style="text-align: left;">'+data[i].nama_icon+'</td>'+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id_icon+'"><i class="fa fa-edit"></i></button> '+
                            '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'+data[i].id_icon+'" data-name="'+data[i].nama_icon+'"><i class="fa fa-trash"></i></button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable();
}

function defaultForm() {
    daftar_icon();
    $("#nama_icon").val("");
    $("#id_icon").val("");
    // $("h3.block-title").html("Tambah Ikon Peta");
}

$('#form_icon').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/referensi/form_icon',
        type:"post",
        dataType: 'JSON',
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(res){
            if(res.status == 'success')
            {
                Swal.fire({
                    title : 'Sukses!',
                    text : 'Data Ikon berhasil disimpan!',
                    type: 'success',
                    timer: 1500
                });
                defaultForm();
                $('#modal-icon').modal('hide');
            }
            else
            {
                console.log(res)
                Swal.fire({
                    title : 'Gagal!',
                    text : (res.message == '<p>The filetype you are attempting to upload is not allowed.</p>' ? 'Format ikon harus berupa file .png' : res.message),
                    type: 'error'
                });
            }
            
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    $('button[type="submit"]').prop('disabled',false);
    $('input[name="file_icon"]').prop('required',false)
    $('input[name="file_icon"]').val('');
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/referensi/get_icon')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $.each(data,function(nama){
                $("h3.block-title").html("Ubah Ikon");
                $('#modal-icon').modal('show');
                $('[name="id_icon"]').val(id);
                $('[name="nama_icon"]').val(data.nama);
                $('[name="id_opd"]').val(data.id_opd).trigger('click');
                nama_icon = data.nama;
            });
        }
    });
    return false;
});

function hapus(id,name){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/referensi/hapus_icon')?>",
    dataType : "JSON",
            data : {id: id, name: name, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}
$('#mydata').on('click','.item_hapus',function(){
    var id = $(this).attr('data');
    var name = $(this).attr('data-name');
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
            hapus(id,name);
            Swal.fire(
                'Terhapus!',
                'Ikon yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});

</script>