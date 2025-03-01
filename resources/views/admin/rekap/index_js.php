<!-- <script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script> -->

<script type="text/javascript">
	var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	$(document).ready(function(){
        $('#tab_rtr').click();
	});

	function tampil_data_rtr(){
		//datatables
        table = $('#mydata').DataTable({ 
 			"destroy": true,
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/rekap/get_data_rtr/');?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            	{ "width": "20px", "className": "text-center", "orderable": false, "targets": [ 0 ] },
            	{ "className": "text-center", "targets": [ 3 ] },
            	{ "className": "text-center", "targets": [ 4 ] }
            ],
        });
	}

    $(document).on('click','.modal-detail-rtr',function(e){
        e.preventDefault(); 
        $("#modal-default-rtr").modal('show');
        $.post('<?php echo base_url('admin/rekap/detail_rtr')?>',
            {
                id:$(this).attr('data-id')
            },
            function(html){
                $(".asd").html(html);
            }   
        );
    });

    $(document).on('click','.modal-detail-kkr',function(e){
        e.preventDefault(); 
        $("#modal-default-kkr").modal('show');
        $.post('<?php echo base_url('admin/rekap/detail_kkr')?>',
            {
                id:$(this).attr('data-id')
            },
            function(html){
                $(".asd2").html(html);
            }   
        );
    });

    function tampil_data_kkr(){
        //datatables
        table = $('#mydata').DataTable({ 
            "destroy": true,
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/rekap/get_data_kkr/');?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
                { "width": "20px", "className": "text-center", "orderable": false, "targets": [ 0 ] },
                { "className": "text-center", "targets": [ 3 ] },
                { "className": "text-center", "targets": [ 4 ] }
            ],
        });
    }
</script>