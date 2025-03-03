<script>
var table;
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
$(document).ready(function(){
    defaultForm();
    table = $('#mydata').DataTable({ 
        "autoWidth": false,
        "processing": true, 
        "serverSide": true, 
        "searching": false,
        "order": [], 
        
        "ajax": {
            "url": "<?php echo site_url('opd/peta/daftar_layer_peta')?>",
            "type": "POST",
            "data": function ( data ) {
                data.<?php echo $this->security->get_csrf_token_name(); ?> = csrfHash;
                data.filter_nama = $('#filter_nama').val(); 
                data.filter_opd = $('#filter_opd').val();
                data.filter_sumber = $('#filter_sumber').val();
                data.filter_status = $('#filter_status').val();
            }
        },
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
        },  

        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
                "width": "10px"
            },
            { 
                "targets": [ 5 ], 
                "width": "200px",
                "className": "text-right"
            },
        ],

    });

    // Layer
    $('#btn_tambah_layer').click(function(){
        $.ajax({
            url: '<?=base_url()?>opd/peta/get_grup_layer',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(v=>{
            console.log(v.data);
            html = '<option value="" selected disabled>-- Pilih Grup Layer --</option>';
            v.data.map(x=>{
                html += '<option value="'+x.id_grup_layer+'">'+x.nama_grup_layer+'</option>';
            })
            $('#grup_layer').html(html);
        })

        $.ajax({
            url: '<?=base_url()?>opd/peta/get_jenis_peta',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(v=>{
            console.log(v.data);
            html = '<option value="" selected disabled>-- Pilih Jenis Peta --</option>';
            v.data.map(x=>{
                html += '<option value="'+x.id_jenis_peta+'">'+x.nama_jenis_peta+'</option>';
            })
            $('#jenis_peta').html(html);
        })
    })

    // Grup Layer
    $('#btn_simpan_grup_layer').attr('disabled','disabled');

    $('input[name="nama_grup_layer"]').keyup(function(){
		$(this).val().length > 0 ? $('#btn_simpan_grup_layer').removeAttr('disabled') : $('#btn_simpan_grup_layer').attr('disabled','disabled');
    })

    $('#btn_tambah_grup_layer').click(function(){
		$('#modal_grup_layer').modal('show');
		tampil_grup_layer();
    })
    
    $('#btn_simpan_grup_layer').click(function(){
		data = [];
		let fd = new FormData;
		fd.append('nama_grup_layer', $('input[name="nama_grup_layer"]').val());
		$.ajax({
			url: '<?=base_url()?>opd/peta/simpan_grup_layer',
			type: 'POST',
			data: fd,
			dataType: 'JSON',
			processData: false,
			contentType: false
		})
		.done((res)=>{
			let html = 'Data belum tersedia.';
			if(typeof res.data != 'undefined')
			{
				if(res.data.length > 0)
				{
					html = '';
					res.data.map((v,i,a)=>{
						data[v.id_grup_layer] = v.nama_grup_layer;
						html += '<div class="row">';
						html += '<div class="item_grup_layer col-8" data-id="'+v.id_grup_layer+'">'+v.nama_grup_layer+'</div>';
						html += '<div class="col-4" style="text-align:right">';
						html += '<button id="btn_item_grup_simpan_'+v.id_grup_layer+'" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan '+v.nama_grup_layer+'" onclick="event.preventDefault();simpan_item_grup_layer('+v.id_grup_layer+',\''+v.nama_grup_layer+'\')"></i></button>';
						html += '<button id="btn_item_grup_edit_'+v.id_grup_layer+'" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit '+v.nama_grup_layer+'" onclick="event.preventDefault();edit_item_grup_layer('+v.id_grup_layer+',\''+v.nama_grup_layer+'\')"></i></button>';
						html += '<button id="btn_item_grup_hapus_'+v.id_grup_layer+'" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus '+v.nama_grup_layer+'" onclick="event.preventDefault();hapus_item_grup_layer('+v.id_grup_layer+')"><i class="fa fa-remove" ></i></button>';
						html += '</div></div><hr>';
					})
				}
			}
			$('input[name="nama_grup_layer"]').val('')
			$('#btn_simpan_grup_layer').attr('disabled','disabled');
			$('#list_grup_layer').html(html);
			$('.btn_item_grup_simpan').hide();
		})
    })
    
    // End Grup Layer

    // Jenis Peta
    $('#btn_simpan_jenis_peta').attr('disabled','disabled');

    $('input[name="nama_jenis_peta"]').keyup(function(){
		$(this).val().length > 0 ? $('#btn_simpan_jenis_peta').removeAttr('disabled') : $('#btn_simpan_jenis_peta').attr('disabled','disabled');
    })

    $('#btn_tambah_jenis_peta').click(function(){
		$('#modal_jenis_peta').modal('show');
		tampil_jenis_peta();
    })
    
    $('#btn_simpan_jenis_peta').click(function(){
		data = [];
		let fd = new FormData;
		fd.append('nama_jenis_peta', $('input[name="nama_jenis_peta"]').val());
		$.ajax({
			url: '<?=base_url()?>opd/peta/simpan_jenis_peta',
			type: 'POST',
			data: fd,
			dataType: 'JSON',
			processData: false,
			contentType: false
		})
		.done((res)=>{
			let html = 'Data belum tersedia.';
			if(typeof res.data != 'undefined')
			{
				if(res.data.length > 0)
				{
					html = '';
					res.data.map((v,i,a)=>{
						data[v.id_jenis_peta] = v.nama_jenis_peta;
						html += '<div class="row">';
						html += '<div class="item_jenis_peta col-8" data-id="'+v.id_jenis_peta+'">'+v.nama_jenis_peta+'</div>';
						html += '<div class="col-4" style="text-align:right">';
						html += '<button id="btn_item_grup_simpan_'+v.id_jenis_peta+'" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan '+v.nama_jenis_peta+'" onclick="event.preventDefault();simpan_item_jenis_peta('+v.id_jenis_peta+',\''+v.nama_jenis_peta+'\')"></i></button>';
						html += '<button id="btn_item_grup_edit_'+v.id_jenis_peta+'" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit '+v.nama_jenis_peta+'" onclick="event.preventDefault();edit_item_jenis_peta('+v.id_jenis_peta+',\''+v.nama_jenis_peta+'\')"></i></button>';
						html += '<button id="btn_item_grup_hapus_'+v.id_jenis_peta+'" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus '+v.nama_jenis_peta+'" onclick="event.preventDefault();hapus_item_jenis_peta('+v.id_jenis_peta+')"><i class="fa fa-remove" ></i></button>';
						html += '</div></div><hr>';
					})
				}
			}
			$('input[name="nama_jenis_peta"]').val('')
			$('#btn_simpan_jenis_peta').attr('disabled','disabled');
			$('#list_jenis_peta').html(html);
			$('.btn_item_grup_simpan').hide();
		})
    })
    
    // End Jenis Peta

    $('.btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });

    $('.btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        init_select2();
        table.ajax.reload();  //just reload table
    });

    $('.btn-filter-layer, .block-cancel').click(function(){
        $( ".div-filter" ).slideToggle( "slow" );
    });

});

function init_select2() {
    $('#grup_layer').select2({
        theme: "bootstrap",
        dropdownParent: $('#modal-popin'),
        language: "id"
    });
    $('#jenis_peta').select2({
        theme: "bootstrap",
        dropdownParent: $('#modal-popin'),
        language: "id"
    });
    $('.opd').select2({
        theme: "bootstrap",
        dropdownParent: $('#modal-popin'),
        placeholder: "Pilih OPD",
        // allowClear: true,
        language: "id"
    });

    $('.sumber').select2({
        theme: "bootstrap",
        dropdownParent: $('#modal-popin'),
        placeholder: "Pilih sumber data",
        // allowClear: true,
        language: "id",
        minimumResultsForSearch: -1
    });

    $('.filter_opd').select2({
        theme: "bootstrap",
        placeholder: "Pilih OPD",
        // allowClear: true,
        language: "id"
    });

    $('.filter_sumber').select2({
        theme: "bootstrap",
        placeholder: "Pilih sumber data",
        // allowClear: true,
        language: "id",
        minimumResultsForSearch: -1
    });

    $('.filter_status').select2({
        theme: "bootstrap",
        placeholder: "Pilih status layer",
        // allowClear: true,
        language: "id",
        minimumResultsForSearch: -1
    });
}

function defaultForm() {
    $("#nama_layer").val('');
    // $("#opd").val('');
    // $("#opd").select2("val", "");
    $('#opd').val('').trigger('change');
    init_select2();
    $(".pengembangan").hide();
    $( ".btn-simpan" ).prop( "disabled", false );
    $( ".div-filter" ).hide();
}

$('#sumber').on('select2:select', function (e) {
    if(this.value == 1){
        $(".pengembangan").hide();
        $( ".btn-simpan" ).prop( "disabled", false );
    }else{
        $(".pengembangan").show();
        $( ".btn-simpan" ).prop( "disabled", true );
    }

});

$('#tambah_layer').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>opd/peta/simpan_layer',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){
            defaultForm();
            Swal.fire({
                title : 'Sukses!',
                text : 'Data berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            $('#modal-popin').modal('hide');
            setTimeout(function(){
                location.reload();
            },1000);
        }
    });
    return false;
});

