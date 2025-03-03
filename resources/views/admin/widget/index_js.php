<script src="<?=base_url()?>assets\js\plugins\highlightjs\highlight.pack.min.js"></script>
<script>
var nama_app = '';

$(document).ready(function(){
    
    defaultForm(); 

    $('#reset_token_box').hide();
    $('#btn_tambah_widget').click(function(){
        $('#reset_token_box').hide();
        $('#form_widget').trigger('reset');
        $('[name="id_widget"]').val('');
    })

    //Start Show Data
    $('#mydata').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?=base_url()?>admin/widget/daftar_widget',
            type: 'POST',
            dataType: 'JSON'
        },
        language: {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
        },
        order: [],
        columnDefs: [
            {
                targets: [0,4,5,8],
                orderable: false
            },
            {
                targets: [],
                className: 'text-center'
            },
            {
                targets: [1],
                className: 'no-wrap'
            }

        ],
        scrollX: true
    })
    //End Show Data

    
});

$('#modal-icon').on('shown.bs.modal', function (e) {
    $("#nama_app").focus();
});

$('#modal-icon').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function defaultForm() {

    $("#nama_pemohon").val("");
    $("#nama_app").val("");
    $("#url_app").val("");
    $("#url_map").val("");
    $("h3.block-title").html("Tambah Widget");
}

$('#form_widget').submit(function(e){
    e.preventDefault();
    let data = new FormData(this);
    data.set('url_app', $('[name="url_app"]').val().replaceAll('/','\\/'));
    data.set('url_map', $('[name="url_map"]').val().replaceAll('/','\\/'))
    $.ajax({
        url:'<?php echo base_url();?>admin/widget/form_widget',
        type:"post",
        dataType: 'JSON',
        data: data,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(res){
            if(res.status == 'success')
            {
                Swal.fire({
                    title : 'Sukses!',
                    text : 'Data widget berhasil disimpan!',
                    type: 'success',
                    timer: 1500
                });
                defaultForm();
                $('#modal-widget').modal('hide');
                window.location.reload();
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
    $('#reset_token_box').show();
    $('button[type="submit"]').prop('disabled',false);
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/widget/get_widget')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $("h3.block-title").html("Ubah Widget");
            $('#modal-widget').modal('show');
            $('[name="id_api_widget"]').val(id);
            $('[name="nama_app"]').val(data.nama_app);
            $('[name="nama_pemohon"]').val(data.nama_pemohon);
            $('[name="url_app"]').val(data.url_app);
            $('[name="url_map"]').val(data.url_map);
            $('[name="id_opd"]').val(data.id_opd).trigger('click');
        }
    });
    return false;
});

function hapus(id,name){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/widget/hapus_widget')?>",
    dataType : "JSON",
            data : {id: id, name: name, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
                window.location.reload();
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