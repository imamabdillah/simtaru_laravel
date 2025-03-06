@extends('layouts.wrapper')
<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
<!-- Main Container -->
@section('contents')
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <button id="btn_tambah_layer" type="button" class="btn btn-primary mr-5 mb-5" data-toggle="modal" data-target="#modal-popin">
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
                            <label for="rfilter_status">Status</label>
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
							<td>{{ $layer->id_opd }}</td>
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
								<input type="checkbox" class="switch_perbaikan" {{ $layer->is_perbaikan ? 'checked' : '' }} data-id="{{ $layer->id_layer }}">
							</td>
							<td>
								<div class="btn-group btn-group-sm">
									<button data-id="{{ $layer->id_layer }}" class="btn btn-default btn_download"><i class="fa fa-download"></i></button>
									<button data-id="{{ $layer->id_layer }}" class="btn btn-primary btn_data"><i class="fa fa-database"></i></button>
									<button data-id="{{ $layer->id_layer }}" class="btn btn-success btn_kelola"><i class="fa fa-edit"></i></button>
									<button data-id="{{ $layer->id_layer }}" class="btn btn-warning btn_group"><i class="fa fa-clone"></i></button>
								</div>
								<button data-id="{{ $layer->id_layer }}" class="btn btn-danger btn-sm btn_clear"><i class="fa fa-times-rectangle"></i></button>
								<button data-id="{{ $layer->id_layer }}" class="btn btn-danger btn-sm btn_hapus"><i class="fa fa-trash"></i></button>
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

<!-- Pop In Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <form id="tambah_layer">
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none">
                        <div class="form-group row">
                            <label class="col-12" for="nama_layer">Nama Layer</label>
                            <div class="col-md-12">
                                <input required type="text" class="form-control" id="nama_layer" name="nama_layer" placeholder="Masukkan nama layer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="opd">Grup Layer</label>
                            <div class="col-md-12">
                                <select required class="form-control" id="grup_layer" name="grup_layer" style="width: 100%;"></select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="opd">Jenis Peta</label>
                            <div class="col-md-12">
                                <select required class="form-control" id="jenis_peta" name="jenis_peta" style="width: 100%;"></select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="opd">Nama Bidang</label>
                            <div class="col-md-12">
                                <select required class="opd form-control" id="opd" name="opd" style="width: 100%;">
                                    <option value="" selected disabled>-- Pilih Bidang --</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <?php
                                    foreach ($daftar_opd as $opd) {
                                        echo "<option value=" . $opd->id_opd . ">" . $opd->nama_opd . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="sumber">Sumber Data</label>
                            <div class="col-md-12">
                                <select class="sumber form-control" name="sumber" id="sumber" style="width: 100%;">
                                    <option value="" disabled>-- Pilih Sumber Data --</option>
                                    <option value="1" selected>Database</option>
                                    <option value="2">API</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="link_api_box" style="display:none;">
                            <label class="col-12" for="link_api">Link API</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="link_api" name="link_api" placeholder="Masukkan link API">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12" for="opd">Deskripsi Layer</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="deskripsi_layer" id="deskripsi_layer" cols="30" rows="5"></textarea>

                            </div>
                        </div>
                        <!-- <div class="form-group row pengembangan">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                <strong><i class="fa fa-exclamation"></i></strong> Fitur ini masih dalam pengembangan.
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-alt-success btn-simpan">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->

<!-- Pop In Modal Tambah Grup Layer -->
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
                    <div>
                        <label for="nama_grup_layer">Nama Grup Layer</label>
                        <div class="input-group">
                            <input type="text" name="nama_grup_layer" class="form-control" placeholder="Masukkan nama grup layer...">
                            <div class="input-group-append">
                                <button id="btn_simpan_grup_layer" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah Grup
                                </button>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-30">List Grup Layer</h5>
                    <div id="list_grup_layer" class="mb-20">
                        <svg id="list_grup_loader" style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring">
                            <circle cx="50" cy="50" ng-attr-r="" ng-attr-stroke="" ng-attr-stroke-width="" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle>
                            <circle cx="50" cy="50" ng-attr-r="" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-stroke-linecap="" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)">
                                <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform>
                                <animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate>
                            </circle>
                        </svg>
                        <span>Sedang mengambil data grup layer...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <!-- <button id="simpan_grup_layer" type="button" class="btn btn-alt-success">Simpan</button> -->
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->

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
                            <input type="text" name="nama_jenis_peta" class="form-control" placeholder="Masukkan nama jenis peta...">
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
                                <a href="{{ route('admin.peta.edit_jenis_peta', $jenis->id_jenis_peta) }}" class="btn btn-sm btn-warning mr-5"><i class="fa fa-edit" title="Edit {{ $jenis->nama_jenis_peta }}"></i></a>
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


