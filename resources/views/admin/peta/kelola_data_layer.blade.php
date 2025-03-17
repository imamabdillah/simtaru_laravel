@extends('layouts.wrapper')

<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>

@section('contents')
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        @if($atribut->isNotEmpty()) {{-- Pastikan atribut ada --}}
        
            <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah-data" >
                <i class="fa fa-plus mr-5"></i> Tambah Data <span>{{ $layer->nama_layer }}</span>
            </button>
            <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-import-data" data-toggle="modal" data-target="#modal-import">
                <i class="fa fa-upload mr-5"></i> Import Data <span>{{ $layer->nama_layer }}</span>
            </button>

        <button id="btn_import_template" type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-export-data" data-toggle="modal" data-target="#modal-template">
            <i class="fa fa-file mr-5"></i> Template Geojson <span>{{ $layer->nama_layer }}</span>
        </button>

        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-database"></i> Daftar Data "<b id="judul-sub-layer">{{ $layer->nama_layer }}</b>"</h3>
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
                            @if($atribut->isNotEmpty())
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
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                @foreach ($atribut as $row)
                                    @php
                                        $nilai = $values->where('id_atribut', $row->id_atribut)->first();
                                    @endphp
                                    <td style="text-align: center;">{{ $nilai->data_value ?? '-' }}</td>
                                @endforeach
                                <td style="text-align: center;" >
                                    {{-- <a href="{{ route('admin.peta.edit_data_layer', $id_collection) }}" class="btn btn-warning btn-sm btn-edit-data" data-id-collection="{{ $id_collection }}" data-id-layer="{{ $layer->id_layer }}">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                    <a href="{{ route('admin.peta.edit_data_layer', $id_collection) }}" class="btn btn-warning btn-sm btn-edit-data" data-id-collection="{{ $id_collection }}" data-id-layer="{{ $layer->id_layer }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
                <button type="button" class="btn btn-square btn-danger tambah-atribut" onclick="window.location.href='{{ url('admin/peta/edit_layer/'.$layer->id_layer) }}'">
                    <i class="fa fa-plus"></i> Buat atribut
                </button>
            </div>
        @endif
    </div>
</main>

@foreach ($atribut as $item)
    <!-- END Main Container -->
    <!-- Pop In Modal -->
    <div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
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
                                        <select required class="tipe form-control" id="tipe" name="tipe_layer" style="width: 100%;">
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
    <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-import" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <form id="import_geojson" enctype='multipart/form-data'>
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Import data {{ $item->nama_layer }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <label for="import_geojson">Import Geojson</label>
                                <input type="file" name="import_geojson" class="form-control">
                                <input type="hidden" name="id_layer" value="{{ $layer->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span id="import_process" style="width:100%">
                        {{-- <svg  style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg> --}}
                        <span style="font-size: smaller; font-weight: normal;">Sedang memproses import data...</span>
                        </span>
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
    <div class="modal fade" id="modal-template" tabindex="-1" role="dialog" aria-labelledby="modal-template" aria-hidden="true">
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
    <div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="modal-template" aria-hidden="true">
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
                            <div id="template_geojson" class="form-group row" style="padding:20px">
                                <input type="hidden" name="id_collection" id="id_collection">
                                <div class="row items-push js-gallery img-fluid-100" id="form_tempat_foto">

                                    <!-- Lokasi Foto Disini -->

                                    <div class="form-group row ml-20" data-toggle="appear" data-offset="-200">
                                        <div class="dropzone" id="jaringan_jalan_block" action="{{ url('api/psu/upload_foto/do_upload') }}" method="post" style="min-width: 230px; height: 200px; "></div>
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


<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-tambah-data', function () {

            $('#modal-popin').modal('show');
        });

        $(document).on('click', '.btn-import-data', function () {
            $('#modal-import').modal('show');
        });

        $(document).on('click', '.btn-export-data', function () {
            $('#modal-template').modal('show');
        });

        // $(document).on('click', '.edit-atribut', function () {
        //     var url = $(this).data('url');
        //     window.location.href = url;
        // });

        $(document).on('click', '.btn-edit-data', function (e) {
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
                        window.location.href = '{{ url('admin/peta/edit_data_peta') }}/' + id_layer + '/' + tipe_layer + '/' + id_collection;
                    } else {
                        alert('Tipe layer tidak ditemukan.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil tipe layer.');
                }
            });
        });




    });
</script>