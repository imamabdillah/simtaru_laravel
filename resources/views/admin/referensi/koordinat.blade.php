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
                    <i class="si si-map text-body-bg-dark mr-2 font-size-sm"></i>
                    Referensi Koordinat Peta
                </h3>

                <button id="btn_tambah_koordinat" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-koordinat"><i class="fa fa-plus"></i> Tambah Koordinat Peta</button>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th style="text-align: center">Nama Koordinat</th>
                            <th style="text-align: center">Keterangan</th>
                            <th style="text-align: center">Tipe</th>
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
<form id="form_koordinat" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modal-koordinat" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-lg" role="document" style="max-width: 80%">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah Koordinat</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div id="contoh_koordinat">
                                    <div>
                                        <h5>Contoh Koordinat Polygon <span style="font-size: smaller; font-weight: lighter;">[ Latitude, Longitude]</span></h5>
                                    </div>
                                    <pre><code class="json hljs">
[
    [
        [
            109.18212890625,
            -6.980954426458483
        ],
        [
            109.09423828125,
            -7.5585466060931426
        ],
        [
            110.093994140625,
            -7.885147283424331
        ],
        [
            110.79711914062499,
            -8.102738577783168
        ],
        [
            111.258544921875,
            -7.863381805309173
        ],
        [
            111.1376953125,
            -6.871892962887516
        ],
        [
            110.753173828125,
            -6.566388979822327
        ],
        [
            110.335693359375,
            -7.079088026071719
        ],
        [
            109.18212890625,
            -6.980954426458483
        ]
    ]
]
</code></pre>

                                    <div>
                                        <h5>Contoh Koordinat LineString <span style="font-size: smaller; font-weight: lighter;">[ Latitude, Longitude]</span></h5>
                                    </div>
                                    <pre><code class="json hljs">
[
    [
        -101.744384,
        39.32155
    ],
    [
        -101.552124,
        39.330048
    ],
    [
        -101.403808,
        39.330048
    ],
    [
        -97.635498,
        38.873928
    ]
 ]
</code></pre>

                                    <div>
                                        <h5>Contoh Koordinat Point <span style="font-size: smaller; font-weight: lighter;">[ Latitude, Longitude]</span></h5>
                                    </div>
                                    <pre><code class="json hljs">[110.70966432255051,-7.459751510223953]</code></pre>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- content -->
                                <div class="form-group row">
                                    <label class="col-12" for="nama_icon">OPD</label>
                                    <div class="col-md-12">
                                        <select name="id_opd" id="id_opd" class="form-control">
                                            @foreach ($data_opd as $opd)
                                                <option value="{{ $opd->id_opd }}" {{ $opd->id_opd == session('id_opd') ? 'selected' : '' }}>
                                                    {{ $opd->nama_opd }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id_koordinat" id="id_koordinat">
                                <div class="form-group row">
                                    <label class="col-12" for="nama_koordinat">Nama Koordinat</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="nama_koordinat" name="nama_koordinat" placeholder="Masukkan nama koordinat">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="ket_koordinat">Keterangan Koordinat</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="ket_koordinat" name="ket_koordinat" placeholder="Tambahkan keterangan koordinat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="tipe_koordinat">Tipe Koordinat</label>
                                    <div class="col-md-12">
                                        <select name="tipe_koordinat" id="tipe_koordinat" class="form-control">
                                            <option value="Polygon">Polygon</option>
                                            <option value="LineString">LineString</option>
                                            <option value="Point">Point</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="koordinat">Koordinat</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="koordinat" name="koordinat" placeholder="Tambahkan koordinat" rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- end content -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-ubah-koordinat">
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
        daftar_koordinat();   // Panggil daftar ikon saat halaman siap

        // RESET FORM SAAT MODAL DITUTUP
        $('#modal-koordinat').on('hidden.bs.modal', function () {
            $('#form_koordinat').trigger('reset'); // Reset semua input
            $('#id_koordinat').val(''); // Hapus ID agar form kembali dalam mode tambah
        });

        // form store referensi koordinat
        $('#form_koordinat').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.referensi.koordinat.store') }}",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response){
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data koordinat berhasil disimpan!',
                        type: 'success',
                        timer: 1500
                    });
                    $('#modal-koordinat').modal('hide');
                    $('#form_koordinat').trigger('reset');
                    $('#mydata').DataTable().ajax.reload(null, false);

                },
                error: function(xhr, status, error){
                    console.log('AJAX error : ', xhr.responseText);
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data koordinat gagal disimpan!',
                        type: 'error',
                        timer: 1500
                    })
                }
            });
        });
        // end store referensi koordinat

        // Form Edit Referensi Bidang koordinat
        $(document).on('click', '.item_edit', function(e) {
            e.preventDefault();
            var id_koordinat = $(this).data('id-koordinat');
            $('#modal-koordinat').modal('show');
            $.ajax({
                url: "{{ url('admin/referensi/koordinat/edit') }}/" + id_koordinat,
                type: "GET",
                data: {id_koordinat:id_koordinat},
                success: function(response){
                    $('#id_koordinat').val(response.id_koordinat);
                    $('#nama_koordinat').val(response.nama_koordinat);
                    $('#ket_koordinat').val(response.ket_koordinat);
                    $('#tipe_koordinat').val(response.tipe_koordinat);
                    $('#koordinat').val(response.koordinat);
                    $('#id_opd').val(response.id_opd).trigger('change'); // Set OPD

                    // Tampilkan preview gambar lama jika ada
                    if (response.nama_koordinat) {
                        $('#preview_koordinat').attr('src', "{{ asset('assets/uploads/marker_koordinat') }}/" + response.nama_koordinat + ".png").show();
                    } else {
                        $('#preview_koordinat').hide();
                    }

                    $('#file_koordinat').removeAttr('required'); // File tidak wajib diupdate
                },
                error: function (xhr, error, status){
                    console.log('AJAX error : ', xhr.responseText);
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data koordinat gagal diambil!',
                        type: 'error',
                        timer: 1500
                    })
                }
            })
        });
        // end edit referensi koordinat

        // Hapus Referensi koordinat
        $(document).on('click', '.item_hapus', function(e) {
            e.preventDefault();
            var id_koordinat = $(this).data('id-koordinat');
            Swal.fire({
                title: 'Anda yakin?',
                text: 'Data koordinat akan dihapus!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Hapus sekarang!',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url: "{{ url('admin/referensi/koordinat/delete') }}/" + id_koordinat,
                    type: "POST",
                    data: {
                        _method: 'DELETE', 
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response){
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data koordinat berhasil dihapus!',
                            type: 'success',
                            timer: 1500
                        });
                        $('#mydata').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr, error, status){
                        console.log('AJAX error : ', xhr.responseText);
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data koordinat gagal dihapus!',
                            type: 'error',
                            timer: 1500
                        })
                    }
                });
                }
            });
        });

    });

    // fungsi menampilkan datatable koordinat
    function daftar_koordinat() {
        // Jika DataTable sudah ada, destroy dulu
        if ($.fn.DataTable.isDataTable('#mydata')) {
            $('#mydata').DataTable().destroy();
        }

        // Inisialisasi DataTables dengan Ajax
        $('#mydata').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.referensi.koordinat.data') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_koordinat', name: 'nama_koordinat' },
                { data: 'ket_koordinat', name: 'ket_koordinat' },
                { data: 'tipe_koordinat', name: 'tipe_koordinat' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });
    }
</script>