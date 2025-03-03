<script>
let mode = '';
let id_edit = 0;
$(document).ready(function(){
	list_layer();

	$('#btn_simpan_grup_layer').attr('disabled','disabled');

	$('select[name="grup_layer"],select[name="opd_layer"]').select2();

	$('input[name="nama_grup_layer"]').keyup(function(){
		$(this).val().length > 0 ? $('#btn_simpan_grup_layer').removeAttr('disabled') : $('#btn_simpan_grup_layer').attr('disabled','disabled');
	})

	$('#btn_tambah_layer').click(function(){
		$('#modal_layer').modal('show');
		tampil_layer()
	})

	$('#btn_tambah_grup_layer').click(function(){
		$('#modal_grup_layer').modal('show');
		tampil_grup_layer();
	})

	$('#form_tambah_layer').submit(function(e){
		e.preventDefault();
		let submit_url;
		if(mode == 'add')
		{
			submit_url = '<?=base_url()?>opd/layer_rtrw/simpan_layer';
		}
		else if(mode == 'edit')
		{
			submit_url = '<?=base_url()?>opd/layer_rtrw/edit_layer';
		}

		if(cek_nama_layer){
			$('#simpan_layer').attr('disabled','disabled');
			$('#simpan_loader').show();
			let fd = new FormData(this);
			fd.append('id_layer',id_edit);
			fd.append('nama_layer_old', nama_layer_old);

			$.ajax({
				url: submit_url,
				type: 'POST',
				dataType: 'JSON',
				data: fd,
				processData: false,
				contentType: false
			})
			.done((res)=>{
				
				if(res.status == 'success')
				{
					$('#simpan_loader span').html('Berhasil menambahkan layer, redirecting...');
					window.location.replace('<?=base_url()?>opd/layer_rtrw');
				}
				else
				{
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: res.message,
						// footer: '<a href>Why do I have this issue?</a>'
					})
				}
			})
		}
		else
		{
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Nama layer tidak dapat digunakan.',
				// footer: '<a href>Why do I have this issue?</a>'
			})
		}
		
	})

	$('#btn_simpan_grup_layer').click(function(){
		data = [];
		let fd = new FormData;
		fd.append('nama_grup_layer', $('input[name="nama_grup_layer"]').val());
		$.ajax({
			url: '<?=base_url()?>opd/layer_rtrw/simpan_grup_layer',
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

	let cek_nama_layer = false;
	$('input[name="nama_layer"]').blur(function(){
		if($('input[name="nama_layer"]').val() != '')
		{
			$('#cek_nama_loader').show();
			$.ajax({
				url: '<?=base_url()?>opd/layer_rtrw/cek_nama_layer',
				type: 'POST',
				dataType: 'JSON',
				data: {'nama_layer': $('input[name="nama_layer"]').val(), 'nama_layer_old': nama_layer_old}
			})
			.done(function(res)
			{
				$('#cek_nama_loader').hide();
				if(res.status == 'success')
				{
					$('input[name="nama_layer"]').removeClass('is-invalid');
					$('input[name="nama_layer"]').addClass('is-valid');
					$('#info_nama_layer').html('* Nama layer dapat digunakan.');
					cek_nama_layer = true;
				}
				else
				{
					$('input[name="nama_layer"]').removeClass('is-valid');
					$('input[name="nama_layer"]').addClass('is-invalid');
					$('#info_nama_layer').html('* Nama layer tidak dapat digunakan, karena sudah ada layer dangan nama tersebut.');
					cek_nama_layer = false;
				}
				
			})
		}
		
	})
	
})
let data = [];

function tampil_layer(){
	cek_nama_layer = false;
	nama_layer_old = '';
	mode = 'add';
	id_edit = 0;
	$('input[name="nama_layer"]').removeClass('is-valid');
	$('input[name="nama_layer"]').removeClass('is-invalid');
	$('input[name="geojson_layer"]').attr('required','required');
	$('input').val('');
	$('svg').show();
	$('#simpan_loader').hide();
	$('#cek_nama_loader').hide();
	$('#simpan_layer').removeAttr('disabled');
	$('select[name="grup_layer"]').html('<option value="" disabled selected>Loading Grup Layer...</option>');
	$('select[name="opd_layer"]').html('<option value="" disabled selected>Loading OPD...</option>');
	//get grup layer
	$.ajax({
		url: '<?=base_url()?>opd/layer_rtrw/get_grup_layer',
		type: 'GET',
		dataType: 'JSON'
	})
	.done((res)=>{
		let html = ''
		if(res.data.length > 0)
		{
			html += '<option value="" disabled selected>-- Pilih Grup Layer --</option>';
			res.data.map((v,i,a)=>{
				html += '<option value="'+v.id_grup_layer+'">';
				html += v.nama_grup_layer;
				html += '</option>'; 
			})

			$('select[name="grup_layer"]').html(html);
			$('#grup_loader').hide();
		}
	})

	//get opd
	$.ajax({
		url: '<?=base_url()?>opd/layer_rtrw/get_opd',
		type: 'GET',
		dataType: 'JSON'
	})
	.done((res)=>{
		let html = ''
		if(res.data.length > 0)
		{
			html += '<option value="" disabled selected>-- Pilih OPD --</option>';
			res.data.map((v,i,a)=>{
				html += '<option value="'+v.id_opd+'">';
				html += v.nama_opd;
				html += '</option>'; 
			})

			$('select[name="opd_layer"]').html(html);
			$('#opd_loader').hide();
		}
	})
}

function tampil_grup_layer(){
	data = [];
	$.ajax({
		url: '<?=base_url()?>opd/layer_rtrw/get_grup_layer',
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
		url: '<?=base_url()?>opd/layer_rtrw/edit_grup_layer',
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
					url: '<?=base_url()?>opd/layer_rtrw/hapus_grup_layer',
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

function ganti_status(id){
	let status = $('#status_'+id).attr('data-status');
	$.ajax({
		url: '<?=base_url()?>opd/layer_rtrw/ganti_status',
		type: 'POST',
		dataType: 'JSON',
		data: {id: id, status_layer: status}
	})
	.done(function(res){
		
		if(res.status=='success')
		{
			if(status == '1')
			{
				$('#status_'+id).removeClass('btn-success');
				$('#status_'+id).addClass('btn-danger');
				$('#status_'+id).html('Tidak Aktif')
				$('#status_'+id).attr('data-status','0');
			}
			else
			{
				$('#status_'+id).removeClass('btn-danger');
				$('#status_'+id).addClass('btn-success');
				$('#status_'+id).html('Aktif');
				$('#status_'+id).attr('data-status','1');
			}

			Swal.fire(
				'Berhasil!',
				'Berhasil merubah status!',
				'success'
			);
		}
		else
		{
			Swal.fire(
				'Gagal!',
				'Gagal merubah status!',
				'error'
			);
		}
	})
}

let nama_layer_old = '';
function edit_layer(id){
	mode = 'edit';
	id_edit = id;
	$('#modal_layer').modal('show');
	$('input[name="geojson_layer"]').removeAttr('required');
	// $('input').val('');
	$('svg').show();
	$('#simpan_loader').hide();
	$('#cek_nama_loader').hide();
	$('#simpan_layer').removeAttr('disabled');
	$('select[name="grup_layer"]').html('<option value="" disabled selected>Loading Grup Layer...</option>');
	$('select[name="opd_layer"]').html('<option value="" disabled selected>Loading OPD...</option>');
	//get layer
	$.ajax({
		url: '<?=base_url()?>opd/layer_rtrw/get_layer_by_id',
		type: 'POST',
		dataType: 'JSON',
		data: {id: id}
	})
	.done((res)=>{
		nama_layer_old = res.data.nama_layer;
		let nama = res.data.nama_layer;
		let slug = res.data.slug_layer;
		let grup = res.data.id_grup_layer;
		let opd = res.data.id_opd;

		$('input[name="nama_layer"]').val(nama).trigger('blur');
		$('input[type="file"]').val('');

		//get grup layer
		$.ajax({
			url: '<?=base_url()?>opd/layer_rtrw/get_grup_layer',
			type: 'GET',
			dataType: 'JSON'
		})
		.done((res)=>{
			let html = ''
			if(res.data.length > 0)
			{
				html += '<option value="" disabled selected>-- Pilih Grup Layer --</option>';
				res.data.map((v,i,a)=>{
					html += '<option value="'+v.id_grup_layer+'">';
					html += v.nama_grup_layer;
					html += '</option>'; 
				})

				$('select[name="grup_layer"]').html(html);
				$('select[name="grup_layer"]').val(grup).trigger('change');
				$('#grup_loader').hide();
			}
		})

		//get opd
		$.ajax({
			url: '<?=base_url()?>opd/layer_rtrw/get_opd',
			type: 'GET',
			dataType: 'JSON'
		})
		.done((res)=>{
			let html = ''
			if(res.data.length > 0)
			{
				html += '<option value="" disabled selected>-- Pilih OPD --</option>';
				res.data.map((v,i,a)=>{
					html += '<option value="'+v.id_opd+'">';
					html += v.nama_opd;
					html += '</option>'; 
				})

				$('select[name="opd_layer"]').html(html);
				$('select[name="opd_layer"]').val(opd).trigger('change');
				$('#opd_loader').hide();
			}
		})
	})

	
}

function hapus_layer(id,slug){
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
				url: '<?=base_url()?>opd/layer_rtrw/hapus_layer',
				type : 'POST',
				dataType : 'JSON',
				data : {id: id, slug_layer: slug}

			})
			.done((res)=>{
				if(res.status == 'success')
				{
					$('#hapus_'+id).parent().parent().remove();

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
						'Data yang dipilih gagal dihapus!',
						'error'
					);
				}
				
			})
		}
				
	});
}

