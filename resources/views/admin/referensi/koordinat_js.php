<script src="<?=base_url()?>assets\js\plugins\highlightjs\highlight.pack.min.js"></script>
<script>
var nama_koordinat = '';
$(document).ready(function(){
    
    defaultForm(); 
    $('#contoh_koordinat').slimScroll({
        color: '#b00404',
        height: '430px'
    });

    $('#btn_tambah_koordinat').click(function(){
        $('#form_koordinat').trigger('reset');
        $('[name="id_koordinat"]').val('');
    })

    //Start Show Data
    $('#mydata').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?=base_url()?>admin/referensi/daftar_koordinat',
            type: 'POST',
            dataType: 'JSON'
        },
        language: {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
        },
        order: [],
        columnDefs: [
            {
                targets: [0,4],
                orderable: false
            },
            {
                targets: [3,4],
                className: 'text-center'
            }

        ]
    })
    //End Show Data

    
});

$('#modal-icon').on('shown.bs.modal', function (e) {
    $("#nama_koordinat").focus();
});

$('#modal-icon').on('hidden.bs.modal', function (e) {
    defaultForm();
});

// function daftar_koordinat(){
//     table = $('#mydata').DataTable();
//     table.destroy();
//     table.draw();
//     $.ajax({
//         type  : 'post',
//         url   : '<?php echo base_url()?>admin/referensi/daftar_koordinat',
//         async : false,
//         dataType : 'json',
//         success : function(data){
//             var html = '';
//             var i;
//             for(i=0; i<data.length; i++){
//                 html += '<tr>'+
//                         '<td style="text-align: center;">'+(i+1)+'.</td>'+
//                         '<td style="text-align: left;">'+data[i].nama_koordinat+'</td>'+
//                         '<td style="text-align: left;">'+data[i].ket_koordinat+'</td>'+
//                         '<td style="text-align: center;">'+data[i].tipe_koordinat+'</td>'+
//                         '<td style="text-align: center;">'+
//                             '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id_koordinat+'"><i class="fa fa-edit"></i></button> '+
//                             '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'+data[i].id_koordinat+'" data-name="'+data[i].nama_koordinat+'"><i class="fa fa-trash"></i></button> '+
//                         '</td>'+
//                         '</tr>';
//             }
//             $('#show_data').html(html);
//         }
//     });
//     $('#mydata').DataTable();
// }

function defaultForm() {
    // daftar_koordinat();
    $("#nama_koordinat").val("");
    $("#ket_koordinat").val("");
    $("#tipe_koordinat").val("");
    $("#koordinat").val("");
    $("#id_koordinat").val("");
    // $("h3.block-title").html("Tambah Koordinat Peta");
}

$('#form_koordinat').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/referensi/form_koordinat',
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
                    text : 'Data Koordinat berhasil disimpan!',
                    type: 'success',
                    timer: 1500
                });
                defaultForm();
                $('#modal-koordinat').modal('hide');
            }
            else
            {
                console.log(res)
                Swal.fire({
                    title : 'Gagal!',
                    text : res.message,
                    type: 'error'
                });
            }
            
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    $('button[type="submit"]').prop('disabled',false);
    $('input[name="file_koordinat"]').prop('required',false)
    $('input[name="file_koordinat"]').val('');
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/referensi/get_koordinat')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $("h3.block-title").html("Ubah Koordinat");
            $('#modal-koordinat').modal('show');
            $('[name="id_koordinat"]').val(id);
            $('[name="nama_koordinat"]').val(data.nama_koordinat);
            $('[name="ket_koordinat"]').val(data.ket_koordinat);
            $('[name="tipe_koordinat"]').val(data.tipe_koordinat).trigger('change');
            $('[name="koordinat"]').val(data.koordinat);
            $('[name="id_opd"]').val(data.id_opd).trigger('click');
            // nama_koordinat = data.nama;
        }
    });
    return false;
});

function hapus(id,name){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/referensi/hapus_koordinat')?>",
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