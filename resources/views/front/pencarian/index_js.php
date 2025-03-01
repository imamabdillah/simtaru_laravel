<script>
$(document).ready(function(){
    // $('#table_regulasi').dataTable();

    $('#form_cari').submit(function(e) {
        e.preventDefault();
 
        let data = new FormData(this);
        var url = "<?php echo base_url('pencarian/index') ?>"; 

        $.ajax({
            url: url,
            type: "GET",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) { 
                if (data.status == true) { 
                    toastr.success('Data berhasil ditambahkan', 'Berhasil', {
                        timeOut: 2000,
                        fadeOut: 2000
                    }); 
                } else { 

                    toastr.error('Periksa Inputan Anda', {
                        timeOut: 2000,
                        fadeOut: 2000
                    });
                    // location.reload();
                }
            },
            error: function() {
                toastr.error('Periksa Inputan Anda', {
                    timeOut: 2000,
                    fadeOut: 2000
                });
                // location.reload();
            }
        }); 
    });
})
</script>