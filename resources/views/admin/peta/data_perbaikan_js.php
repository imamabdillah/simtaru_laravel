<!-- Page JS Plugins -->
<script src="<?= base_url();?>assets/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/dropzonejs/min/dropzone.min.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
        let status = false;

    $(document).ready(function() {

        var id = '<?= @$id ?>';
        load_table(id); 
    });

    function load_table(id) {
        $('#table-data').dataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            lengthMenu: [
                [10, 25, -1],
                [10, 25, "All"]
            ],
            order: [],
            ajax: {
                url: "<?php echo base_url('admin/peta/daftar_layer_perbaikan/') ?>"+id,
                type: "POST",
                dataType: "json"
            },
            columnDefs: [{
                    targets: [0,3],
                    orderable: false
                },
                {
                    targets: [0],
                    className: 'text-center'
                },
            ],
        });
    }

    $('#tombol_tambah').click(function() {
        $('#modal_input').modal('show');
	})
    
    function cek_required() {
        status = true;
        $('#form_input .required').each(function() {
            if ($(this).val() == "") {
                toastr.error('Ada inputan yang belum terisi', 'Gagal', {
                    timeOut: 2000,
                    fadeOut: 2000
                });
                status = false;
            }
        });
        return status;
    }

    $('#form_input').submit(function(e) {
        e.preventDefault();

        if (cek_required() == true) {
            let data = new FormData(this);
            var url = "<?php echo base_url('admin/peta/store_perbaikan') ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false, 
                success: function(data) { 
                    if (data.status == true) {
                        $('#modal_input').modal('hide');
                        load_table(data.id_data)
                        toastr.success('Data berhasil ditambahkan', 'Berhasil', {
                            timeOut: 2000,
                            fadeOut: 2000
                        }); 

                        $('#tombol_tambah').text("Simpan");
                    } else {
                        $('#tombol_tambah').text("Simpan");

                        toastr.error('Periksa Inputan Anda', {
                            timeOut: 2000,
                            fadeOut: 2000
                        });
                    }
                },
                error: function() {
                    toastr.error('Periksa Inputan Anda', {
                        timeOut: 2000,
                        fadeOut: 2000
                    }); 
                }
            });
        }
    });

    $('#show_data').on('click', '.btn_hapus', function() {
        var id = $(this).attr('data');

        Swal.fire({
            title: 'Apakah Anda Yakin',
            text: "Anda akan menghapus data ini",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-secondary ml-1',
            buttonsStyling: false,
        }).then(function(result) {

            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url('admin/peta/hapus_perbaikan/') ?>" + id,
                    type: "GET", 
                    dataType: "JSON",
                    success: function(data) { 
                        console.log(data)
                        if (data.status == true) {
                            load_table(data.id_data)
                            toastr.success('Data berhasil dihapus'); 
                        }  else {
                            toastr.error('Koneksi bermasalah', {
                                timeOut: 2000,
                                fadeOut: 2000
                            });
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

            }
        });
    })

    $('#show_data').on('click', '.btn_ubah', function() {
        var id = $(this).attr('data');

        $.ajax({
            url: "<?= base_url('admin/peta/detail_perbaikan/') ?>"+id,
            type: 'GET',
            dataType: 'JSON', 
            success: function(data) { 
                if (data.status == true) {
                    $('#form_id_perbaikan').val(data.data.id_perbaikan); 
                    $('#form_tahun').val(data.data.tahun); 
                    $('#form_paket_pekerjaan').val(data.data.paket_pekerjaan); 
                    $('#form_anggaran').val(data.data.anggaran); 
                    $('#form_pelaksana').val(data.data.pelaksana); 
                    $('#form_no_kontrak').val(data.data.no_kontrak); 
                    $('#form_tgl_kontrak').val(data.data.tgl_kontrak); 
                    $('#form_lokasi').val(data.data.lokasi); 
                    $('#form_tgl_mulai').val(data.data.tgl_mulai); 
                    $('#form_tgl_selesai').val(data.data.tgl_selesai); 
                    $('#form_realisasi').val(data.data.realisasi); 

                    $('#modal_input').modal('show'); 
                } else {
                    toastr.error( 'Gagal Memuat Detail Template, Koneksi Bermasalah', { timeOut: 2000, fadeOut: 2000 }); 
                    // location.reload();
                }

            },
            error: function() {
                toastr.error( 'Gagal Memuat Detail Template, Koneksi Terputus', { timeOut: 2000, fadeOut: 2000 });
                // location.reload();
            }
        });
    })
</script>