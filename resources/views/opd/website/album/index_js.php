<script type="text/javascript">
	var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	$(document).ready(function(){
		// tampil_foto();
		tampil_kecamatan()
		select_kecamatan();

		
	});

	function show_modal_tambah(){
		$('#modal-tambah').modal('show');
	}

	function hide_tempat_foto(){
		$('.tempat_foto').each(function(){
			$(this).hide();
		});
	}

	function select_kecamatan(){
		$.ajax({
		    type : "POST",
		    url  : "<?= base_url('opd/website/album/getKecamatan'); ?>",
		    dataType : "JSON",
			success: function(data){
				var html = "<option></option>";
				for (var i = 0; i < data.length; i++) {
					html += '<option value="'+data[i].id_kecamatan+'">'+data[i].nama_kecamatan+'</option>';
				}
				$('#id_kecamatan').html(html);
			}
		});
	}

	function tampil_kecamatan(){
		$('.tempat_foto').hide();
		$.ajax({
		    type : "POST",
		    url  : "<?= base_url('opd/website/album/getKecamatan'); ?>",
		    dataType : "JSON",
			success: function(data){

				var html = "";
				for (var i = 0; i < data.length; i++) {
					html +=
						'<div class="block-header" style="background-color: #eaecee; margin-bottom: 5px;" onclick="tampil_foto('+data[i].id_kecamatan+')">'+
		                    '<h3 class="block-title">'+data[i].nama_kecamatan+'</h3>'+
		                '</div>'+
		                '<div class="row tempat_foto" id="tempat_foto_'+data[i].id_kecamatan+'">'+

		                '</div>';
				}

				$('#tampil_kecamatan').html(html);
			}
		});
	}

	function tampil_foto(id_kecamatan){
		hide_tempat_foto();
		$.ajax({
		    type : "POST",
		    url  : "<?= base_url('opd/website/album/getFoto'); ?>",
		    dataType : "JSON",
		    data : {id_kecamatan:id_kecamatan},
			success: function(data){

				var html = "";
				for (var i = 0; i < data.length; i++) {
					html +=
						'<div class="col-md-3 col-xl-3">'+
							'<div class="block block-rounded ribbon ribbon-modern ribbon-primary text-center">'+
	                        	'<div class="block-content block-content-full">'+
		                            '<img src="<?= base_url('assets/img/album/');?>'+data[i].file+'" style="width: 100%; height: auto;">'+
		                        '</div>'+
		                        '<div class="block-content block-content-full block-content-sm bg-body-light">'+
		                            '<div class="font-w600 mb-5">'+data[i].nama_foto+'</div>'+
		                        '</div>'+
		                        '<div class="block-content block-content-full">'+
		                            '<a class="btn btn-rounded btn-alt-secondary" href="javascript:void(0)" onclick="hapus_gambar('+id_kecamatan+','+data[i].id+')">'+
		                                '<i class="fa fa-trash mr-5"></i>Hapus'+
		                            '</a>'+
		                        '</div>'+
		                    '</div>'+
		                '</div>';
				}
				$('#tempat_foto_'+id_kecamatan).show();
				$('#tempat_foto_'+id_kecamatan).html(html);
			}
		});
	}

	function tombol_simpan(){
		var id_kecamatan = $('#id_kecamatan').val();
		var formData = new FormData($('#form_tambah')[0]);
	    $.ajax({
	        url : "<?= base_url('opd/website/album/simpan'); ?>",
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        dataType: "JSON",
	        success: function(data)
	        {
                $('#modal-tambah').modal('hide');
                tampil_foto(id_kecamatan);
	        },
	    });
	}

	function hapus_gambar(id_kecamatan,id){
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

	            $.ajax({
				    type : "POST",
				    url  : "<?= base_url('opd/website/album/hapus'); ?>",
				    dataType : "JSON",
				    data : {id:id},
					success: function(data){
						Swal.fire(
			                'Terhapus!',
			                'OPD yang dipilih telah dihapus!',
			                'success'
			            );
					}
				});

				tampil_foto(id_kecamatan);

	        }
	    });
	}
    

</script>