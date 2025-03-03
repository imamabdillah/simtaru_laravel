<script type="text/javascript">
	var csrfHash = '2efd533ad64b3a75780612e4e34df45f';

	$(document).ready(function(){
		$('#kecamatan').select2({
	        theme: "bootstrap",
	        placeholder: "Pilih Kecamatan",
	        language: "id"
	    });
		$('#desa').select2({
	        theme: "bootstrap",
	        placeholder: "Pilih Kecamatan Terlebih Dahulu",
	        language: "id"
	    });

	    $('#kecamatan').val('<?= $data_user_detail['id_kecamatan'];?>').change();
	    desa_ajax('<?= $data_user_detail['id_kecamatan'];?>');
	    $('#desa').val('<?= $data_user_detail['id_kelurahan'];?>').change();

    	$('#tombol_ganti_password').prop('disabled', true);

	});

	$('#form_profil').submit(function(e){
	    e.preventDefault();
	    $.ajax({
	        url:'<?php echo base_url();?>pemohon/profil/edit',
	        type:"post",
	        data:new FormData(this),
	        processData:false,
	        contentType:false,
	        cache:false,
	        dataType: 'JSON',
	        success: function(res){
	            Swal.fire({
	                title : 'Sukses!',
	                text : 'Data Berhasil Disimpan',
	                type: 'success',
	                timer: 1500
	            });
	            location.reload();
	        }
	    });
	    return false;
	});

	$('#form_ganti_password').submit(function(e){
	    e.preventDefault();
	    $.ajax({
	        url:'<?php echo base_url();?>pemohon/profil/ganti_password',
	        type:"post",
	        data:new FormData(this),
	        processData:false,
	        contentType:false,
	        cache:false,
	        dataType: 'JSON',
	        success: function(res){
	            Swal.fire({
	                title : 'Sukses!',
	                text : 'Data Berhasil Disimpan',
	                type: 'success',
	                timer: 1500
	            });
	            $('#modal-form_ganti_password').modal('hide'); 
	            location.reload();
	        }
	    });
	    return false;
	});

	$('#kecamatan').on('select2:select', function (e) {
		desa_ajax(this.value);
	});

	function desa_ajax(id) {
		$.ajax({
	        type  : 'POST',
	        url   : '<?= base_url("perijinan/data_desa"); ?>',
	        data : { id:id, my_token_name : csrfHash },
	        async : false,
	        dataType : 'json',
	        success : function(data){
	            var html = '<option value=""></option>';
	            var i;
	            for(i=0; i<data.length; i++){
	                
	                html += '<option value="'+data[i].id_kelurahan+'">'+data[i].nama_kelurahan+'</option>';
	            }
	            $('#desa').html(html);
	        }
	    });
	}

	function show_ganti_password(){
	    $.ajax({
	        type  : 'POST',
	        url   : '<?php echo base_url()?>pemohon/profil/pencarian_user',
	        async : false,
	        dataType : 'json',
	        success : function(data){
	            $('#kelompok_opd_edit').hide();

	            $('#ganti_id_user').val(data.id_user);
	            $('#ganti_username').val(data.user_name);

	            $('#modal-ganti_password').modal('show');
	        }
	    });
	}

	function cek_password_1_dan_2_edit(){
	    var password = $('#ganti_password').val();
	    var password_2 = $('#ganti_password_2').val();

	    if(password === password_2){
	        $('.err').hide();
	        $('#tombol_ganti_password').prop('disabled', false);
	    } else {
	        $('.err').show();
	        $('.err').html('Password 1 dan 2 Tidak Sama');
	        $('#tombol_ganti_password').prop('disabled', true);
	    }
	}

</script>