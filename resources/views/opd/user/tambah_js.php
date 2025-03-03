
<script>

$(document).ready(function(){
    tampil_data_barang();   //pemanggilan fungsi tampil barang.
});

          
//fungsi tampil barang
function tampil_data_barang(){
    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url()?>opd/user/daftar_user',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                role = data[i].role;
                if(role == 1){
                    role = 'Administrator';
                }else{
                    role = 'OPD';
                }

                status = data[i].is_active;
                if(status == 1){
                    status = 'Aktif';
                }else{
                    status = 'Non Aktif';
                }
                html += '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].nama+'</td>'+
                        '<td>'+role+'</td>'+
                        '<td>'+status+'</td>'+
                        '<td style="text-align:right;">'+
                            '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">'+
                                '<button data="'+data[i].id_layer+'" type="button" class="btn btn-primary"><i class="fa fa-database"></i> Data</button>'+
                                '<button data="'+data[i].id_layer+'" type="button" class="btn btn-success"><i class="fa fa-edit"></i> Kelola</button>'+
                            '</div> '+
                            '<button data="'+data[i].id_layer+'" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').dataTable({
        "columnDefs": [
            { "width": "10px", "targets": 0 },
            { "width": "170px", "orderable": false, "targets": 4 }
        ],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang cocok",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_ total halaman",
            "infoEmpty": "Belum ada data yang bisa ditampilkan",
            "infoFiltered": "(diseleksi dari _MAX_ total data)",
            "search":"Cari:",
            "paginate": {
                "first":      "Pertama",
                "last":       "Terakhir",
                "next":       "Selanjutnya",
                "previous":   "Sebelumnya"
            },
        }
    });
}
</script>