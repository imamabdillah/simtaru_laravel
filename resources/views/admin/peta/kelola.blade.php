@extends('layouts.wrapper')
@section('contents')
<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Manajemen Layer "<b class="header_layer"></b>"</h3>
                <div class="block-options">
                    <a class="btn btn-sm btn-danger" href="{{ url('admin/peta') }}">
                        <i class="fa fa-angle-left"></i> Kembali
                    </a>
                    <button type="button" class="btn btn-sm btn-alt-primary btn_ubah">
                        <i class="fa fa-edit"></i> Ubah Layer
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form id="form_layer" method="post" action="{{ route('admin.peta.update_layer', request()->segment(4)) }}">
                    @csrf
                    <input type="hidden" name="id_layer" value="{{ request()->segment(4) }}">
                    
                    <div class="form-group row">
                        <label class="col-12" for="nama_layer">Nama Layer</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_layer" name="nama_layer" placeholder="Masukkan nama layer" value="{{ old('nama_layer', $layer->nama_layer ?? '') }}">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-12" for="grup_layer">Grup Layer</label>
                        <div class="col-md-12">
                            <select required class="form-control" id="grup_layer" name="grup_layer" style="width: 100%;">
                                <option value="" disabled {{ old('grup_layer', $layer->id_grup_layer ?? '') == '' ? 'selected' : '' }}>Pilih Grup Layer</option>
                                @foreach ($daftar_grup_layer as $grup_layer)
                                    <option value="{{ $grup_layer->id_grup_layer }}" 
                                        {{ old('grup_layer', $layer->id_grup_layer ?? '') == $grup_layer->id_grup_layer ? 'selected' : '' }}>
                                        {{ $grup_layer->nama_grup_layer }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-12" for="jenis_peta">Jenis Peta</label>
                        <div class="col-md-12">
                            <select required class="form-control" id="jenis_peta" name="jenis_peta" style="width: 100%;">
                                <option value="" disabled {{ old('jenis_peta', $layer->id_jenis_peta ?? '') == '' ? 'selected' : '' }}>Pilih Jenis Peta</option>
                                @foreach ($daftar_jenis_peta as $jenis_peta)
                                    <option value="{{ $jenis_peta->id_jenis_peta }}" 
                                        {{ old('jenis_peta', $layer->id_jenis_peta ?? '') == $jenis_peta->id_jenis_peta ? 'selected' : '' }}>
                                        {{ $jenis_peta->nama_jenis_peta }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-12" for="nama_opd">Nama OPD</label>
                        <div class="col-md-12">
                            <select required class="form-control" id="nama_opd" name="nama_opd" style="width: 100%;">
                                <option value="" disabled {{ old('nama_opd', $layer->id_opd ?? '') == '' ? 'selected' : '' }}>Pilih OPD</option>
                                @foreach ($daftar_opd as $opd)
                                    <option value="{{ $opd->id_opd }}" 
                                        {{ old('nama_opd', $layer->id_opd ?? '') == $opd->id_opd ? 'selected' : '' }}>
                                        {{ $opd->nama_opd }}
                                    </option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-12" for="status">Status Layer</label>
                        <div class="col-md-12">
                            <select required class="form-control" id="status" name="status" style="width: 100%;">
                                <option value="{{ old('status', $layer->status ?? '') }}" selected>
                                    @if($layer->status == 1)
                                        Tampilkan
                                    @elseif($layer->status == 2)
                                        Sembunyikan
                                    @else
                                        Pilih Status
                                    @endif
                                </option>
                                <option value=1>Tampilkan</option>
                                <option value=2>Sembunyikan</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-12" for="sumber">Sumber Data</label>
                        <div class="col-md-12">
                            <input disabled type="text" class="form-control" id="sumber" name="sumber" 
                                value="{{ $layer->sumber == 1 ? 'Database' : ($layer->sumber == 2 ? 'API' : '') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row" id="link_api_container" style="display: {{ $layer->sumber == 2 ? 'block' : 'none' }};">
                        <label class="col-12" for="link_api">Link API</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="link_api" name="link_api" 
                                value="{{ old('link_api', $layer->link_api ?? '') }}">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-12" for="deskripsi_layer">Deskripsi Layer</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="deskripsi_layer" id="deskripsi_layer" cols="30" rows="5">{{ old('deskripsi_layer', $layer->deskripsi_layer ?? '') }}</textarea>
                        </div>
                    </div>
                
                    <div class="form-group row panel-button">
                        <div class="col-12">
                            <button type="button" class="btn btn-alt-default float-right btn_batal">
                                <i class="fa fa-close mr-5"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-alt-info float-right btn_simpan" style="margin-right:10px;">
                                <i class="fa fa-check mr-5"></i> Simpan Layer
                            </button>
                        </div>
                    </div>
                </form>
                
                
            </div>
        </div>
        <!-- panel 2 start -->
        <div class="block block-themed block-rounded">
            <div class="block-header bg-gd-lake">
                <h3 class="block-title"><i class="fa fa-plus"></i> Tambah Atribut Data</h3>
            </div>
            <div class="block-content">
                <form id="form_atribut" action="{{ url('admin/peta/atribut/tambah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="atribut_id_layer" value="{{ request()->segment(4) }}">
                    <div class="row atribut_form">
                        <div class="col-7">
                            <div class="form-group">
                                <label for="atribut_nama_atribut">Nama Atribut</label>
                                <input type="text" class="form-control atribut_nama_atribut" name="atribut_nama_atribut[]" placeholder="Masukkan nama atribut">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="atribut_tipe_atribut">Tipe Atribut</label>
                                <select required class="form-control tipe_atribut" name="atribut_tipe_atribut[]" style="width: 100%;">
                                    <option value=""></option>
                                    <option value="1">Text</option>
                                    <option value="2">Angka</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-success" id="btn_tambah_atribut">
                                    <i class="fa fa-plus"></i> Tambah Atribut
                                </button>
                            </div>
                        </div>
                    </div>                    
                    <br>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-alt-info float-right">
                                <i class="fa fa-check mr-5"></i> Simpan Atribut Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- panel 2 end -->
        <!-- panel 3 start -->
        <div class="block block-themed block-rounded">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title"><i class="fa fa-table"></i> Daftar Atribut Data</h3>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Atribut</th>
                            <th>Tipe Data</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($atributs as $index => $atribut)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $atribut->nama_atribut }}</td>
                            <td>{{ $atribut->tipe_data }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button data-id="{{ $atribut->id_atribut }}" class="btn btn-warning btn_edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    {{-- <button data-id="{{ $atribut->id_atribut }}" class="btn btn-danger btn_hapus">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                    <form action="{{ route('admin.peta.hapus_atribut_layer', $atribut->id_atribut) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus {{ $atribut->nama_atribut }}?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
        <!-- panel 3 end -->
    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Ubah Atribut</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- content -->
                    @csrf
                    <input type="hidden" name="ubah_id_atribut">
                    <div class="form-group row">
                        <label class="col-12" for="ubah_atribut_nama">Nama Atribut</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="ubah_atribut_nama" name="ubah_atribut_nama" placeholder="Masukkan nama atribut">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-12" for="ubah_tipe_atribut">Tipe Atribut</label>
                        <div class="col-md-12">
                            <select required class="form-control tipe_atribut" name="ubah_tipe_atribut" style="width: 100%;">
                                <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">Text</option>
                                <option value="2">Angka</option>
                            </select>
                        </div>
                    </div>
                    <!-- end content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-atribut">
                    <i class="fa fa-check"></i> Ubah Atribut
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->



@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let sumberInput = document.getElementById("sumber");
        let linkApiContainer = document.getElementById("link_api_container");

        // Jika sumber berubah, cek apakah nilainya "API" (2)
        if (sumberInput) {
            let sumberValue = sumberInput.value.trim();
            if (sumberValue === "API") {
                linkApiContainer.style.display = "block";
            } else {
                linkApiContainer.style.display = "none";
            }
        }


    });
    

    function add_row() { 
        let rowno = $(".atribut_form").length + 1;
        let newRow = `
        <div class="row atribut_form" id="row_${rowno}">
            <div class="col-7">
                <div class="form-group">
                    <input type="text" class="form-control" name="atribut_nama_atribut[]" placeholder="Masukkan nama atribut">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select required class="form-control tipe_atribut" name="atribut_tipe_atribut[]" style="width: 100%;">
                        <option value=""></option>
                        <option value="1">Text</option>
                        <option value="2">Angka</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-danger mr-5 mb-5 delete-row" data-row="row_${rowno}">
                        <i class="fa fa-trash"></i> Hapus Atribut
                    </button>
                </div>
            </div>
        </div>`;

        $(".atribut_form:last").after(newRow);
    }

    function delete_row(rowno) {
        $("#" + rowno).remove();
    }

    $(document).ready(function () {
        // Event listener tombol tambah atribut
        $(document).on("click", "#btn_tambah_atribut", function () {
            add_row();
            console.log("Button diklik!");
            $(".atribut_form:last").after(html);
        });

        // Event listener tombol hapus atribut
        $(document).on("click", ".delete-row", function () {
            let rowId = $(this).data("row");
            delete_row(rowId);
        });
    });


</script>

{{-- edit dan hapus atribut --}}
<script>

    // hapus atribut
    $(document).ready(function () {
        // Event listener tombol tambah atribut
        $(document).on("click", "#btn_tambah_atribut", function () {
            add_row();
            console.log("Button tambah atribut diklik!");
        });

        // Event listener tombol hapus atribut (dari form tambah)
        $(document).on("click", ".delete-row", function () {
            let rowId = $(this).data("row");
            delete_row(rowId);
        });

        // Event listener tombol hapus atribut (dari database)
        $(document).on("click", ".btn_hapus", function () {
            let atributId = $(this).data("id");
            let row = $(this).closest("tr");

            if (confirm("Apakah Anda yakin ingin menghapus atribut ini?")) {
                $.ajax({
                    url: `/admin/peta/atribut/delete/${atributId}`,
                    type: "POST", // Laravel butuh POST untuk menghapus dengan _method=DELETE
                    data: {
                        _method: "DELETE", // Simulasikan DELETE
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            row.remove();
                        } else {
                            alert("Gagal menghapus atribut.");
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan saat menghapus atribut.");
                    }
                });
            }
        });
    });




</script>




@endsection