@extends('layouts.wrapper')
<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }

	/* .css-control-input {
		opacity: 1 !important;
		position: static !important;
		display: inline-block !important;
	} */
</style>
<!-- Main Container -->
@section('contents')
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <button id="btn_tambah_layer" type="button" class="btn btn-primary mr-5 mb-5" data-toggle="modal" data-target="#modal_tambah_layer">
            <i class="fa fa-plus mr-5"></i> Tambah Layer Peta
        </button>
        <button id="btn_tambah_grup_layer" type="button" class="btn btn-primary mr-5 mb-5 btn-tambah" data-toggle="modal" data-target="#modal_grup_layer">
            <i class="fa fa-plus mr-5"></i>Tambah Grup Layer
        </button>
        <button id="btn_tambah_jenis_peta" type="button" class="btn btn-primary mr-5 mb-5 btn-tambah" data-toggle="modal" data-target="#modal_jenis_peta">
            <i class="fa fa-plus mr-5"></i>Tambah Jenis Peta
        </button>
        <button type="button" class="btn btn-secondary mr-5 mb-5 btn-filter-layer">
            <i class="fa fa-sliders mr-5"></i> Filter Layer Peta
        </button>
        <!-- Div filter -->
        <div class="block block-themed div-filter" style="margin-top: 8px;">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-sliders"></i> Filter</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option block-cancel">
                        <i class="si si-close"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form id="form-filter">
                    <!-- content -->
                    <div class="form-group row">
                        <div class="col-2" style="padding-right:0px">
                            <label for="filter_nama">Nama Layer</label>
                            <input type="text" class="filter_nama form-control" id="filter_nama" name="filter_nama" style="width: 100%;" placeholder="Masukkan nama layer">
                        </div>
                        <div class="col-2" style="padding-right:0px">
                            <label for="filter_opd">Nama Bidang</label>
                            <select class="filter_opd form-control" id="filter_opd" name="filter_opd" style="width: 100%;">
                                <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <?php
                                foreach ($daftar_opd as $opd) {
                                    echo "<option value=" . $opd->id_opd . ">" . $opd->nama_opd . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-2" style="padding-right:0px">
                            <label for="filter_sumber">Sumber</label>
                            <select class="filter_sumber form-control" id="filter_sumber" name="filter_sumber" style="width: 100%;">
                                <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">Database</option>
                                <!-- <option value="2">API Web Lain</option>
                            <option value="3">Upload GeoJSON</option> -->
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="filter_status">Status</label>
                            <select class="filter_status form-control" id="filter_status" name="filter_status" style="width: 100%;">
                                <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">Ditampilkan</option>
                                <option value="2">Disembuyikan</option>
                            </select>
                        </div>
                        <div class="col-2" style="padding-right:0px">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-block btn-primary btn-filter"><i class="fa fa-search mr-5"></i> Cari</button>
                        </div>
                        <div class="col-2">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-block btn-warning btn-reset"><i class="fa fa-refresh mr-5"></i> Reset</button>
                        </div>
                    </div>
                    <!-- content -->
                </form>
            </div>
        </div>
        <!-- end filter -->
		<div class="block block-themed" style="margin-top: 16px;">
			<div class="block-header bg-primary-dark">
				<h3 class="block-title"><i class="si si-map mr-2 font-size-sm"></i> Daftar Layer Peta</h3>
			</div>
			<div class="block-content">
				<table class="table table-striped" id="mydata" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Layer</th>
							<th>Nama Bidang</th>
							<th>Sumber</th>
							<th>Status</th>
							<th>Data Perbaikan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($layers as $index => $layer)
						<tr>
							<td>{{ $index + 1 }}</td>
							<td>{{ $layer->nama_layer }}</td>
							<td>{{ $layer->opd->nama_opd ?? 'Tidak Diketahui' }}</td>
							<td>
								@switch($layer->sumber)
									@case(2)
										API
										@break
									@case(3)
										File JSON
										@break
									@default
										Database
								@endswitch
							</td>
							<td>{{ $layer->status == 2 ? 'Sembunyikan' : 'Tampilkan' }}</td>
							<td>
								<label class="css-control css-control-primary css-switch">
									<input type="checkbox" class="css-control-input switch_perbaikan" {{ $layer->is_perbaikan ? 'checked' : '' }} data-id="{{ $layer->id_layer }}">
									<span class="css-control-indicator"></span>
								</label>
							</td>
							<td>
								<div class="btn-group btn-group-sm">
									<button data-id="{{ $layer->id_layer }}" class="btn btn-default btn_download" title="Download File GeoJSON {{ $layer->nama_layer }}"><i class="fa fa-download"></i></button>
                                    <a href="{{ route('admin.peta.kelola_data_layer', $layer->id_layer) }}" class="btn btn-primary btn_data" data-id="{{ $layer->id_layer }}" title="Kelola Data Layer {{ $layer->nama_layer }}">
                                        <i class="fa fa-database"></i>
                                    </a>
									<a href="{{ route('admin.peta.edit_layer', $layer->id_layer) }}" class="btn btn-success btn_kelola" title="Kelola Layer {{ $layer->nama_layer }}">
										<i class="fa fa-edit"></i>
									</a>
									<button data-id="{{ $layer->id_layer }}" class="btn btn-warning btn_group" title="Grup Atribut {{ $layer->nama_layer }}"><i class="fa fa-clone"></i></button>
								</div>
								<button data-id="{{ $layer->id_layer }}" class="btn btn-danger btn-sm btn_clear" title="Hapus Semua Data {{ $layer->nama_layer }}"><i class="fa fa-times-rectangle"></i></button>
								<button data-id="{{ $layer->id_layer }}" class="btn btn-danger btn-sm btn_hapus" title="Hapus Layer {{ $layer->nama_layer }}"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </div>
</main>
<!-- END Main Container -->

<!-- Pop In Modal Tambah Layer Peta -->
<div class="modal fade" id="modal_tambah_layer" tabindex="-1" role="dialog" aria-labelledby="modal_tambah_layer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-md" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Layer Peta</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="form_tambah_layer" action="{{ route('admin.peta.simpan_layer') }}" method="POST">
                        @csrf
                        <input type="hidden" id="layer_id" name="layer_id" value=""> <!-- Untuk edit -->

                        <label for="nama_layer">Nama Layer</label>
                        <input type="text" id="nama_layer" name="nama_layer" class="form-control" placeholder="Masukkan nama layer..." required>
                        
                        <label for="grup_layer" class="mt-2">Grup Layer</label>
                        <select id="grup_layer" name="grup_layer" class="form-control" required>
							<option value="" selected disabled>-- Pilih Grup Layer --</option>
                            @foreach ($grup_layers as $item)
                                <option value="{{ $item->id_grup_layer }}">{{ $item->nama_grup_layer }}</option>
                            @endforeach
						</select>

                        <label for="jenis_peta" class="mt-2">Jenis Peta</label>
                        <select id="jenis_peta" name="jenis_peta" class="form-control" required>
							<option value="" selected disabled>-- Pilih Jenis Peta --</option>
                            @foreach ($jenis_peta as $item)
                                <option value="{{ $item->id_jenis_peta }}">{{ $item->nama_jenis_peta }}</option>
                            @endforeach
						</select>
                        
                        <label for="opd" class="mt-2">Nama Bidang</label>
                        <select id="opd" name="opd" class="form-control" required>
                            <option value="" selected disabled>-- Pilih Bidang --</option>
                            @foreach ($daftar_opd as $opd)
                                <option value="{{ $opd->id_opd }}">{{ $opd->nama_opd }}</option>
                            @endforeach
                        </select>
                        
                        <label for="sumber" class="mt-2">Sumber Data</label>
                        <select id="sumber" name="sumber" class="form-control" required>
                            <option value="" disabled>-- Pilih Sumber Data --</option>
                            <option value="1" selected>Database</option>
                            <option value="2">API</option>
                        </select>

                        <div class="mt-2" id="link_api_box" style="display:none;">
                            <label for="link_api">Link API</label>
                            <input type="text" id="link_api" name="link_api" class="form-control" placeholder="Masukkan link API">
                        </div>
                        
                        <label for="deskripsi_layer" class="mt-2">Deskripsi Layer</label>
                        <textarea id="deskripsi_layer" name="deskripsi_layer" class="form-control" rows="3" placeholder="Deskripsi layer..."></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" form="form_tambah_layer" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END Pop In Modal -->

<!-- Modal Tambah Grup Layer -->
<div class="modal fade" id="modal_grup_layer" tabindex="-1" role="dialog" aria-labelledby="modal_grup_layer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-md" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Form Tambah Grup Layer</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
					<form id="form_grup_layer" action="{{ route('admin.peta.simpan_grup_layer') }}" method="POST">
						@csrf
						<input type="hidden" name="_method" value="POST"> <!-- Secara default menggunakan POST -->
						<input type="hidden" id="grup_layer_id" name="grup_layer_id" value=""> <!-- Untuk edit -->
						
						<label for="nama_grup_layer">Nama Grup Layer</label>
						<div class="input-group">
							<input type="text" id="nama_grup_layer" name="nama_grup_layer" class="form-control" placeholder="Masukkan nama grup layer...">
							<div class="input-group-append">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-plus"></i> Simpan Grup Layer
								</button>
							</div>
						</div>
					</form>
                    <h5 class="mt-30">List Grup Layer</h5>
                    <div id="list_grup_layer" class="mb-20">
                        @foreach ($grup_layers as $grup)
                        <div class="row">
                            <div class="item_grup_layer col-8" data-id="{{ $grup->id_grup_layer }}">
                                {{ $grup->nama_grup_layer }}
                            </div>
                            <div class="col-4" style="text-align:right">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-sm btn-warning mr-5 btn-edit-grup-layer"
                                    data-id="{{ $grup->id_grup_layer }}" 
                                    data-nama="{{ $grup->nama_grup_layer }}">
                                    <i class="fa fa-edit" title="Edit {{ $grup->nama_grup_layer }}"></i>
                                </button>  
                        
                                <!-- Tombol Simpan (hidden by default) -->
                                <button type="button" class="btn btn-sm btn-success btn-save-grup-layer" style="display: none;">
                                    <i class="fa fa-check"></i>
                                </button>
                        
                                <!-- Form Hapus -->
                                <form action="{{ route('admin.peta.hapus_grup_layer', $grup->id_grup_layer) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus {{ $grup->nama_grup_layer }}?')">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- END Grup layer Modal -->

<div class="modal fade" id="modal_jenis_peta" tabindex="-1" role="dialog" aria-labelledby="modal_jenis_peta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-md" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Form Tambah Jenis Peta</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{ route('admin.peta.simpan_jenis_peta') }}" method="POST">
                        @csrf
                        <label for="nama_jenis_peta">Nama Jenis Peta</label>
                        <div class="input-group">
                            <input type="text" id="nama_jenis_peta" name="nama_jenis_peta" class="form-control" placeholder="Masukkan nama jenis peta...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah Jenis Peta
                                </button>
                            </div>
                        </div>
                    </form>
                    <h5 class="mt-30">List Jenis Peta</h5>
                    <div id="list_jenis_peta" class="mb-20">
                        @foreach ($jenis_peta as $jenis)
                        <div class="row">
                            <div class="item_jenis_peta col-8" data-id="{{ $jenis->id_jenis_peta }}">{{ $jenis->nama_jenis_peta }}</div>
                            <div class="col-4" style="text-align:right">
								<button type="button" class="btn btn-sm btn-warning mr-5 btn-edit-jenis-peta" 
									data-id="{{ $jenis->id_jenis_peta }}" 
									data-nama="{{ $jenis->nama_jenis_peta }}">
									<i class="fa fa-edit" title="Edit {{ $jenis->nama_jenis_peta }}"></i>
								</button>		
                                <!-- Tombol Simpan (hidden by default) -->
                                <button type="button" class="btn btn-sm btn-success btn-save-jenis-peta" style="display: none;">
                                    <i class="fa fa-check"></i>
                                </button>					
                                <form action="{{ route('admin.peta.hapus_jenis_peta', $jenis->id_jenis_peta) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus {{ $jenis->nama_jenis_peta }}?')">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>







