@extends('layouts.wrapper')

<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }

    .group_container {
        padding: 5px;
    }

    .group_box {
        border: 3px dashed #dedede;
        padding: 5px;
        border-radius: 4px;
        background: #efefef;
    }

    .group_item {
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #dedede;
        margin-top: 3px;
        background: #ffffff;
        height: 40px !important;
    }

    .group_box {
        height: 400px;
        margin-bottom: 50px;
        overflow-y: auto;
    }

    /* The whole thing */
    #cmenu {
        display: none;
        z-index: 1000;
        position: absolute;
        overflow: hidden;
        border: 1px solid #CCC;
        white-space: nowrap;
        background: #FFF;
        color: #333;
        border-radius: 4px;
        padding: 5px;
        font-size: smaller;
        box-shadow: 0px 5px 5px #dedede;
    }

    #cmenu div {
        width: 70px;
        /* padding: 5px; */
        color: #777777;
        padding-left: 5px;
    }

    #cmenu div:hover {
        cursor: pointer;
        font-weight: bold;
        color: #ffffff;
        background: #777777;
    }

    .group_title_item:hover {
        cursor: pointer;
        color: #000000;
    }

    #loader_box {
        position: fixed;
        width: 100vw;
        height: 100vh;
        text-align: center;
        display: none;
        z-index: 2000;
        top: 0px;
        background: #ababab;
        opacity: 0.7;
    }

    #loader{
        position: absolute;
        top: 35vh;
        left: 35vw;
    }
</style>

@section('contents')
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Grup Atribut "<b>{{ $layer->nama_layer }}</b>"</h3>
                <div class="block-options">
                     <a class="btn btn-sm btn-danger" href="{{ url('admin/peta') }}">
                        <i class="fa fa-angle-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-md-3 group_container">
                        <h5 style="text-align: center; color: #ababab">Judul Grup</h5>
                        <button id="btn_modal_grup" class="btn btn-success btn-block" style="margin-bottom: 10px"><i class="fa fa-plus"></i> Tambah Grup</button>
                        <div id="group_title" class="group_box" style="height: 356px"></div>
                    </div>
                    <div class="col-md-4 group_container">
                        <h5 style="text-align: center; color: #ababab">Item Grup</h5>
                        <div id="group_attribute" class="group_box" style="overflow-x:hidden"></div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <div style="margin-top: 220px">
                                <i class="fa fa-angle-double-left  text-success"></i> <span class="text-success" style="font-size: smaller">Tambah</span>
                            </div>
                            <div>
                                <span class="text-danger" style="font-size: smaller">Hapus</span> <i class="fa fa-angle-double-right text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 group_container">
                        <h5 style="text-align: center; color: #ababab">Atribut Layer</h5>
                        <div id="layer_attribute" class="group_box"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Pop In Modal -->
<div class="modal fade" id="modal_grup" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <form id="form_grup">
            @csrf
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah Grup Atribut</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="id_layer" id="id_layer" value="{{ $layer->id_layer }}">
                        <div class="col-12">
                            <label for="judul_grup">Judul Group</label>
                            <input name="judul_grup" type="text" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="sub_judul_grup">Sub Judul Group</label>
                            <textarea name="sub_judul_grup" id="sub_judul_grup" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="tipe_grup">Tipe Group</label>
                            <select name="tipe_grup" id="tipe_grup" class="form-control">
                                <option value="table">Tabel</option>
                                <option value="vertical_bar_chart">Vertical Bar Chart</option>
                                <option value="horizontal_bar_chart">Horizontal Bar Chart</option>
                                <option value="pie_chart">Pie Chart</option>
                                <option value="doughnut_chart">Doughnut Chart</option>
                                <option value="radar_chart">Radar Chart</option>
                            </select>
                        </div>
                        <div class="col-12" style="margin-bottom: 20px">
                            <label for="ukuran_grup">Ukuran Group</label>
                            <select name="ukuran_grup" id="ukuran_grup" class="form-control">
                                <option value="penuh">Penuh</option>
                                <option value="setengah">Setengah</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Tambah
                    </button>
                </div>
        </form>
    </div>
</div>
</div>
<!-- END Pop In Modal -->

