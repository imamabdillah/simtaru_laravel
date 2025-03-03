<!-- Page JS Plugins -->
<script src="<?= base_url();?>assets/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/dropzonejs/min/dropzone.min.js"></script>

<script type="text/javascript">
    // Upload Foto
      var dropzone= new Dropzone(".dropzone",{
        url: "<?php echo base_url()?>opd/peta/upload_foto/",
        uploadMultiple: false,
        maxFilesize: 2,
        method:"post",
        acceptedFiles:"image/*",
        paramName:"file_upload",
        dictInvalidFileType:"Type file ini tidak dizinkan",
        addRemoveLinks:true,

        error: function(file, errorMessage) {
            errors = true;
        },
        queuecomplete: function() {
          Swal.fire(
            'Success!',
            'Data berhasil diimport!',
            'success'
          )
        }
      });

      dropzone.on("sending",function(a, b, file_upload){
        var id_collection = $('#id_collection').val();
        file_upload.append("id_collection",id_collection);
      });

      dropzone.on("complete", function(file) {
        var id_collection = $('#id_collection').val();
        dropzone.removeFile(file);
        tampil_foto(id_collection);
      });
    // Btas Upload Foto


    function tampil_foto(id_collection){
        $.ajax({
          type: 'GET',
          url: '<?= base_url();?>opd/peta/ambil_foto/',
          data: {id_collection: id_collection},
          dataType: 'JSON',
          success: function(data){
              $('.class_foto').remove();
              var html = "";

              for (var i = 0; i < data.length; i++) {
                html +=         '<div class="col-md-4 animated fadeIn class_foto">'+
                                '    <div class="options-container">'+
                                '        <img class="img-fluid options-item" src="<?= base_url();?>assets/uploads/foto_collection/'+data[i].id_collection+'/'+data[i].file+'" alt="" style="height: 200px; ">'+
                                '        <div class="options-overlay bg-black-op-75">'+
                                '            <div class="options-overlay-content">'+
                                '                <a class="btn btn-sm btn-rounded btn-alt-primary min-width-75 img-link img-link-zoom-in img-lightbox" onclick="hide_modal_foto()" href="<?= base_url();?>assets/uploads/foto_collection/'+data[i].id_collection+'/'+data[i].file+'"><i class="fa fa-search"></i> Show </a>'+
                                '                <a class="btn btn-sm btn-rounded btn-alt-danger min-width-75" href="javascript:;" onclick="show_modal_hapus('+data[i].id+', '+data[i].id_collection+')"><i class="fa fa-times"></i> Delete </a>'+
                                '            </div>'+
                                '        </div>'+
                                '    </div>'+
                                '</div>';
              }

              $('#form_tempat_foto').prepend(html)
          }
        });
    }

    function show_modal_hapus(id, id_collection){
      Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Hapus sekarang!',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.value) {
              
              $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url()?>opd/peta/do_delete/',
                  data: {id: id, id_collection: id_collection},
                  dataType: 'JSON',
                  success: function(data){
                    Swal.fire(
                        'Terhapus!',
                        'Data yang dipilih telah dihapus!',
                        'success'
                    )
                    tampil_foto(id_collection);
                  }
              });

              
          }
      });
    }
</script>

<script type="text/javascript">
    function hide_modal_foto(){
        $('#modal-foto').modal('hide');
    }

    $('.mfp-close').click(function(){
        $('#modal-foto').modal('show');
    })
</script>

<script>
jQuery(function () {
    // Init page helpers (Magnific Popup plugin)
    Codebase.helpers('magnific-popup');
});

$(document).ready(function(){
    tampil_data();
    $('.tipe').select2({
        theme: "bootstrap",
        dropdownParent: $('#modal-popin'),
        placeholder: "Pilih tipe layer",
        // allowClear: true,
        language: "id",
        minimumResultsForSearch: -1
    });

    function tampil_data(){
        table = $('#mydata').DataTable();
        table.destroy();
        table.draw();
        $.ajax({
            type  : 'post',
            url   : '<?php echo base_url()?>opd/peta/get_data_layer/<?=$this->uri->segment(4)?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;

                for(i=0; i<data['data'].length; i++){
                    html += '<tr>'+
                            '<td style="text-align: center;">'+(1+i)+'</td>';
                    for (var q = 0; q < data['data_jumlah_attribute'].length; q++) {
                        html += '<td style="text-align: left;">'+data['data'][i][data['data_jumlah_attribute'][q].nama_atribut]+'</td>';
                    }
                            
                    html += '<td style="text-align: center;">'+
                                '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'+data['data'][i].id_layer+'" onclick="hapus_data('+data['data'][i].id_collection+')"><i class="fa fa-trash"></i></button> '+
                                ' '+
                                '<a href="<?= base_url();?>opd/peta/diskripsi/<?= $id;?>/'+data['data'][i].id_collection+'" class="btn btn-sm btn-warning mb-10" data="'+data['data'][i].id_layer+'"><i class="fa fa-file"></i></a> '+
                                ' '+
                                '<button type="button" class="btn btn-sm btn-primary mb-10" data="'+data['data'][i].id_layer+'" onclick="tombol_modal_foto('+data['data'][i].id_collection+')"><i class="fa fa-image"></i></button> '+
                            '</td>'+
                            '</tr>';
                }
                $('#show_data').html(html);
            }
        });
        $('#mydata').DataTable({
            scrollX: true
        });
    }

    $('#import_process').hide();

    $('#import_geojson').on('submit', function(e){
        $('#import_process').show();
        $('#btn_import').attr('disabled','disabled');
        e.preventDefault();
        $.ajax({
            url: "<?=base_url()?>opd/peta/import_data_peta",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON'
        })
        .done(res=>{
            if(res.status == 'success')
            {
                $('#import_process').hide();
                location.reload();
            }
            else
            {
                $('#import_process').hide();
                $('#btn_import').removeAttr('disabled');
                alert(res.message);
            }
            
        })
    })

    $('#btn_import_template').on('click', function(e){
        $.ajax({
            url: "<?=base_url()?>opd/peta/import_template",
            type: "POST",
            data: {id_layer: '<?=$this->uri->segment(4)?>'},
            dataType: 'JSON'
        })
        .done(res=>{
            let html  = '<pre>';
                html += JSON.stringify(res, undefined, 2);
                html += '<pre>';
            $('#template_geojson').html(html);
        })
    })

   
});

$( ".btn-simpan" ).click(function() {
    tipe = $(".tipe").val();
    if(tipe != ""){
        window.location.replace("<?= base_url('opd/peta/tambah_data_peta/').$this->uri->segment(4); ?>/"+tipe);
    }else{
        Swal.fire({
            title : 'Perhatian!',
            text : 'Silahkan pilih tipe layer terlebih dahulu',
            type: 'warning',
            timer: 1500
        });
    }
    // alert(tipe);
    
});

function hapus_data(id_collection){
    Swal.fire({
        title: 'Apakah anda yakin!',
        text: "Apakah anda yakin akan menghapus data ini?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Hapus sekarang!',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>opd/peta/hapus_data_layer',
                async : false,
                dataType : 'json',
                data  : {id_collection : id_collection},
                success : function(data){
                    Swal.fire(
                        'Terhapus!',
                        'Data yang dipilih telah dihapus!',
                        'success'
                    )
                    location.reload();
                }
            });
            
        }
    });
}

function tombol_modal_foto(id_collection){
    tampil_foto(id_collection);
    $('#id_collection').val(id_collection);
    $('#modal-foto').modal('show');
}


</script>