$('#mydata').on('click','.btn_kelola',function(){
    var id = $(this).attr('data');
    window.location.replace('<?= base_url('opd/peta/kelola/');?>'+id);
});

$('#mydata').on('click','.btn_data',function(){
    var id = $(this).attr('data');
    window.location.replace('<?= base_url('opd/peta/data_peta/');?>'+id);
});

function hapus_semua_data(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('opd/peta/hapus_semua_data_layer')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
                table.ajax.reload();
            }
        });
    return false;
}

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('opd/peta/hapus_layer')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
                table.ajax.reload();
            }
        });
    return false;
}

// hapus layer
$('#mydata').on('click','.btn_clear',function(){
    var id = $(this).attr('data');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengembalikan semua data layer yang sudah dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus sekarang!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            hapus_semua_data(id);
            Swal.fire(
                'Terhapus!',
                'Layer yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});

// hapus semua data layer
$('#mydata').on('click','.btn_hapus',function(){
    var id = $(this).attr('data');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengembalikan layer yang sudah dihapus!",
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
                'Layer yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});

// Grup Layer

function tampil_grup_layer(){
	data = [];
	$.ajax({
		url: '<?=base_url()?>opd/peta/get_grup_layer',
		type: 'GET',
		dataType: 'JSON'
	})
	.done((res)=>{
		let html = 'Data belum tersedia.';
		if(typeof res.data != 'undefined')
		{
			if(res.data.length > 0)
			{
				html = '';
				res.data.map((v,i,a)=>{
					data[v.id_grup_layer] = v.nama_grup_layer;
					html += '<div class="row">';
					html += '<div class="item_grup_layer col-8" data-id="'+v.id_grup_layer+'">'+v.nama_grup_layer+'</div>';
					html += '<div class="col-4" style="text-align:right">';
					html += '<button id="btn_item_grup_simpan_'+v.id_grup_layer+'" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan '+v.nama_grup_layer+'" onclick="event.preventDefault();simpan_item_grup_layer('+v.id_grup_layer+',\''+v.nama_grup_layer+'\')"></i></button>';
					html += '<button id="btn_item_grup_edit_'+v.id_grup_layer+'" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit '+v.nama_grup_layer+'" onclick="event.preventDefault();edit_item_grup_layer('+v.id_grup_layer+',\''+v.nama_grup_layer+'\')"></i></button>';
					html += '<button id="btn_item_grup_hapus_'+v.id_grup_layer+'" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus '+v.nama_grup_layer+'" onclick="event.preventDefault();hapus_item_grup_layer('+v.id_grup_layer+')"><i class="fa fa-remove" ></i></button>';
					html += '</div></div><hr>';
				})
			}
		}
		$('#list_grup_layer').html(html);
		$('.btn_item_grup_simpan').hide();
		})
}

function edit_item_grup_layer(id,nama)
{
	let h = '<input name="form_item_grup_layer_'+id+'" type="text" class="form-control form_item_grup_layer" data-id="'+id+'" value="'+data[id]+'">';
	$('.item_grup_layer[data-id="'+id+'"]').html(h);
	$('#btn_item_grup_edit_'+id).hide();
	$('#btn_item_grup_simpan_'+id).show();
}

function simpan_item_grup_layer(id,nama)
{
	
	let fd = new FormData;
		fd.append('nama_grup_layer', $('input[name="form_item_grup_layer_'+id+'"]').val());
		fd.append('id_grup_layer', id);
	$.ajax({
		url: '<?=base_url()?>opd/peta/edit_grup_layer',
		type: 'POST',
		data: fd,
		dataType: 'JSON',
		processData: false,
		contentType: false
	})
	.done((res)=>{
		if(res.status == 'success')
		{
			data[id] = $('input[name="form_item_grup_layer_'+id+'"]').val();
			let h = data[id];
			$('.item_grup_layer[data-id="'+id+'"]').html(h);
			$('#btn_item_grup_simpan_'+id).hide();
			$('#btn_item_grup_edit_'+id).show();
		}
	})

}

function hapus_item_grup_layer(id)
{
	Swal.fire({
		    title: 'Apakah anda yakin?',
		    text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#3085d6',
		    cancelButtonColor: '#d33',
		    confirmButtonText: 'Hapus',
		    cancelButtonText: 'Batal'
	    }).then((result) => {
	    	if (result.value) {

				$.ajax({
					url: '<?=base_url()?>opd/peta/hapus_grup_layer',
					type : 'POST',
					dataType : 'JSON',
					data : {id_grup_layer: id}

				})
				.done((res)=>{
					if(res.status == 'success')
					{
						$('.item_grup_layer[data-id="'+id+'"').parent().next().remove();
						$('.item_grup_layer[data-id="'+id+'"').parent().remove();
						Swal.fire(
							'Terhapus!',
							'Data yang dipilih telah dihapus!',
							'success'
						);
					}
					else
					{
						Swal.fire(
							'Gagal!',
							res.message,
							'error'
						);
					}
					
				})
			}
					
		});
	    
}

// End Grup Layer

// Jenis Peta

function tampil_jenis_peta(){
	data = [];
	$.ajax({
		url: '<?=base_url()?>opd/peta/get_jenis_peta',
		type: 'GET',
		dataType: 'JSON'
	})
	.done((res)=>{
		let html = 'Data belum tersedia.';
		if(typeof res.data != 'undefined')
		{
			if(res.data.length > 0)
			{
				html = '';
				res.data.map((v,i,a)=>{
					data[v.id_jenis_peta] = v.nama_jenis_peta;
					html += '<div class="row">';
					html += '<div class="item_jenis_peta col-8" data-id="'+v.id_jenis_peta+'">'+v.nama_jenis_peta+'</div>';
					html += '<div class="col-4" style="text-align:right">';
					html += '<button id="btn_item_grup_simpan_'+v.id_jenis_peta+'" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan '+v.nama_jenis_peta+'" onclick="event.preventDefault();simpan_item_jenis_peta('+v.id_jenis_peta+',\''+v.nama_jenis_peta+'\')"></i></button>';
					html += '<button id="btn_item_grup_edit_'+v.id_jenis_peta+'" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit '+v.nama_jenis_peta+'" onclick="event.preventDefault();edit_item_jenis_peta('+v.id_jenis_peta+',\''+v.nama_jenis_peta+'\')"></i></button>';
					html += '<button id="btn_item_grup_hapus_'+v.id_jenis_peta+'" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus '+v.nama_jenis_peta+'" onclick="event.preventDefault();hapus_item_jenis_peta('+v.id_jenis_peta+')"><i class="fa fa-remove" ></i></button>';
					html += '</div></div><hr>';
				})
			}
		}
		$('#list_jenis_peta').html(html);
		$('.btn_item_grup_simpan').hide();
		})
}

function edit_item_jenis_peta(id,nama)
{
	let h = '<input name="form_item_jenis_peta_'+id+'" type="text" class="form-control form_item_jenis_peta" data-id="'+id+'" value="'+data[id]+'">';
	$('.item_jenis_peta[data-id="'+id+'"]').html(h);
	$('#btn_item_grup_edit_'+id).hide();
	$('#btn_item_grup_simpan_'+id).show();
}

function simpan_item_jenis_peta(id,nama)
{
	
	let fd = new FormData;
		fd.append('nama_jenis_peta', $('input[name="form_item_jenis_peta_'+id+'"]').val());
		fd.append('id_jenis_peta', id);
	$.ajax({
		url: '<?=base_url()?>opd/peta/edit_jenis_peta',
		type: 'POST',
		data: fd,
		dataType: 'JSON',
		processData: false,
		contentType: false
	})
	.done((res)=>{
		if(res.status == 'success')
		{
			data[id] = $('input[name="form_item_jenis_peta_'+id+'"]').val();
			let h = data[id];
			$('.item_jenis_peta[data-id="'+id+'"]').html(h);
			$('#btn_item_grup_simpan_'+id).hide();
			$('#btn_item_grup_edit_'+id).show();
		}
	})

}

function hapus_item_jenis_peta(id)
{
	Swal.fire({
		    title: 'Apakah anda yakin?',
		    text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#3085d6',
		    cancelButtonColor: '#d33',
		    confirmButtonText: 'Hapus',
		    cancelButtonText: 'Batal'
	    }).then((result) => {
	    	if (result.value) {

				$.ajax({
					url: '<?=base_url()?>opd/peta/hapus_jenis_peta',
					type : 'POST',
					dataType : 'JSON',
					data : {id_jenis_peta: id}

				})
				.done((res)=>{
					if(res.status == 'success')
					{
						$('.item_jenis_peta[data-id="'+id+'"').parent().next().remove();
						$('.item_jenis_peta[data-id="'+id+'"').parent().remove();
						Swal.fire(
							'Terhapus!',
							'Data yang dipilih telah dihapus!',
							'success'
						);
					}
					else
					{
						Swal.fire(
							'Gagal!',
							res.message,
							'error'
						);
					}
					
				})
			}
					
		});
	    
}

// End Jenis Peta


</script>