<!-- Pop In Modal -->
<div class="modal fade" id="modal_rename" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <form id="form_rename">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="col-12" style="margin-bottom: 20px;">
                            <label for="alias_grup_item">Alias Item Grup</label>
                            <input name="alias_grup_item" type="text" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Ubah
                    </button>
                </div>
        </form>
    </div>
</div>
</div>
<!-- END Pop In Modal -->

<div id="cmenu"></div>

<div id="loader_box">
    <svg id="loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <defs>
            <clipPath id="ldio-0sslxgday7x9-cp" x="0" y="0" width="100" height="100">
                <path d="M81.3,58.7H18.7c-4.8,0-8.7-3.9-8.7-8.7v0c0-4.8,3.9-8.7,8.7-8.7h62.7c4.8,0,8.7,3.9,8.7,8.7v0C90,54.8,86.1,58.7,81.3,58.7z"></path>
            </clipPath>
        </defs>
        <path fill="none" stroke="#6a6a6a" stroke-width="2.7928" d="M82 63H18c-7.2,0-13-5.8-13-13v0c0-7.2,5.8-13,13-13h64c7.2,0,13,5.8,13,13v0C95,57.2,89.2,63,82,63z"></path>
        <g clip-path="url(#ldio-0sslxgday7x9-cp)">
            <g transform="translate(78.5573 0)">
                <rect x="-100" y="0" width="25" height="100" fill="#979797"></rect>
                <rect x="-75" y="0" width="25" height="100" fill="#bdbdbd"></rect>
                <rect x="-50" y="0" width="25" height="100" fill="#e2e2e2"></rect>
                <rect x="-25" y="0" width="25" height="100" fill="#f8f8f8"></rect>
                <rect x="0" y="0" width="25" height="100" fill="#979797"></rect>
                <rect x="25" y="0" width="25" height="100" fill="#bdbdbd"></rect>
                <rect x="50" y="0" width="25" height="100" fill="#e2e2e2"></rect>
                <rect x="75" y="0" width="25" height="100" fill="#f8f8f8"></rect>
                <animateTransform attributeName="transform" type="translate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0;100"></animateTransform>
            </g>
        </g>
    </svg>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>



