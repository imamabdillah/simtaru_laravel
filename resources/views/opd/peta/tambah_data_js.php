<script>

$(document).ready(function(){
    
    $('#icon_name').select2({
        templateResult: formatState,
        templateSelection: formatState
    });
    // $('#pilih_koordinat').select2();
    $('#pilih_koordinat').select2({
        ajax: {
            url: '<?=base_url()?>opd/peta/ref_koordinat',
            dataType: 'JSON',
            data: function(d){
                let q = {
                    search: d.term,
                    type: '<?=$this->uri->segment(5)?>'
                }
                return q;
            },
            delay: 500
        }
    });
})

function formatState (state) {
    // console.log(state);
    var icon;
    if(state.text != 'Searching…')
    {
        icon = state.element.attributes['data-img'].value;
    }
    
    if (!state.id) { return state.text; }
    var $state = $(
        '<span ><img class="select2_img" sytle="display: inline-block;" src="<?=base_url()?>assets/uploads/marker_icon/'+icon+'.png" /> ' + state.text + '</span>'
    );
    return $state;
 }
$('.angka-saja').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});



$('#tambah_data_peta').submit(function(e){
    e.preventDefault();
    if(typeof coords === 'undefined')
    {
        Swal.fire({
            title : 'Gagal!',
            text : 'Koordinat lokasi tidak terdeteksi',
            type: 'error'
        });
    }
    else
    {
        // var coord = JSON.stringify(Object.assign({},coords));
            // var coord = JSON.stringify(coords.coordinates);
            var coord = coords;
        //console.log(coord);
        var form_data = new FormData(this);
        form_data.append('coordinates',coord);
        $.ajax({
            url:'<?php echo base_url();?>opd/peta/simpan_data_peta',
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
                window.location.replace("<?= base_url('opd/peta/data_peta/').$this->uri->segment(4);?>");
                //console.log(response);
            }
        });
        return false;
    }
    
});

</script>