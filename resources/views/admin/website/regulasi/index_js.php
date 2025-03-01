<script type="text/javascript">
	var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	$(document).ready(function(){
		tampil_data();
	});

	function tampil_data(){
		//datatables
        table = $('#mydata').DataTable({ 
 			"destroy": true,
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/website/regulasi/get_data');?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            	{ "width": "20px", "className": "text-center", "orderable": false, "targets": [ 0 ] },
            	{ "className": "text-center", "targets": [ 2 ] },
            	{ "className": "text-center", "targets": [ 3 ] },
            ],
        });
	}

	function show_modal_tambah(){
		$('#modal-tambah').modal('show');
	}

	function tombol_simpan(){
		var formData = new FormData($('#form_tambah')[0]);
	    $.ajax({
	        url : "<?= base_url('admin/website/regulasi/simpan'); ?>",
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        dataType: "JSON",
	        success: function(data)
	        {
                $('#modal-tambah').modal('hide');
                tampil_data();
	        },
	    });
	}

	function tombol_hapus(id){
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
				    url  : "<?= base_url('admin/website/regulasi/hapus'); ?>",
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

				tampil_data();

	        }
	    });
	}
    

</script>