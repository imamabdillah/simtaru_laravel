<script>
$(document).ready(function(){
    defaultForm();
    isian();

});

function defaultForm() {
    init_select2();
    $("[name='nama_layer']").prop( "disabled", true );
    $("#grup_layer").prop( "disabled", true );
    $("#jenis_peta").prop( "disabled", true );
    $(".nama_opd").prop( "disabled", true );
    $(".status_layer").prop( "disabled", true );
    $("#link_api").prop( "disabled", true );
    $("#deskripsi_layer").prop( "disabled", true );
    $(".panel-button").hide();
    rowno = $(".atribut_form").length;//6
    for(i=0; i<=rowno; i++){
        delete_row(rowno);
        rowno--;
    }
    $('.atribut_nama_atribut').val('');
    $('.tipe_atribut').val('').trigger('change');
    daftar_atribut();
}

function isian() {
    var id = '<?= $this->uri->segment(4); ?>';
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/peta/get_layer_data')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $.each(data,function(nama,opd,sumber,status){
                $('.header_layer').html(data.nama);
                $('[name="nama_layer"]').val(data.nama);
                $('[name="deskripsi_layer"]').val(data.deskripsi_layer);
                $('[name="grup_layer"]').val(data.grup_layer).trigger('change');
                $('[name="jenis_peta"]').val(data.jenis_peta).trigger('change');
                $('[name="nama_opd"]').val(data.opd).trigger('change');
                $('[name="sumber_data"]').val(data.sumber);
                $('[name="status_layer"]').val(data.status).trigger('change');
                data.sumber == 'API' ? $('[name="link_api"]').val(data.link_api).parent().parent().show() : '';
            });
        }
    });
}

function init_select2() {
    $('#grup_layer').select2({
        theme: "bootstrap",
        placeholder: "Pilih Grup Layer",
        // allowClear: true,
        language: "id"
    });

    $('#jenis_peta').select2({
        theme: "bootstrap",
        placeholder: "Pilih Jenis Peta",
        // allowClear: true,
        language: "id"
    });

    $('.nama_opd').select2({
        theme: "bootstrap",
        placeholder: "Pilih OPD",
        // allowClear: true,
        language: "id"
    });
    
    $('.status_layer').select2({
        theme: "bootstrap",
        placeholder: "Pilih Status",
        // allowClear: true,
        language: "id",
        minimumResultsForSearch: -1
    });

    $('.tipe_atribut').select2({
        theme: "bootstrap",
        placeholder: "Pilih tipe data atribut",
        language: "id",
        minimumResultsForSearch: -1
    });
}

function add_row() {    
    rowno = $(".atribut_form").length;
    rowno = rowno+1;
    $(".atribut_form:last").after(
'<div class="row atribut_form" id="'+rowno+'">'+
	'<div class="col-7">'+
	    '<div class="form-group">'+
	        '<input type="text" class="form-control" name="atribut_nama_atribut[]" placeholder="Masukkan nama atribut">'+
	    '</div>'+
	'</div>'+
	'<div class="col-3">'+
	    '<div class="form-group">'+
	        '<select required class="form-control tipe_atribut" name="atribut_tipe_atribut[]" style="width: 100%;">'+
	            '<option value=""></option>'+
	            '<option value="1">Text</option>'+
	            '<option value="2">Angka</option>'+
	            // '<option value="3">File</option>'+
	        '</select>'+
	    '</div>'+
	'</div>'+
	'<div class="col-2">'+
	    '<div class="form-group">'+
	        '<button onclick="delete_row('+rowno+');" type="button" class="btn btn-block btn-danger mr-5 mb-5"><i class="fa fa-trash"></i> Hapus Atribut</button>'+
	    '</div>'+
	'</div>'+
	'</div>'
    );
    init_select2();
}

function delete_row(rowno){
    $('#'+rowno).remove();
}

$('.btn_batal').on('click',function(){
    defaultForm();
    isian();
});

$('.btn_ubah').on('click',function(){
    $("[name='nama_layer']").prop( "disabled", false );
    $("#grup_layer").prop( "disabled", false );
    $("#jenis_peta").prop( "disabled", false );
    $(".nama_opd").prop( "disabled", false );
    $(".status_layer").prop( "disabled", false );
    $("#link_api").prop( "disabled", false );
    $("#deskripsi_layer").prop( "disabled", false );
    $(".panel-button").show();
});

$('#form_layer').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/peta/ubah_layer',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){
            Swal.fire({
                title : 'Sukses!',
                text : 'Data berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            isian();
        }
    });
    return false;
});

$('#form_atribut').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/peta/simpan_atribut',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){
            Swal.fire({
                title : 'Sukses!',
                text : 'Data berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            isian();
        }
    });
    return false;
});

function daftar_atribut(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url()?>admin/peta/daftar_atribut?id='+<?= $this->uri->segment(4);?>,
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align:center;">'+data[i].nama_atribut+'</td>'+
                        '<td style="text-align:center;">'+data[i].tipe_data+'</td>'+
                        '<td style="text-align:center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id_atribut+'"><i class="fa fa-edit"></i> Edit</button> '+
                            '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'+data[i].id_atribut+'"><i class="fa fa-trash"></i></button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable();
}

$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/peta/get_atribut')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $.each(data,function(nama, tipe){
                $('#modal-edit').modal('show');
                $('[name="ubah_id_atribut"]').val(id);
                $('[name="ubah_atribut_nama"]').val(data.nama);
                $('[name="ubah_tipe_atribut"]').val(data.tipe).trigger('change');
            });
        }
    });
    return false;
});

$('.btn-ubah-atribut').on('click',function(){
    var id_atribut = $('[name="ubah_id_atribut"]').val();
    var nama_atribut = $('[name="ubah_atribut_nama"]').val();
    var tipe_data = $('[name="ubah_tipe_atribut"]').val();
    
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('admin/peta/ubah_atribut')?>",
        dataType : "JSON",
        data : {id_atribut:id_atribut , nama_atribut:nama_atribut, tipe_data:tipe_data, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>' },
        success: function(data){
            Swal.fire({
                title : 'Sukses!',
                text : 'Atribut berhasil diubah!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-edit').modal('hide');
        }
    });
    return false;
});

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/peta/hapus_atribut')?>",
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
        text: "Anda tidak dapat mengembalikan atribut yang sudah dihapus!",
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
                'Atribut yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});
</script>