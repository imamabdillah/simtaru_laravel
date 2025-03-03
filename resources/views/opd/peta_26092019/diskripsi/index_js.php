<script>
$(document).ready(function(){
    var id = "<?= $id; ?>";
    var id_collection = "<?= $id_collection; ?>";

    $('#id_collection').val(id_collection);


    $('.summernote').summernote({
        placeholder: 'Tulis sesuatu...',
        height: 300,   //set editable area's height
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });

    $.ajax({
      type: 'GET',
      url: '<?= base_url();?>opd/peta/ambil_diskripsi/',
      data: {id_collection: id_collection},
      dataType: 'JSON',
      success: function(data){

          $('#nama').val(data.nama);
          $('#website').val(data.website);
          $('#deskripsi').summernote('code', data.deskripsi);
      }
    });
});



$('#form_deskripsi').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>opd/peta/insert_diskripsi/',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        dataType: 'JSON',
        //async:false,
        success: function(res){
                Swal.fire({
                    title : 'Sukses!',
                    text : "Berhasil Disimpan",
                    type: 'success',
                    timer: 1500
                });
                window.location.href = "<?= base_url('opd/peta/data_peta/').$id;?>";
        }
    });
    return false;
});

function kembali(){
    window.location.href = "<?= base_url('opd/peta/data_peta/').$id;?>";
}

</script>