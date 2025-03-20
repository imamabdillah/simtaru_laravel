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
            @if ($atribut->isNotEmpty()) {{-- Pastikan atribut ada --}}

                <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah-data">
                    <i class="fa fa-plus mr-5"></i> Tambah Data <span>{{ $layer->nama_layer }}</span>
                </button>
                <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-import-data" data-toggle="modal"
                    data-target="#modal-import">
                    <i class="fa fa-upload mr-5"></i> Import Data <span>{{ $layer->nama_layer }}</span>
                </button>

                <button id="btn_import_template" type="button"
                    class="btn btn-square btn-secondary mr-5 mb-5 btn-export-data" data-toggle="modal"
                    data-target="#modal-template">
                    <i class="fa fa-file mr-5"></i> Template Geojson <span>{{ $layer->nama_layer }}</span>
                </button>

                <div class="block block-themed">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title"><i class="fa fa-database"></i> Daftar Data "<b
                                id="judul-sub-layer">{{ $layer->nama_layer }}</b>"</h3>
                        <div class="block-options">
                            <a class="btn btn-sm btn-danger" href="{{ url('admin/peta') }}">
                                <i class="fa fa-angle-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- Table start -->
                        <table class="table table-striped nowrap" id="mydata" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 40px;">No</th>
                                    @if ($atribut->isNotEmpty())
                                        @foreach ($atribut as $row)
                                            <th style="text-align: center;">{{ $row->nama_atribut }}</th>
                                        @endforeach
                                    @else
                                        <th style="text-align: center;">Tidak Ada Atribut</th>
                                    @endif
                                    <th style="text-align: center; width: 40px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data_peta as $id_collection => $values)
                                    <tr role="row" class="odd">
                                        <td style="text-align: center;" class="sorting_1">{{ $loop->iteration }}</td>
                                        @foreach ($atribut as $row)
                                            @php
                                                $nilai = $values->where('id_atribut', $row->id_atribut)->first();
                                            @endphp
                                            <td style="text-align: center;">{{ $nilai->data_value ?? '-' }}</td>
                                        @endforeach
                                        <td style="text-align: center;">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('admin/peta/diskripsi/' . $layer->id_layer . '/' . $id_collection) }}"
                                                    class="btn btn-sm btn-success mx-2"
                                                    data-id-layer="{{ $layer->id_layer }}" title="Deskripsi Halaman Detail">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    data-id-layer="{{ $layer->id_layer }}"
                                                    onclick="tombol_modal_foto({{ $id_collection }})">
                                                    <i class="fa fa-image" title="Tambah Foto"></i>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-center mt-1">
                                                <a class="btn btn-warning btn-sm btn-edit-data mx-2"
                                                    data-id-collection="{{ $id_collection }}"
                                                    data-id-layer="{{ $layer->id_layer }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger item_hapus"
                                                    data-id-collection="{{ $id_collection }}" title="Hapus Data">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $atribut->count() + 2 }}" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Table end -->
                    </div>

                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Mohon maaf</h4>
                    <p>Layer peta belum memiliki atribut</p>
                    <hr>
                    <button type="button" class="btn btn-square btn-danger tambah-atribut"
                        onclick="window.location.href='{{ url('admin/peta/edit_layer/' . $layer->id_layer) }}'">
                        <i class="fa fa-plus"></i> Buat atribut
                    </button>
                </div>
            @endif
        </div>
    </main>

    @foreach ($atribut as $item)
        <!-- END Main Container -->
        <!-- Pop In Modal -->
        <div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.peta.add_data_layer') }}" method="post" id="form-data">
                        @csrf
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Buat Data {{ $item->nama_layer }}</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <input type="hidden" name="id_layer" value="{{ $layer->id_layer ?? '' }}">
                                    <label class="col-12" for="tipe">Tipe Layer</label>
                                    <div class="col-md-12">
                                        <select required class="tipe form-control" id="tipe" name="tipe_layer"
                                            style="width: 100%;">
                                            <option value=""></option>
                                            <option value="point">Point</option>
                                            <option value="line">Line</option>
                                            <option value="polygon">Polygon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-alt-success btn-simpan">
                                <i class="fa fa-check"></i> Buat Data Baru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Pop In Modal -->

        <!-- modal import -->
        <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-import"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin" role="document">
                <div class="modal-content">
                    <form id="import_geojson" enctype='multipart/form-data'>
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Import data {{ $item->nama_layer }}</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal"
                                        aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <label for="import_geojson">Import Geojson</label>
                                    <input type="file" name="import_geojson" class="form-control">
                                    <input type="hidden" name="id_layer" value="{{ $layer->id_layer }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <span id="import_process" style="width:100%">
                                <svg style="margin-bottom:-5px;" width="20px" height="20px"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                                    preserveAspectRatio="xMidYMid" class="lds-ring">
                                    <circle cx="50" cy="50" ng-attr-r="{{ config . radius }}"
                                        ng-attr-stroke="{{ config . base }}" ng-attr-stroke-width="{{ config . width }}"
                                        fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle>
                                    <circle cx="50" cy="50" ng-attr-r="{{ config . radius }}"
                                        ng-attr-stroke="{{ config . stroke }}"
                                        ng-attr-stroke-width="{{ config . innerWidth }}"
                                        ng-attr-stroke-linecap="{{ config . linecap }}" fill="none" r="30"
                                        stroke="#63cff3" stroke-width="10" stroke-linecap="square"
                                        transform="rotate(323.411 50 50)">
                                        <animateTransform attributeName="transform" type="rotate" calcMode="linear"
                                            values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s"
                                            begin="0s" repeatCount="indefinite"></animateTransform>
                                        <animate attributeName="stroke-dasharray" calcMode="linear"
                                            values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882"
                                            keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite">
                                        </animate>
                                    </circle>
                                </svg>
                                <span style="font-size: smaller; font-weight: normal;">Sedang memproses import
                                    data...</span>
                            </span> --}}
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                            <button id="btn_import" type="submit" class="btn btn-alt-success btn-import">
                                <i class="fa fa-upload"></i> Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal import -->

        <!-- modal template -->
        <div class="modal fade" id="modal-template" tabindex="-1" role="dialog" aria-labelledby="modal-template"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Template Geojson {{ $item->nama_layer }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div id="template_geojson" class="form-group row" style="padding:20px">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal template -->


        <!-- modal foto -->
        <div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="modal-template"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">File Upload {{ $item->nama_layer }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div {{-- id="template_geojson" --}} class="form-group row" style="padding:20px">
                                <input type="hidden" name="id_collection" id="id_collection">
                                <div class="row items-push js-gallery img-fluid-100" id="form_tempat_foto">

                                    <!-- Lokasi Foto Disini -->

                                    <div class="form-group row ml-20" data-toggle="appear" data-offset="-200">
                                        <div class="dropzone" id="jaringan_jalan_block"
                                            action="{{ url('api/psu/upload_foto/do_upload') }}" method="post"
                                            style="min-width: 230px; height: 200px; "></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal foto -->
    @endforeach

@endsection
<!-- jQuery harus di-load lebih awal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dropzonejs/min/dropzone.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        if (Dropzone.instances.length > 0) {
            Dropzone.instances.forEach(instance => instance.destroy());
        }
        // Inisialisasi Dropzone
        let dropzone = new Dropzone(".dropzone", {
            url: "{{ route('admin.peta.upload_foto') }}",
            uploadMultiple: false,
            maxFilesize: 10,
            method: "post",
            acceptedFiles: "image/*,application/pdf",
            paramName: "file_upload",
            dictInvalidFileType: "Tipe file ini tidak diizinkan",
            addRemoveLinks: true,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            error: function(file, errorMessage) {
                console.error("Upload error: ", errorMessage);
            },
            queuecomplete: function() {
                Swal.fire(
                    "Success!",
                    "Data berhasil diunggah!",
                    "success"
                );
            }
        });

        dropzone.on("sending", function(file, xhr, formData) {
            let id_collection = $("#id_collection").val();
            formData.append("id_collection", id_collection);
        });

        dropzone.on("complete", function(file) {
            let id_collection = $("#id_collection").val();
            dropzone.removeFile(file);
            tampil_foto(id_collection);
        });
    });

    // Menampilkan Foto
    function tampil_foto(id_collection) {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.peta.get_foto') }}",
            data: {
                id_collection: id_collection
            },
            dataType: "JSON",
            success: function(data) {
                $(".class_foto").remove();
                let html = "";

                data.forEach(item => {
                    let file = "";
                    let ekstensi = item.file.split(".").pop().toLowerCase();
                    let fileUrl =
                        `{{ asset('assets/uploads/foto_collection/') }}/${item.id_collection}/${item.file}`;

                    if (["pdf"].includes(ekstensi)) {
                        file =
                            `<iframe style="height: 200px" class="options-item" src="${fileUrl}" frameborder="0"></iframe>`;
                        link_klik =
                            `<a class="btn btn-sm btn-rounded btn-alt-primary min-width-75" href="${fileUrl}" target="_blank"><i class="fa fa-search"></i> Show </a>`;
                    } else if (["png", "jpg", "jpeg"].includes(ekstensi)) {
                        file =
                            `<img class="img-fluid options-item" src="${fileUrl}" alt="" style="height: 200px;">`;
                        link_klik =
                            `<a class="btn btn-sm btn-rounded btn-alt-primary min-width-75 img-link img-link-zoom-in img-lightbox" onclick="hide_modal_foto()" href="${fileUrl}"><i class="fa fa-search"></i> Show </a>`;
                    }

                    html += `
                        <div class="col-md-4 animated fadeIn class_foto">
                            <div class="options-container">
                                ${file}
                                <div class="options-overlay bg-black-op-75">
                                    <div class="options-overlay-content">
                                        ${link_klik}
                                        <a class="btn btn-sm btn-rounded btn-alt-danger min-width-75" href="javascript:;" onclick="show_modal_hapus(${item.id}, ${item.id_collection})"><i class="fa fa-times"></i> Delete </a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });

                $("#form_tempat_foto").prepend(html);
            }
        });
    }

    // Hapus Foto
    function show_modal_hapus(id, id_collection) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Hapus sekarang!",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.peta.delete_foto') }}",
                    data: {
                        id: id,
                        id_collection: id_collection,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "JSON",
                    success: function() {
                        Swal.fire("Terhapus!", "Data yang dipilih telah dihapus!", "success");
                        tampil_foto(id_collection);
                    }
                });
            }
        });
    }
</script>

<script type="text/javascript">
    function hide_modal_foto() {
        $('#modal-foto').modal('hide');
    }

    $('.mfp-close').click(function() {
        $('#modal-foto').modal('show');
    })
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-tambah-data', function() {

            $('#modal-popin').modal('show');
        });

        $(document).on('click', '.btn-import-data', function() {
            $('#modal-import').modal('show');
        });

        $(document).on('click', '.btn-export-data', function() {
            $('#modal-template').modal('show');
        });

        // $(document).on('click', '.edit-atribut', function () {
        //     var url = $(this).data('url');
        //     window.location.href = url;
        // });

        $(document).on('click', '.btn-edit-data', function(e) {
            e.preventDefault();

            var id_collection = $(this).data('id-collection');
            var id_layer = $(this).data('id-layer');

            $.ajax({
                url: '{{ url('admin/peta/get_tipe_layer') }}/' + id_collection,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var tipe_layer = response.tipe_layer;
                        window.location.href = '{{ url('admin/peta/edit_data_peta') }}/' +
                            id_layer + '/' + tipe_layer + '/' + id_collection;
                    } else {
                        alert('Tipe layer tidak ditemukan.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil tipe layer.');
                }
            });
        });

        $(document).on('click', '.item_hapus', function(e) {
            e.preventDefault();
            var id_collection = $(this).data('id-collection');
            console.log('Button hapus diklik, ID:', id_collection); // Debugging
            hapus_data(id_collection);
        });

        $('#btn_import_template').on('click', function(e) {
            let idLayer = {{ request()->segment(4) }}; // Ambil ID layer dari blade template

            $.ajax({
                    url: "/admin/peta/import_template/" + idLayer,
                    type: "GET",
                    dataType: "JSON"
                })
                .done(res => {
                    let html = '<pre>' + JSON.stringify(res, undefined, 2) + '</pre>';
                    $('#template_geojson').html(html);
                })
                .fail(err => {
                    console.error("Terjadi kesalahan:", err);
                });
        });

        $('#import_process').hide();



        // $('#import_geojson').on('submit', function(e) {
        //     e.preventDefault();
        //     // $('#import_process').show();
        //     $('#btn_import').attr('disabled', 'disabled');

        //     $.ajax({
        //         url: "/admin/peta/import-data-peta",
        //         type: "POST",
        //         data: new FormData(this),
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         dataType: 'JSON',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     })
        //     .done(res => {
        //         $('#import_process').hide();
        //         if (res.status === 'success') {
        //             location.reload();
        //         } else {
        //             $('#btn_import').removeAttr('disabled');
        //             alert(res.message);
        //         }
        //     })
        //     .fail(err => {
        //         $('#import_process').hide();
        //         $('#btn_import').removeAttr('disabled');
        //         alert("Terjadi kesalahan saat mengimpor data.");
        //     });
        // });

        $('#import_geojson').on('submit', function(e) {
            e.preventDefault();

            let fileInput = $('input[name="import_geojson"]')[0];
            if (fileInput.files.length === 0) {
                alert("Pilih file GeoJSON terlebih dahulu!");
                return;
            }

            let fileName = fileInput.files[0].name;
            if (!fileName.endsWith('.geojson')) {
                alert("Format file harus .geojson!");
                return;
            }

            $('#import_process').show();
            $('#btn_import').attr('disabled', 'disabled');

            $.ajax({
                url: "/admin/peta/import-data-peta",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .done(res => {
                $('#import_process').hide();
                if (res.status === 'success') {
                    location.reload();
                } else {
                    $('#btn_import').removeAttr('disabled');
                    alert(res.message);
                }
            })
            .fail(err => {
                $('#import_process').hide();
                $('#btn_import').removeAttr('disabled');
                alert("Terjadi kesalahan saat mengimpor data.");
            });
        });

    });

    function hapus_data(id_collection) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Apakah anda yakin akan menghapus data ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Hapus sekarang!',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                console.log('User mengonfirmasi penghapusan'); // Debugging
                $.ajax({
                    type: 'POST', // Laravel tidak bisa menerima DELETE dengan data, ubah ke POST
                    url: '{{ url('admin/peta/hapus_data_peta') }}/' + id_collection,
                    data: {
                        _method: 'DELETE', // Kirimkan method DELETE secara eksplisit
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('AJAX sukses:', response); // Debugging
                        Swal.fire(
                            'Terhapus!',
                            'Data yang dipilih telah dihapus!',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload halaman setelah sukses
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error:', xhr.responseText); // Debugging
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function tombol_modal_foto(id_collection) {
        tampil_foto(id_collection);
        $('#id_collection').val(id_collection);
        $('#modal-foto').modal('show');
    }

    function tampil_foto(id_collection) {
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/peta/get_foto') }}',
            data: {
                id_collection: id_collection
            },
            dataType: 'JSON',
            success: function(data) {
                $('.class_foto').remove(); // Hapus semua elemen dengan class "class_foto"

                let html = "";
                data.forEach(foto => {
                    let fileUrl =
                        `{{ asset('assets/uploads/foto_collection') }}/${foto.id_collection}/${encodeURIComponent(foto.file)}`;

                    html += `
                        <div class="col-md-4 animated fadeIn class_foto">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="${fileUrl}" alt="" style="height: 200px;">
                                <div class="options-overlay bg-black-op-75">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-rounded btn-alt-primary min-width-75 img-link img-link-zoom-in img-lightbox" 
                                        onclick="hide_modal_foto()" href="${fileUrl}">
                                            <i class="fa fa-search"></i> Show
                                        </a>
                                        <a class="btn btn-sm btn-rounded btn-alt-danger min-width-75" 
                                        href="javascript:;" onclick="show_modal_hapus(${foto.id}, ${foto.id_collection})">
                                            <i class="fa fa-times"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });

                $('#form_tempat_foto').prepend(html);
            }
        });
    }
</script>