@endsection




<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>

    // script section filter
    $(document).ready(function () {
        // Sembunyikan filter saat halaman pertama dimuat
        $(".div-filter").hide();

        // Tampilkan atau sembunyikan filter saat tombol filter ditekan
        $(".btn-filter-layer").click(function () {
            $(".div-filter").slideToggle(); // Efek animasi slide
        });

        // Sembunyikan filter jika tombol close ditekan
        $(".block-cancel").click(function () {
            $(".div-filter").slideUp(); // Animasi slide ke atas
        });
    });


    // script edit jenis peta baru
    $(document).ready(function(){
        // event tombol edit diklik
        $(document).on('click', '.btn-edit-jenis-peta', function () {
            let id = $(this).data('id');
            let nama = $(this).data('nama');

            let itemDiv = $(this).closest('.row').find('.item_jenis_peta');
            let editButton = $(this);
            let saveButton = editButton.siblings('.btn-save-jenis-peta');

            let inputField = `<input type="text" class="form-control form-control-sm input-edit-jenis-peta" value="${nama}" data-id="${id}">`;
            itemDiv.html(inputField);

            editButton.hide();
            saveButton.show();
        });

        // event tombol save diklik
        $(document).on('click', '.btn-save-jenis-peta', function(){
            let saveButton = $(this);
            let editButton = saveButton.siblings('.btn-edit-jenis-peta');
            let itemDiv = saveButton.closest('.row').find('.item_jenis_peta');
            let inputField = itemDiv.find('.input-edit-jenis-peta');
            let id = inputField.data('id');
            let namaBaru = inputField.val();

            $.ajax({
                url: '/admin/peta/update-jenis-peta/' + id,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'PUT',
                    nama_jenis_peta: namaBaru
                },
                success: function (response) {
                    itemDiv.html(namaBaru);

                    saveButton.hide();
                    editButton.show();
                },
                error: function (xhr) {
                    alert('Terjadi kesalahan saat memperbartui jenis peta');
                    console.log(xhr.responseText);
                }
            });
        });
    });

    // script grup layer baru 
    $(document).ready(function () {
        // Event klik tombol edit
        $(document).on("click", ".btn-edit-grup-layer", function () {
            let id = $(this).data("id");
            let nama = $(this).data("nama");

            // Ambil elemen yang sesuai
            let itemDiv = $(this).closest(".row").find(".item_grup_layer");
            let editButton = $(this);
            let saveButton = editButton.siblings(".btn-save-grup-layer");

            // Ubah div menjadi input field
            let inputField = `<input type="text" class="form-control form-control-sm input-edit-grup" value="${nama}" data-id="${id}">`;
            itemDiv.html(inputField);

            // Sembunyikan tombol edit, tampilkan tombol simpan
            editButton.hide();
            saveButton.show();
        });

        // Event klik tombol simpan
        $(document).on("click", ".btn-save-grup-layer", function () {
            let saveButton = $(this);
            let editButton = saveButton.siblings(".btn-edit-grup-layer");
            let itemDiv = saveButton.closest(".row").find(".item_grup_layer");
            let inputField = itemDiv.find(".input-edit-grup");
            let id = inputField.data("id");
            let namaBaru = inputField.val();

            // Kirim data dengan AJAX ke backend
            $.ajax({
                url: "/admin/peta/update_grup_layer/" + id,
                type: "POST", // Laravel butuh POST untuk menerima _method PUT
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "PUT", // Laravel membaca ini sebagai PUT request
                    nama_grup_layer: namaBaru
                },
                success: function (response) {
                    // Ubah kembali input menjadi teks biasa
                    itemDiv.html(namaBaru);

                    // Sembunyikan tombol simpan, tampilkan tombol edit kembali
                    saveButton.hide();
                    editButton.show();
                },
                error: function (xhr) {
                    alert("Terjadi kesalahan saat memperbarui grup layer.");
                    console.log(xhr.responseText); // Untuk debug, lihat error di console
                }
            });
        });
    });


	// script link api
	document.addEventListener("DOMContentLoaded", function() {
		// Ambil elemen yang diperlukan
		let sumberSelect = document.getElementById("sumber");
		let linkApiBox = document.getElementById("link_api_box");

		// Fungsi untuk menampilkan atau menyembunyikan input Link API
		function toggleLinkApi() {
			if (sumberSelect.value == "2") {
				linkApiBox.style.display = "block"; // Tampilkan jika sumber = API
			} else {
				linkApiBox.style.display = "none"; // Sembunyikan jika sumber = Database
			}
		}

		// Jalankan saat halaman dimuat untuk menangani kondisi default
		toggleLinkApi();

		// Tambahkan event listener untuk menangani perubahan dropdown
		sumberSelect.addEventListener("change", toggleLinkApi);
	});

	$(document).on('change', '.switch_perbaikan', function () {
		let layerId = $(this).data('id');
		let status = $(this).is(':checked') ? 1 : 0; // Ambil status checkbox

		$.ajax({
			url: "{{ route('layer.updatePerbaikan') }}",
			type: "POST",
			data: {
				id: layerId,
				status: status,
				_token: "{{ csrf_token() }}"
			},
			success: function (response) {
				if (response.success) {
					console.log(response.message);
				} else {
					alert(response.message);
				}
			},
			error: function () {
				alert('Terjadi kesalahan saat mengupdate status.');
			}
		});
	});


    $(document).on('click', '.btn_hapus', function() {
        let layerId = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus layer ini?')) {
            $.ajax({
                url: '/admin/peta/hapus_layer/' + layerId,
                type: 'DELETE',
                data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Refresh halaman setelah berhasil menghapus
                    } else {
                        alert('Gagal menghapus layer');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan. Coba lagi!');
                }
            });
        }
    });

    // script kelola data layer peta
    $(document).on("click", ".btn_data", function () {
        var id = $(this).data("id");
        window.location.href = "/admin/peta/data_peta/" + id;
    });



</script>