@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
	var table;
	var csrfToken = '{{ csrf_token() }}';
	$(document).ready(function() {
		defaultForm();
		table = $('#mydata').DataTable({
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"searching": false,
			"order": [],

			"ajax": {
				"url": "{{ route('admin.peta.daftar_layer_peta') }}",
				"type": "POST",
				"data": function(data) {
					data._token = csrfToken;
					data.filter_nama = $('#filter_nama').val();
					data.filter_opd = $('#filter_opd').val();
					data.filter_sumber = $('#filter_sumber').val();
					data.filter_status = $('#filter_status').val();
				}
			},
			"language": {
				processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
			},

			"columnDefs": [
				{
					"targets": [0],
					"orderable": false,
					"width": "10px"
				},
				{
					"targets": [6],
					"width": "200px",
					"className": "text-right"
				},
				{
					"targets": [5], 
					"orderable": false,
					"className": "text-center"
				},
			],

		});

		// Layer
		$('#btn_tambah_layer').click(function() {
			$.ajax({
					url: '{{ route('admin.peta.get_grup_layer') }}',
					type: 'GET',
					dataType: 'JSON'
				})
				.then(v => {
					console.log(v.data);
					html = '<option value="" selected disabled>-- Pilih Grup Layer --</option>';
					v.data.map(x => {
						html += '<option value="' + x.id_grup_layer + '">' + x.nama_grup_layer + '</option>';
					})
					$('#grup_layer').html(html);
				})

			$.ajax({
					url: '{{ route('admin.peta.get_jenis_peta') }}',
					type: 'GET',
					dataType: 'JSON'
				})
				.then(v => {
					console.log(v.data);
					html = '<option value="" selected disabled>-- Pilih Jenis Peta --</option>';
					v.data.map(x => {
						html += '<option value="' + x.id_jenis_peta + '">' + x.nama_jenis_peta + '</option>';
					})
					$('#jenis_peta').html(html);
				})
		})

		// Grup Layer
		$('#btn_simpan_grup_layer').attr('disabled', 'disabled');

		$('input[name="nama_grup_layer"]').keyup(function() {
			$(this).val().length > 0 ? $('#btn_simpan_grup_layer').removeAttr('disabled') : $('#btn_simpan_grup_layer').attr('disabled', 'disabled');
		})

		$('#btn_tambah_grup_layer').click(function() {
			$('#modal_grup_layer').modal('show');
			tampil_grup_layer();
		})

		$('#btn_simpan_grup_layer').click(function() {
			data = [];
			let fd = new FormData;
			fd.append('nama_grup_layer', $('input[name="nama_grup_layer"]').val());
			fd.append('_token', csrfToken);
			$.ajax({
					url: '{{ route('admin.peta.simpan_grup_layer') }}',
					type: 'POST',
					data: fd,
					dataType: 'JSON',
					processData: false,
					contentType: false
				})
				.done((res) => {
					let html = 'Data belum tersedia.';
					if (typeof res.data != 'undefined') {
						if (res.data.length > 0) {
							html = '';
							res.data.map((v, i, a) => {
								data[v.id_grup_layer] = v.nama_grup_layer;
								html += '<div class="row">';
								html += '<div class="item_grup_layer col-8" data-id="' + v.id_grup_layer + '">' + v.nama_grup_layer + '</div>';
								html += '<div class="col-4" style="text-align:right">';
								html += '<button id="btn_item_grup_simpan_' + v.id_grup_layer + '" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan ' + v.nama_grup_layer + '" onclick="event.preventDefault();simpan_item_grup_layer(' + v.id_grup_layer + ',\'' + v.nama_grup_layer + '\')"></i></button>';
								html += '<button id="btn_item_grup_edit_' + v.id_grup_layer + '" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit ' + v.nama_grup_layer + '" onclick="event.preventDefault();edit_item_grup_layer(' + v.id_grup_layer + ',\'' + v.nama_grup_layer + '\')"></i></button>';
								html += '<button id="btn_item_grup_hapus_' + v.id_grup_layer + '" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus ' + v.nama_grup_layer + '" onclick="event.preventDefault();hapus_item_grup_layer(' + v.id_grup_layer + ')"><i class="fa fa-remove" ></i></button>';
								html += '</div></div><hr>';
							})
						}
					}
					$('input[name="nama_grup_layer"]').val('')
					$('#btn_simpan_grup_layer').attr('disabled', 'disabled');
					$('#list_grup_layer').html(html);
					$('.btn_item_grup_simpan').hide();
				})
		})

		// End Grup Layer

		// Jenis Peta
		$('#btn_simpan_jenis_peta').attr('disabled', 'disabled');

		$('input[name="nama_jenis_peta"]').keyup(function() {
			$(this).val().length > 0 ? $('#btn_simpan_jenis_peta').removeAttr('disabled') : $('#btn_simpan_jenis_peta').attr('disabled', 'disabled');
		})

		$('#btn_tambah_jenis_peta').click(function() {
			$('#modal_jenis_peta').modal('show');
			tampil_jenis_peta();
		})

		$('#btn_simpan_jenis_peta').click(function() {
			data = [];
			let fd = new FormData;
			fd.append('nama_jenis_peta', $('input[name="nama_jenis_peta"]').val());
			fd.append('_token', csrfToken);
			$.ajax({
					url: '{{ route('admin.peta.simpan_jenis_peta') }}',
					type: 'POST',
					data: fd,
					dataType: 'JSON',
					processData: false,
					contentType: false
				})
				.done((res) => {
					let html = 'Data belum tersedia.';
					if (typeof res.data != 'undefined') {
						if (res.data.length > 0) {
							html = '';
							res.data.map((v, i, a) => {
								data[v.id_jenis_peta] = v.nama_jenis_peta;
								html += '<div class="row">';
								html += '<div class="item_jenis_peta col-8" data-id="' + v.id_jenis_peta + '">' + v.nama_jenis_peta + '</div>';
								html += '<div class="col-4" style="text-align:right">';
								html += '<button id="btn_item_grup_simpan_' + v.id_jenis_peta + '" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan ' + v.nama_jenis_peta + '" onclick="event.preventDefault();simpan_item_jenis_peta(' + v.id_jenis_peta + ',\'' + v.nama_jenis_peta + '\')"></i></button>';
								html += '<button id="btn_item_grup_edit_' + v.id_jenis_peta + '" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit ' + v.nama_jenis_peta + '" onclick="event.preventDefault();edit_item_jenis_peta(' + v.id_jenis_peta + ',\'' + v.nama_jenis_peta + '\')"></i></button>';
								html += '<button id="btn_item_grup_hapus_' + v.id_jenis_peta + '" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus ' + v.nama_jenis_peta + '" onclick="event.preventDefault();hapus_item_jenis_peta(' + v.id_jenis_peta + ')"><i class="fa fa-remove" ></i></button>';
								html += '</div></div><hr>';
							})
						}
					}
					$('input[name="nama_jenis_peta"]').val('')
					$('#btn_simpan_jenis_peta').attr('disabled', 'disabled');
					$('#list_jenis_peta').html(html);
					$('.btn_item_grup_simpan').hide();
				})
		})

		// End Jenis Peta

		$('.btn-filter').click(function() { //button filter event click
			table.ajax.reload(); //just reload table
		});

		$('.btn-reset').click(function() { //button reset event click
			$('#form-filter')[0].reset();
			// init_select2();
			table.ajax.reload(); //just reload table
		});

		$('.btn-filter-layer, .block-cancel').click(function() {
			$(".div-filter").slideToggle("slow");
		});

		$('#sumber').change(function() {
			if ($(this).val() == '2') {
				$('#link_api_box').show();
			} else {
				$('#link_api_box').hide();
			}
		})

	});

	function init_select2() {
		$('#grup_layer').select2({
			theme: "bootstrap",
			dropdownParent: $('#modal-popin'),
			language: "id"
		});
		$('#jenis_peta').select2({
			theme: "bootstrap",
			dropdownParent: $('#modal-popin'),
			language: "id"
		});
		$('.opd').select2({
			theme: "bootstrap",
			dropdownParent: $('#modal-popin'),
			placeholder: "Pilih OPD",
			// allowClear: true,
			language: "id"
		});

		$('.sumber').select2({
			theme: "bootstrap",
			dropdownParent: $('#modal-popin'),
			placeholder: "Pilih sumber data",
			// allowClear: true,
			language: "id",
			// minimumResultsForSearch: -1
		});

		$('.filter_opd').select2({
			theme: "bootstrap",
			placeholder: "Pilih OPD",
			// allowClear: true,
			language: "id"
		});

		$('.filter_sumber').select2({
			theme: "bootstrap",
			// allowClear: true,
			language: "id",
			minimumResultsForSearch: -1
		});

		$('.filter_status').select2({
			theme: "bootstrap",
			placeholder: "Pilih status layer",
			// allowClear: true,
			language: "id",
			minimumResultsForSearch: -1
		});
	}

	function defaultForm() {
		$("#nama_layer").val('');
		// $("#opd").val('');
		// $("#opd").select2("val", "");
		$('#opd').val('').trigger('change');
		// init_select2();
		$(".pengembangan").hide();
		$(".btn-simpan").prop("disabled", false);
		$(".div-filter").hide();
	}

	$('#sumber').on('select2:select', function(e) {
		if (this.value == 1) {
			$(".pengembangan").hide();
			$(".btn-simpan").prop("disabled", false);
		} else {
			$(".pengembangan").show();
			$(".btn-simpan").prop("disabled", true);
		}

	});

	$('#tambah_layer').submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: '{{ route('admin.peta.simpan_layer') }}',
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function(response) {
				defaultForm();
				Swal.fire({
					title: 'Sukses!',
					text: 'Data berhasil disimpan!',
					type: 'success',
					timer: 1500
				});
				$('#modal-popin').modal('hide');
				setTimeout(function() {
					location.reload();
				}, 1000);
			}
		});
		return false;
	});

	$('#mydata').on('click', '.btn_kelola', function() {
		var id = $(this).attr('data');
		window.location.replace('{{ url('admin/peta/kelola/') }}/' + id);
	});

	$('#mydata').on('click', '.btn_data', function() {
		var id = $(this).attr('data');
		window.location.replace('{{ url('admin/peta/data_peta/') }}/' + id);
	});

	$('#mydata').on('click', '.btn_group', function() {
		var id = $(this).attr('data');
		window.location.replace('{{ url('admin/peta/grup_atribut/') }}/' + id);
	});

	function hapus_semua_data(id) {
		$.ajax({
			type: "POST",
			url: "{{ route('admin.peta.hapus_semua_data_layer') }}",
			dataType: "JSON",
			data: {
				id: id,
				_token: csrfToken
			},
			success: function(data) {
				defaultForm();
				table.ajax.reload();
			}
		});
		return false;
	}

	function hapus(id) {
		$.ajax({
			type: "POST",
			url: "{{ route('admin.peta.hapus_layer') }}",
			dataType: "JSON",
			data: {
				id: id,
				_token: csrfToken
			},
			success: function(data) {
				defaultForm();
				table.ajax.reload();
			}
		});
		return false;
	}

	// hapus layer
	$('#mydata').on('click', '.btn_clear', function() {
		var id = $(this).attr('data');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Anda tidak dapat mengembalikan semua data layer yang sudah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus sekarang!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				hapus_semua_data(id);
				Swal.fire(
					'Terhapus!',
					'Layer yang dipilih telah dihapus!',
					'success'
				);
			}
		});

	});

	// hapus semua data layer
	$('#mydata').on('click', '.btn_hapus', function() {
		var id = $(this).attr('data');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Anda tidak dapat mengembalikan layer yang sudah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus sekarang!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				hapus(id);
				Swal.fire(
					'Terhapus!',
					'Layer yang dipilih telah dihapus!',
					'success'
				);
			}
		});

	});

	// Grup Layer

	function tampil_grup_layer() {
		data = [];
		$.ajax({
				url: '{{ route('admin.peta.get_grup_layer') }}',
				type: 'GET',
				dataType: 'JSON'
			})
			.done((res) => {
				let html = 'Data belum tersedia.';
				if (typeof res.data != 'undefined') {
					if (res.data.length > 0) {
						html = '';
						res.data.map((v, i, a) => {
							data[v.id_grup_layer] = v.nama_grup_layer;
							html += '<div class="row">';
							html += '<div class="item_grup_layer col-8" data-id="' + v.id_grup_layer + '">' + v.nama_grup_layer + '</div>';
							html += '<div class="col-4" style="text-align:right">';
							html += '<button id="btn_item_grup_simpan_' + v.id_grup_layer + '" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan ' + v.nama_grup_layer + '" onclick="event.preventDefault();simpan_item_grup_layer(' + v.id_grup_layer + ',\'' + v.nama_grup_layer + '\')"></i></button>';
							html += '<button id="btn_item_grup_edit_' + v.id_grup_layer + '" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit ' + v.nama_grup_layer + '" onclick="event.preventDefault();edit_item_grup_layer(' + v.id_grup_layer + ',\'' + v.nama_grup_layer + '\')"></i></button>';
							html += '<button id="btn_item_grup_hapus_' + v.id_grup_layer + '" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus ' + v.nama_grup_layer + '" onclick="event.preventDefault();hapus_item_grup_layer(' + v.id_grup_layer + ')"><i class="fa fa-remove" ></i></button>';
							html += '</div></div><hr>';
						})
					}
				}
				$('#list_grup_layer').html(html);
				$('.btn_item_grup_simpan').hide();
			})
	}

	function edit_item_grup_layer(id, nama) {
		let h = '<input name="form_item_grup_layer_' + id + '" type="text" class="form-control form_item_grup_layer" data-id="' + id + '" value="' + data[id] + '">';
		$('.item_grup_layer[data-id="' + id + '"]').html(h);
		$('#btn_item_grup_edit_' + id).hide();
		$('#btn_item_grup_simpan_' + id).show();
	}

	function simpan_item_grup_layer(id, nama) {

		let fd = new FormData;
		fd.append('nama_grup_layer', $('input[name="form_item_grup_layer_' + id + '"]').val());
		fd.append('id_grup_layer', id);
		fd.append('_token', csrfToken);
		$.ajax({
				url: '{{ route('admin.peta.edit_grup_layer') }}',
				type: 'POST',
				data: fd,
				dataType: 'JSON',
				processData: false,
				contentType: false
			})
			.done((res) => {
				if (res.status == 'success') {
					data[id] = $('input[name="form_item_grup_layer_' + id + '"]').val();
					let h = data[id];
					$('.item_grup_layer[data-id="' + id + '"]').html(h);
					$('#btn_item_grup_simpan_' + id).hide();
					$('#btn_item_grup_edit_' + id).show();
				}
			})

	}

	function hapus_item_grup_layer(id) {
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {

				$.ajax({
						url: '{{ route('admin.peta.hapus_grup_layer') }}',
						type: 'POST',
						dataType: 'JSON',
						data: {
							id_grup_layer: id,
							_token: csrfToken
						}

					})
					.done((res) => {
						if (res.status == 'success') {
							$('.item_grup_layer[data-id="' + id + '"').parent().next().remove();
							$('.item_grup_layer[data-id="' + id + '"').parent().remove();
							Swal.fire(
								'Terhapus!',
								'Data yang dipilih telah dihapus!',
								'success'
							);
						} else {
							Swal.fire(
								'Gagal!',
								res.message,
								'error'
							);
						}

					})
			}

		});

	}

	// End Grup Layer

	// Jenis Peta

	function tampil_jenis_peta() {
		data = [];
		$.ajax({
				url: '{{ route('admin.peta.get_jenis_peta') }}',
				type: 'GET',
				dataType: 'JSON'
			})
			.done((res) => {
				let html = 'Data belum tersedia.';
				if (typeof res.data != 'undefined') {
					if (res.data.length > 0) {
						html = '';
						res.data.map((v, i, a) => {
							data[v.id_jenis_peta] = v.nama_jenis_peta;
							html += '<div class="row">';
							html += '<div class="item_jenis_peta col-8" data-id="' + v.id_jenis_peta + '">' + v.nama_jenis_peta + '</div>';
							html += '<div class="col-4" style="text-align:right">';
							html += '<button id="btn_item_grup_simpan_' + v.id_jenis_peta + '" class="btn btn-sm btn-success mr-5 btn_item_grup_simpan"><i class="fa fa-save" title="Simpan ' + v.nama_jenis_peta + '" onclick="event.preventDefault();simpan_item_jenis_peta(' + v.id_jenis_peta + ',\'' + v.nama_jenis_peta + '\')"></i></button>';
							html += '<button id="btn_item_grup_edit_' + v.id_jenis_peta + '" class="btn btn-sm btn-warning mr-5 btn_item_grup_edit"><i class="fa fa-edit" title="Edit ' + v.nama_jenis_peta + '" onclick="event.preventDefault();edit_item_jenis_peta(' + v.id_jenis_peta + ',\'' + v.nama_jenis_peta + '\')"></i></button>';
							html += '<button id="btn_item_grup_hapus_' + v.id_jenis_peta + '" class="btn btn-sm btn-danger btn_item_grup_hapus" title="Hapus ' + v.nama_jenis_peta + '" onclick="event.preventDefault();hapus_item_jenis_peta(' + v.id_jenis_peta + ')"><i class="fa fa-remove" ></i></button>';
							html += '</div></div><hr>';
						})
					}
				}
				$('#list_jenis_peta').html(html);
				$('.btn_item_grup_simpan').hide();
			})
	}

	function edit_item_jenis_peta(id, nama) {
		let h = '<input name="form_item_jenis_peta_' + id + '" type="text" class="form-control form_item_jenis_peta" data-id="' + id + '" value="' + data[id] + '">';
		$('.item_jenis_peta[data-id="' + id + '"]').html(h);
		$('#btn_item_grup_edit_' + id).hide();
		$('#btn_item_grup_simpan_' + id).show();
	}

	function simpan_item_jenis_peta(id, nama) {

		let fd = new FormData;
		fd.append('nama_jenis_peta', $('input[name="form_item_jenis_peta_' + id + '"]').val());
		fd.append('id_jenis_peta', id);
		fd.append('_token', csrfToken);
		$.ajax({
				url: '{{ route('admin.peta.edit_jenis_peta') }}',
				type: 'POST',
				data: fd,
				dataType: 'JSON',
				processData: false,
				contentType: false
			})
			.done((res) => {
				if (res.status == 'success') {
					data[id] = $('input[name="form_item_jenis_peta_' + id + '"]').val();
					let h = data[id];
					$('.item_jenis_peta[data-id="' + id + '"]').html(h);
					$('#btn_item_grup_simpan_' + id).hide();
					$('#btn_item_grup_edit_' + id).show();
				}
			})

	}

	function hapus_item_jenis_peta(id) {
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {

				$.ajax({
						url: '{{ route('admin.peta.hapus_jenis_peta') }}',
						type: 'POST',
						dataType: 'JSON',
						data: {
							id_jenis_peta: id,
							_token: csrfToken
						}

					})
					.done((res) => {
						if (res.status == 'success') {
							$('.item_jenis_peta[data-id="' + id + '"').parent().next().remove();
							$('.item_jenis_peta[data-id="' + id + '"').parent().remove();
							Swal.fire(
								'Terhapus!',
								'Data yang dipilih telah dihapus!',
								'success'
							);
						} else {
							Swal.fire(
								'Gagal!',
								res.message,
								'error'
							);
						}

					})
			}

		});

	}

	$('#show_data').on('change', '.switch_perbaikan', function() {
        var id = $(this).attr('data');
        var value = $(this).is(":checked") ? 1 : 0;

        $.ajax({
            url: "{{ route('admin.peta.switch_notif') }}",
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id,
                value: value, 
				_token: csrfToken
            },
            success: function(data) {
                if (data.status == true) {
                    toastr.success( 'Data berhasil dirubah', { timeOut: 2000, fadeOut: 2000 });
                    load_table();

                    // ini diambli dari footer
                    load_sidebar();
                } else {
                    toastr.error('Koneksi Bermasalah', {
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

    });
	// End Jenis Peta
</script>

<script>
	$('#show_data').on('click', '.btn_download', function(e) {
		e.preventDefault();
		var id_data = $(this).attr('data');
		var name = $(this).attr('data-name');

		var url = `{{ route('admin.peta.download_geojson', ['id' => '${id_data}', 'name' => '${name}']) }}`;

		window.open(url, '_blank');
	});
</script> --}}

