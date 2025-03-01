<script>
$('.angka-saja').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

$('#tambah_data_peta').submit(function(e){
    // var coord = JSON.stringify(Object.assign({},coords));
        var coord = JSON.stringify(coords.coordinates);
    //console.log(coord);
    var form_data = new FormData(this);
    form_data.append('coordinates',coord);
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/peta/simpan_data_peta',
        type:"post",
        data: form_data,
        processData:false,
        contentType:false,
        cache:false,
        //async:false,
        success: function(response){
            Swal.fire({
                title : 'Sukses!',
                text : 'Data berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            // window.location.replace("<?= base_url('admin/peta/data_peta/').$this->uri->segment(4);?>");
            //console.log(response);
        }
    });
    return false;
});

</script>