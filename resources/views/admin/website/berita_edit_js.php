<script>
$(document).ready(function(){
    $('.summernote').summernote({
        placeholder: 'Tulis sesuatu...',
        height: 150,   //set editable area's height
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });
});

$('#thumbnail').change(function(e){
    var label_text = $(this).val();
    if(label_text.length > 30) label_text = label_text.substring(0,27)+'...';
    $('#label_thumbnail').text(label_text);
    file_preview(this);
})

function file_preview(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#thumbnail_preview').remove();
            $('#thumbnail_preview_container').html('<img src="'+e.target.result+'" style="width: 100%; height: 100%;vertical-align:middle"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('#form_berita').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/website/berita/simpan_berita_edit',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        dataType: 'JSON',
        //async:false,
        success: function(res){
            console.log(res);
            if(res.notif.status == "success"){
                Swal.fire({
                    title : 'Sukses!',
                    text : res.notif.message,
                    type: 'success',
                    timer: 1500
                });
                setTimeout(function(){
                    window.location.replace('<?=base_url()?>admin/website/berita/');
                },2000);

            }else{
                console.log(res);
                Swal.fire({
                    title : 'Gagal!',
                    text : res.notif.message,
                    type: 'error',
                    timer: 1500
                });
            }
        }
    });
    return false;
});

</script>