function download_layer(id,slug){
	// window.open('<?=base_url()?>assets_front/geojson/'+slug+'.json', '_blank');
	window.open('<?=base_url()?>opd/layer_rtrw/download_geojson/'+slug, '_blank');
	
}

function list_layer(){
	$('#table_layer').dataTable({
		pagingType: "full_numbers",
		pageLength: 10,
		lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
		autoWidth: false,
		ajax: "<?=base_url()?>opd/layer_rtrw/get_layer",
		columns: [
			{'data': 'nama_layer'},
			{'data': 'nama_grup_layer'},
			{'data': 'nama_opd'},
			{'data': (d)=>{
				let b = d.status_layer == '1' ? 'btn-success':'btn-danger';
				let s = d.status_layer == '1' ? 'Aktif' : 'Tidak Aktif';
				let t = d.status_layer == '1' ? 'Menonaktifkan' : 'Mengaktifkan';

				let x = '<button id="status_'+d.id_layer+'" data-status="'+d.status_layer+'" class="btn '+b+' btn-sm" onclick="event.preventDefault(); ganti_status('+d.id_layer+')" title="Klik untuk '+t+' '+d.nama_layer+'">'+s+'</button>';
				return x;
			}},
			{'data': (d)=>{
				let x = '<button id="download_'+d.id_layer+'" class="btn btn-success btn-sm mr-5" onclick="event.preventDefault(); download_layer('+d.id_layer+',\''+d.slug_layer+'\')" title="Unduh Geojson '+d.nama_layer+'"><i class="fa fa-download"></i></button>';
					x += '<button class="btn btn-info btn-sm mr-5" onclick="event.preventDefault(); edit_layer('+d.id_layer+')" title="Edit '+d.nama_layer+'"><i class="fa fa-pencil"></i></button>';
					x += '<button id="hapus_'+d.id_layer+'" class="btn btn-danger btn-sm" onclick="event.preventDefault(); hapus_layer('+d.id_layer+',\''+d.slug_layer+'\')" title="Hapus '+d.nama_layer+'"><i class="fa fa-trash"></i></button>';
					
				return x;
			}}
		],
		columnDefs: [
			{
				targets: [3,4],
				className: 'dt_body_center'
			},
			{ 
				orderable: false, 
				targets: [ 3,4 ] 
			}
		]
	})
}

</script>