<script>
   $(document).ready(function () {
    let mode = '';
    let id_group = 0;
    let id_layer = $('#id_layer').val();

    // Fungsi untuk reload daftar grup
    function init_group() {
        $.ajax({
            url: "{{ route('admin.peta.get_group') }}",
            type: "POST",
            data: {
                id_layer: id_layer,
                _token: "{{ csrf_token() }}" },
            success: function (response) {
                if (response.status === 'success') {
                    $('#group_title').empty();
                    response.groups.forEach(group => {
                        let groupItem = `<div id="group_${group.id}" class="group_title_item group_item" data-id="${group.id}">
                                            ${group.judul_grup_atribut}
                                         </div>`;
                        $('#group_title').append(groupItem);
                    });
                }
            }
        });
    }

    init_group(); // Panggil saat pertama kali halaman dimuat

    // Event listener untuk tombol "Tambah Grup"
    $('#btn_modal_grup').click(function (e) {
        e.preventDefault();
        mode = 'tambah';
        id_group = 0;
        $('#modal_grup').modal('show');
        $('.modal-footer button[type="submit"]').html('Tambah');
        $('#form_grup').trigger('reset');
    });

    // Event listener untuk edit grup
    $(document).on('click', '.group_title_item', function () {
        mode = 'edit';
        id_group = $(this).data('id');
        $('#modal_grup').modal('show');
        $('.modal-footer button[type="submit"]').html('Edit');

        // Ambil data grup berdasarkan ID
        $.ajax({
            url: "{{ route('admin.peta.get_group_by_id') }}",
            type: "POST",
            data: {
                id_group: id_group ,
                _token: "{{ csrf_token() }}"},
            success: function (response) {
                if (response.status === 'success') {
                    $('#judul_grup').val(response.data.judul_grup_atribut);
                    $('#sub_judul_grup').val(response.data.sub_judul_grup_atribut);
                    $('#tipe_grup').val(response.data.tipe_grup_atribut);
                    $('#ukuran_grup').val(response.data.ukuran_grup_atribut);
                }
            }
        });
    });

    // Event listener untuk submit form tambah/edit grup
    $('#form_grup').submit(function (e) {
        e.preventDefault();
        $('#modal_grup').modal('hide');
        $('#loader_box').show();

        let formData = new FormData(this);
        formData.append('id_group', id_group);
        formData.append('id_layer', id_layer);

        let url = (mode === 'tambah') ? "{{ route('admin.peta.add_group') }}" : "{{ route('admin.peta.edit_group') }}";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#loader_box').hide();

                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Sukses!',
                        text: (mode === 'tambah') ? 'Grup berhasil ditambahkan!' : 'Grup berhasil diubah!',
                        icon: 'success',
                        timer: 1500
                    }).then(() => {
                        location.reload(); // Refresh halaman setelah sukses
                    });

                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error',
                        timer: 1500
                    });
                }
            },
            error: function () {
                $('#loader_box').hide();
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server.',
                    icon: 'error',
                    timer: 1500
                });
            }
        });
    });
});


   $(document).ready(function () {
        let id_layer = $('#id_layer').val();

        function loadGroups() {
            console.log("Memuat grup untuk id_layer:", id_layer);

            $.ajax({
                url: "{{ route('admin.peta.get_group') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { id_layer: id_layer },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#group_title').empty();

                        response.groups.forEach(group => {
                            let groupHtml = `
                                <div id="group_${group.id_grup_atribut}" class="group_title_item group_item" data-id="${group.id_grup_atribut}">
                                    ${group.judul_grup_atribut}
                                </div>`;
                            $('#group_title').append(groupHtml);
                        });

                        console.log("Grup berhasil dimuat:", response.groups);
                    } else {
                        console.error("Gagal mengambil grup:", response.message);
                    }
                },
                error: function (xhr) {
                    console.error("Terjadi kesalahan saat mengambil grup:", xhr.responseText);
                }
            });
        }

        // Panggil loadGroups saat halaman dimuat
        loadGroups();

        // Event delegation untuk klik pada .group_title_item yang ditambahkan secara dinamis
        $(document).on('click', '.group_title_item', function (e) {
            e.preventDefault();

            $('.group_title_item').css('background', '#ffffff');
            $(this).css('background', '#f7f8d0');

            let id_grup_atribut = $(this).data('id');

            console.log("ID Grup Atribut yang dikirim:", id_grup_atribut);

            if (!id_grup_atribut) {
                console.error("Error: ID Grup Atribut tidak ditemukan.");
                Swal.fire('Gagal!', 'ID Grup Atribut tidak ditemukan.', 'error');
                return;
            }

            $('#loader_box').show();

            $.ajax({
                url: "{{ route('admin.peta.get_group_items') }}",
                type: "POST",
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { id: id_grup_atribut },
                success: function (res) {
                    $('#loader_box').hide();

                    if (res.status === 'success') {
                        console.log("Data grup atribut yang diterima:", res.data);
                        $('#layer_attribute').html('');
                        $('#group_attribute').html('');
                        let a = {};

                        let build_array = res.data.map(v => {
                            return new Promise(resolve => {
                                let x = `<div id="draggable_${v.id_atribut}" class="group_item draggable_item col-12"
                                    data-attr-id="${v.id_atribut}" data-group-id="${v.id_grup_atribut}"
                                    data-item-id="${v.id_grup_atribut_item || 0}" data-attr-name="${v.nama_atribut_layer}">
                                    ${v.alias_atribut_layer || v.nama_atribut_layer}
                                </div>`;

                                if (v.id_grup_atribut_item > 0) {
                                    a[v.id_atribut] = x;
                                } else {
                                    $('#layer_attribute').append(x);
                                }
                                resolve(x);
                            });
                        });

                        Promise.all(build_array).then(() => {
                            if (res.item_order && res.item_order.item_sort) {
                                res.item_order.item_sort.forEach(v => {
                                    $('#group_attribute').append(a[v]);
                                });
                            }
                        });

                    } else {
                        Swal.fire('Gagal!', res.message, 'error');
                    }
                },
                error: function (xhr) {
                    $('#loader_box').hide();
                    console.error("Error response:", xhr.responseText);
                    Swal.fire('Gagal!', 'Terjadi kesalahan pada server.', 'error');
                }
            });
        });
    });
</script>

