<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <div class="block block-themed">
            <div class="block-header block-header-default">
                <h3 class="block-title">Daftar Berita</h3>
                <button type="button" class="btn btn-success btn-square berita_baru" style="margin-bottom:10px"><i class="fa fa-newspaper-o"></i> Berita Baru</button>
            </div>
            <div class="block-content block-content-full">
                
            <table id="berita_list" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 7%;">No</th>
                        <th class="text-center">Judul Berita</th>
                        <th class="text-center" style="width: 10%;">Status</th>
                        <th class="text-center" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                
            </table>

            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->

<script>
$(document).ready(function(){
    function berita_list() {
        $('#berita_list').dataTable({
            pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: "<?=base_url()?>opd/website/berita/get_berita",
            
            columns: [
                    {'data': (d)=>{
                        return d.no;
                    }},
                    {'data': 'judul'},
                    {'data': (d)=>{
                        return '<span class="btn btn-sm btn-success">Active</span>';
                    }},
                    {'data': (d)=>{
                            let btn = '';
                            btn += '<div class="btn-group text-center" role="group">';
                            btn += '<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            btn += '<i class="fa fa-list"></i></button>';
                            btn += '<div class="dropdown-menu">';
                            
                            btn += '<a href="<?=base_url()?>opd/website/berita/berita_edit/'+d.id_berita+'" class="btn btn-sm btn-secondary btn-square min-width-125 show_modal_edit"><span class="fa fa-pencil"></span> Edit </a><br>';
                            btn += '<a href="" onclick="event.preventDefault(); berita_hapus(this,'+d.id_berita+');" class="btn btn-sm btn-secondary btn-square min-width-125"><span class="fa fa-trash"></span> Hapus </a>';
                            btn += '</div></div>';
                        return btn;
                    }}],
            columnDefs: [
                {
                    targets: [0,2,3],
                    className: 'dt_body_center'
                },
                { 
                    orderable: false, 
                    targets: [ 3 ] 
                }
                ],
        });
    };

berita_list();

$(".berita_baru").click(function() {
    window.location.replace('<?= base_url('opd/website/berita/berita_baru');?>');
});

})
function berita_hapus(t,id){
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
            url: '<?=base_url()?>opd/website/berita/berita_hapus',
            type: 'POST',
            dataType: 'JSON',
            data: {id:id},
            success: function(res){
                if(res.notif.status == 'success'){
                    Swal.fire({
                        title : 'Sukses!',
                        text : res.notif.message,
                        type: 'success',
                        timer: 1500
                    });
                    $(t).parents().eq(3).remove();
                }else{
                    Swal.fire({
                        title : 'Gagal!',
                        text : res.notif.message,
                        type: 'error',
                        timer: 1500
                    });
                }
            }
        })
            
        }
    });
    
}


</script>