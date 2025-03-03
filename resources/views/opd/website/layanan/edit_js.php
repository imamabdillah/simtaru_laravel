<script>
$(document).ready(function(){
    $('.summernote').summernote({
        placeholder: 'Isi detail layanan...',
        height: 500,   //set editable area's height
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });
});

$('#form_berita').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>opd/website/Layanan/do_edit',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        dataType: 'JSON',
        success: function(res){
            window.location.replace("<?= base_url('opd/website/layanan');?>");
        }
    });
    return false;
});

</script>