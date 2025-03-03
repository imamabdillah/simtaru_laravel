
<script>

$(document).ready(function(){
    var no = 0;
    $('#mydata').dataTable({
        pagingType: "full_numbers",
        pageLength: 10,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false,
        ajax: "<?=base_url()?>opd/api/get_permohonan_api",
        
        columns: [
                {'data': (d)=>{
                    no++;
                    return no;
                }},
                {'data': 'nama_pemohon'},
                {'data': 'token'},
                {'data': 'created_at'},
                {'data': (d)=>{
                    return '<a href="<?=base_url()?>api/get/'+d.token+'/d" target="_blank"><?=base_url()?>api/get/'+d.token+'/d</a>';
                }},
                {'data': (d)=>{
                        let btn  = '';
                            btn += '<button class="btn btn-sm btn-danger" onclick="hapus_api('+d.id_api+')">Hapus</button>' ;
                    return btn;
                }}],
        columnDefs: [
            {
                targets: [0,2,3,5],
                className: 'dt_body_center'
            },
            { 
                orderable: false, 
                targets: [ 5 ] 
            }
            ],
    });

});

$('#form_api').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    
    $.ajax({
        url: '<?=base_url()?>opd/api/tambah_permohonan_api',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false
    })
    .then(res=>{
        if(res.status == 'success')
        {
            Swal.fire({
                title : 'Sukses!',
                text : 'Permohonan API berhasil ditambahkan',
                type: 'success',
                timer: 1500
            });
            setTimeout(function(){
                location.reload();
            },1000);
        }
        else
        {
            Swal.fire({
                title : 'Gagal!',
                text : res.message,
                type: 'error'
            });
        }
    })
})
         
function hapus_api(id_api){
    Swal.fire({
        title: 'Apakah anda yakin!',
        text: "Apakah anda yakin akan menghapus data ini?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Hapus sekarang!',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>opd/api/hapus_permohonan_api',
                async : false,
                dataType : 'JSON',
                data  : {id_api : id_api},
                success : function(res){
                    if(res.status == 'success')
                    {
                        Swal.fire({
                            title : 'Sukses!',
                            text : 'Permohonan API berhasil dihapus',
                            type: 'success',
                            timer: 1500
                        });
                        location.reload();
                    }
                    else
                    {
                        Swal.fire({
                            title : 'Gagal!',
                            text : 'Permohonan API gagal dihapus',
                            type: 'error'
                        });
                    }
                    
                }
            });
            
        }
    });
}

</script>