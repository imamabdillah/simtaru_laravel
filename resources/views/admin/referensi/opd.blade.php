@extends('layouts.wrapper')
<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
@section('contents')
<!-- Main Container -->
<main id="main-container">
    <div class="content">

        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title">
                    <i class="fa fa-users text-body-bg-dark mr-2 font-size-sm"></i>
                    Referensi OPD
                </h3>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-opd"><i class="fa fa-plus"></i> Tambah OPD</button>
            </div>
            <div class="block-content">
                <table class="table table-striped display" id="mydata">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th style="text-align: center">Nama OPD</th>
                            <th style="text-align: center;width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<form id="form_opd" enctype='multipart/form-data'>
    @csrf
    <div class="modal fade" id="modal-opd" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah OPD</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- content -->
                        <input type="hidden" name="id_opd" id="id_opd">
                        <div class="form-group row">
                            <label class="col-12" for="nama_opd">Nama OPD</label>
                            <div class="col-md-12">
                                <input required type="text" class="form-control" id="nama_opd" name="nama_opd" placeholder="Masukkan nama opd">
                            </div>
                        </div>

                        <!-- end content -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-ubah-opd">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END Pop In Modal -->
@endsection

<!-- jQuery harus di-load lebih awal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    // daftar data Referensi OPD
    $('#mydata').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.referensi.bidang.data') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_opd', name: 'nama_opd'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ]
    });

        // RESET FORM SAAT MODAL DITUTUP
        $('#modal-opd').on('hidden.bs.modal', function () {
            $('#form_opd').trigger('reset'); // Reset semua input
            $('#id_opd').val(''); // Hapus ID agar form kembali dalam mode tambah
        });

    // Form Store Referensi Bidang OPD
    $('#form_opd').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.referensi.bidang.store') }}",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(response){
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data OPD berhasil disimpan!',
                    type: 'success',
                    timer: 1500
                });
                $('#modal-opd').modal('hide');
                $('#form_opd').trigger('reset');
                $('#mydata').DataTable().ajax.reload(null, false);

            },
            error: function(xhr, status, error){
                console.log('AJAX error : ', xhr.responseText);
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data OPD gagal disimpan!',
                    type: 'error',
                    timer: 1500
                })
            }
        });

    });
    // end store referensi bidang

    // Form Edit Referensi Bidang OPD
    $(document).on('click', '.item_edit', function(e) {
        e.preventDefault();
        var id_opd = $(this).data('id-opd');
        $('#modal-opd').modal('show');
        $.ajax({
            url: "{{ url('admin/referensi/opd/edit') }}/" + id_opd,
            type: "GET",
            data: {id_opd:id_opd},
            success: function(response){
                $('#id_opd').val(response.id_opd);
                $('#nama_opd').val(response.nama_opd);
            },
            error: function (xhr, error, status){
                console.log('AJAX error : ', xhr.responseText);
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data OPD gagal diambil!',
                    type: 'error',
                    timer: 1500
                })
            }
        })
    });

    // Hapus Referensi Bidang OPD
    $(document).on('click', '.item_hapus', function(e) {
        e.preventDefault();
        var id_opd = $(this).data('id-opd');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Data OPD akan dihapus!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Hapus sekarang!',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
            $.ajax({
                url: "{{ url('admin/referensi/opd/delete') }}/" + id_opd,
                type: "POST",
                data: {
                    _method: 'DELETE', 
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data OPD berhasil dihapus!',
                        type: 'success',
                        timer: 1500
                    });
                    $('#mydata').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, error, status){
                    console.log('AJAX error : ', xhr.responseText);
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data OPD gagal dihapus!',
                        type: 'error',
                        timer: 1500
                    })
                }
            });
            }
        });
    });


});
    
</script>