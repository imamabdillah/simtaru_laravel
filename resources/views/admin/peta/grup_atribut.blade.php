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
    let mode = '';
    let id_group = 0;
    const id_layer = {{ request()->segment(4) }};

    $(document).ready(function() {
        // Get CSRF token from meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Set up AJAX to always send the CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Load jQuery UI if not available and ensure initialization only happens after it's loaded
        if (typeof $.fn.sortable !== 'function') {
            $.getScript('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')
                .done(function() {
                    $('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">');
                    setTimeout(initializeApp, 100); // Initialize after a short delay
                });
        } else {
            initializeApp(); // Initialize immediately if jQuery UI is already available
        }
    });

    // Main initialization function - all jQuery UI dependent code goes here
    function initializeApp() {
        init_group();

        // Set up modal button handler
        $('#btn_modal_grup').click(function(e) {
            e.preventDefault();
            mode = 'tambah';
            $('#modal_grup').modal('show');
            $('.modal-footer button[type="submit"]').html('Tambah');
            $('#form_grup').trigger('reset');
        });

        // Set up form submission handler
        $('#form_grup').submit(function(e) {
            e.preventDefault();
            $('#modal_grup').modal('hide');
            $('#loader_box').show();
            let data = new FormData(this);
            data.append('id_layer', id_layer);
            data.append('id_group', id_group);
            data.append('_token', $('meta[name="csrf-token"]').attr('content'));

            if (mode == 'tambah') {
                $.ajax({
                    url: "{{ route('admin.peta.add_group') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#loader_box').hide();
                        if (res.status == 'success') {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Grup berhasil ditambahkan!',
                                type: 'success',
                                timer: 1500
                            });

                            let x = '<div id="group_' + res.data.id + '" class="group_title_item group_item" data-id="' + res.data.id + '">' + res.data.judul + '</div>';
                            $('#group_title').append(x);

                            let data = $('#group_title').sortable('serialize', {
                                key: 'group_sort[]'
                            });

                            $.ajax({
                                url: "{{ route('admin.peta.update_pos_group') }}",
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    id_layer: id_layer,
                                    data: data,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function() {
                                    location.reload();
                                },
                                error: function() {
                                    $('#loader_box').hide();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Grup tidak berhasil ditambahkan!',
                                type: 'error',
                                timer: 1500
                            });
                        }
                    },
                    error: function() {
                        $('#loader_box').hide();
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menambahkan grup',
                            type: 'error'
                        });
                    }
                });
            } else if (mode == 'edit') {
                $.ajax({
                    url: "{{ route('admin.peta.edit_group') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#loader_box').hide();
                        if (res.status == 'success') {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Grup berhasil diubah!',
                                type: 'success',
                                timer: 1500
                            });

                            $('.group_title_item[data-id="' + res.data.id + '"]').html(res.data.judul);
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: res.message,
                                type: 'error',
                                timer: 1500
                            });
                        }
                    },
                    error: function() {
                        $('#loader_box').hide();
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengubah grup',
                            type: 'error'
                        });
                    }
                });
            }
        });

        // Context menu setup and handlers - all other handlers remain the same
        setupContextMenuHandlers();

        // Other event handlers remain the same
        setupGroupAndItemHandlers();
    }

    // Function to set up context menu handlers
    function setupContextMenuHandlers() {
        // Context menu for group title items
        $(document).on('contextmenu', '.group_title_item', function(e) {
            e.preventDefault();
            $('#cmenu').html('').show().css({
                top: e.pageY + 'px',
                left: e.pageX + 'px'
            });

            let dataId = $(this).attr('data-id');
            let h = '';
            h += '<div class="edit_group_title" data-id="' + dataId + '"> <i class="fa fa-edit"></i> Edit</div>';
            h += '<div class="delete_group_title" data-id="' + dataId + '"> <i class="fa fa-trash"></i> Hapus</div>';
            $('#cmenu').html(h);
            return false;
        });

        // Click outside menu to close it
        $(document).on('mousedown', function(e) {
            if (!$(e.target).parents("#cmenu").length > 0 && !$(e.target).is("#cmenu")) {
                $("#cmenu").hide();
            }
        });

        // Context menu edit action
        $(document).on('click', '.edit_group_title', function() {
            $("#cmenu").hide();
            id_group = $(this).attr('data-id');
            $('#modal_grup').modal('show');

            $.ajax({
                url: "{{ route('admin.peta.get_group_detail') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id_group,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (res.status == 'success') {
                        mode = 'edit';
                        $('[name="judul_grup"]').val(res.data.judul_grup_atribut);
                        $('[name="sub_judul_grup"]').val(res.data.sub_judul_grup_atribut);
                        $('[name="tipe_grup"]').val(res.data.tipe_grup_atribut).trigger('change');
                        $('[name="ukuran_grup"]').val(res.data.ukuran_grup_atribut).trigger('change');
                        $('.modal-footer button[type="submit"]').html('Simpan');
                    } else {
                        $('#modal_grup').modal('hide');
                        Swal.fire(
                            'Gagal!',
                            res.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    $('#modal_grup').modal('hide');
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengambil detail grup',
                        type: 'error'
                    });
                }
            });
        });

        // Context menu delete action
        $(document).on('click', '.delete_group_title', function() {
            $("#cmenu").hide();
            let deleteId = $(this).attr('data-id');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengembalikan grup yang sudah dihapus!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('admin.peta.delete_group') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id: deleteId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('#group_' + deleteId).remove();

                                let data = $('#group_title').sortable('serialize', {
                                    key: 'group_sort[]'
                                });

                                $.ajax({
                                    url: "{{ route('admin.peta.update_pos_group') }}",
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: {
                                        id_layer: id_layer,
                                        data: data,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function() {
                                        Swal.fire(
                                            'Terhapus!',
                                            'Grup yang dipilih telah dihapus!',
                                            'success',
                                            1500
                                        );
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1500);
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: 'Warning',
                                            text: 'Grup dihapus tetapi terjadi error saat update posisi',
                                            type: 'warning'
                                        });
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Gagal dihapus!',
                                    res.message,
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menghapus grup',
                                type: 'error'
                            });
                        }
                    });
                }
            });
        });
    }

    // Function to set up group and item event handlers
    function setupGroupAndItemHandlers() {
        // Group title item click handler
        $(document).on('click', '.group_title_item', function(e) {
            e.preventDefault();
            $('.group_title_item').css('background', '#ffffff');
            $(this).css('background', '#f7f8d0');

            let id = $(this).attr('data-id');
            $('#loader_box').show();

            $.ajax({
                url: "{{ route('admin.peta.get_group_items') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    $('#loader_box').hide();
                    if (res.status == 'success') {
                        $('#layer_attribute').empty();
                        $('#group_attribute').empty();

                        let attributeItems = {};

                        // Process all items
                        if (res.data && res.data.length > 0) {
                            $.each(res.data, function(index, item) {
                                if (item.id_grup_atribut_item > 0) {
                                    // Item belongs to the group
                                    let displayName = (item.alias_atribut_layer != null && item.alias_atribut_layer != '') ?
                                                    item.alias_atribut_layer : item.nama_atribut_layer;

                                    let groupItem = '<div id="draggable_' + item.id_atribut + '" ' +
                                                'class="group_item draggable_item col-12" ' +
                                                'data-attr-id="' + item.id_atribut + '" ' +
                                                'data-group-id="' + item.id_grup_atribut + '" ' +
                                                'data-item-id="' + item.id_grup_atribut_item + '" ' +
                                                'data-attr-name="' + item.nama_atribut_layer + '">' +
                                                displayName + '</div>';

                                    attributeItems[item.id_atribut] = groupItem;
                                } else {
                                    // Item doesn't belong to the group (in layer attributes)
                                    let layerItem = '<div id="draggable_' + item.id_atribut + '" ' +
                                                'class="group_item draggable_item col-12" ' +
                                                'data-attr-id="' + item.id_atribut + '" ' +
                                                'data-group-id="' + item.id_grup_atribut + '" ' +
                                                'data-item-id="0" ' +
                                                'data-attr-name="' + item.nama_atribut_layer + '">' +
                                                item.nama_atribut + '</div>';

                                    $('#layer_attribute').append(layerItem);
                                }
                            });

                            // Add items to the group attribute container in the specified order
                            if (res.item_order && res.item_order.item_sort && res.item_order.item_sort.length > 0) {
                                $.each(res.item_order.item_sort, function(index, attrId) {
                                    if (attributeItems[attrId]) {
                                        $('#group_attribute').append(attributeItems[attrId]);
                                    }
                                });
                            } else {
                                // If no specific order, add all grouped items
                                $.each(res.data, function(index, item) {
                                    if (item.id_grup_atribut_item > 0 && attributeItems[item.id_atribut]) {
                                        $('#group_attribute').append(attributeItems[item.id_atribut]);
                                    }
                                });
                            }

                            // Initialize sortable and draggable for the items
                            initSortableDraggable(id);
                        }
                    } else {
                        Swal.fire(
                            'Gagal!',
                            res.message || 'Gagal memuat item grup',
                            'error'
                        );
                    }
                },
                error: function() {
                    $('#loader_box').hide();
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengambil item grup',
                        type: 'error'
                    });
                }
            });
        });

        // Context menu for group items
        $(document).on('contextmenu', '#group_attribute .group_item', function(e) {
            e.preventDefault();
            $('#cmenu').html('').show().css({
                top: e.pageY + 'px',
                left: e.pageX + 'px'
            });

            let itemId = $(this).attr('data-item-id');
            let h = '<div class="rename_group_item" data-item-id="' + itemId + '"> <i class="fa fa-edit"></i> Rename</div>';
            $('#cmenu').html(h);
            return false;
        });

        // Context menu rename action for group items
        $(document).on('click', '.rename_group_item', function() {
            $("#cmenu").hide();
            let itemId = $(this).attr('data-item-id');
            let currentText = $('.draggable_item[data-item-id="' + itemId + '"]').text();

            $('#modal_rename').modal('show');
            $('[name="alias_grup_item"]').val(currentText);

            // Reset form submission handler
            $('#form_rename').off('submit');

            // Set up form submission handler for renaming
            $('#form_rename').on('submit', function(f) {
                f.preventDefault();
                $('#modal_rename').modal('hide');
                $('#loader_box').show();

                let alias = $('[name="alias_grup_item"]').val().trim();

                if (alias != '') {
                    $.ajax({
                        url: "{{ route('admin.peta.rename_group_item') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_item: itemId,
                            alias: alias,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            $('#loader_box').hide();
                            if (res.status == 'success') {
                                $('.draggable_item[data-item-id="' + itemId + '"]').html(alias);
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: 'Nama item berhasil diubah',
                                    type: 'success',
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: res.message || 'Gagal mengubah nama item',
                                    type: 'error'
                                });
                            }
                        },
                        error: function() {
                            $('#loader_box').hide();
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengubah nama item',
                                type: 'error'
                            });
                        }
                    });
                } else {
                    $('#loader_box').hide();
                }
            });
        });
    }

    // Add CSS for context menu
    $('<style>\
        #cmenu {\
            display: none;\
            z-index: 9999;\
            position: absolute;\
            overflow: hidden;\
            border: 1px solid #CCC;\
            white-space: nowrap;\
            background: #FFF;\
            color: #333;\
            border-radius: 4px;\
            padding: 5px;\
            font-size: smaller;\
            box-shadow: 0px 5px 5px #dedede;\
        }\
        #cmenu div {\
            width: 100px;\
            padding: 8px;\
            cursor: pointer;\
            color: #777777;\
        }\
        #cmenu div:hover {\
            font-weight: bold;\
            color: #ffffff;\
            background: #777777;\
        }\
    </style>').appendTo('head');

    function init_group() {
        $('#loader_box').show();

        // Set a safety timeout to hide loader after 10 seconds
        setTimeout(function() {
            if ($('#loader_box').is(':visible')) {
                $('#loader_box').hide();
            }
        }, 10000);

        $.ajax({
            url: "{{ route('admin.peta.get_group') }}",
            type: 'POST',
            dataType: 'JSON',
            data: {
                id_layer: id_layer,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if (!res.group || res.group.length === 0) {
                    $('#loader_box').hide();
                    return;
                }

                let groupItems = {};

                // Process all groups
                $.each(res.group, function(index, group) {
                    let title = group.judul_grup_atribut == null || group.judul_grup_atribut == '' ?
                                'Judul ' + group.id_grup_atribut : group.judul_grup_atribut;

                    let displayTitle = title.length > 27 ? title.substring(0, 27) + ' ...' : title;

                    let groupElement = '<div id="group_' + group.id_grup_atribut + '" ' +
                                      'class="group_title_item group_item" ' +
                                      'data-id="' + group.id_grup_atribut + '" ' +
                                      'title="' + title + '">' + displayTitle + '</div>';

                    groupItems[group.id_grup_atribut] = groupElement;
                });

                // Add groups in the specified order if available
                if (res.group_order && res.group_order.group_sort && res.group_order.group_sort.length > 0) {
                    $.each(res.group_order.group_sort, function(index, groupId) {
                        if (groupItems[groupId]) {
                            $('#group_title').append(groupItems[groupId]);
                        }
                    });
                } else {
                    // If no specific order, add all groups
                    $.each(res.group, function(index, group) {
                        if (groupItems[group.id_grup_atribut]) {
                            $('#group_title').append(groupItems[group.id_grup_atribut]);
                        }
                    });
                }

                initGroupTitleSortable();
                $('#loader_box').hide();
            },
            error: function() {
                $('#loader_box').hide();
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menginisialisasi grup',
                    type: 'error'
                });
            }
        });
    }

    function initGroupTitleSortable() {
        $('#group_title').sortable({
            revert: false,
            update: function() {
                let data = $(this).sortable('serialize', {
                    key: 'group_sort[]'
                });

                $.ajax({
                    url: "{{ route('admin.peta.update_pos_group') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id_layer: id_layer,
                        data: data,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        });
    }

    function initSortableDraggable(groupId) {
        // Initialize sortable for both containers
        $('#group_attribute, #layer_attribute').sortable({
            revert: false,
            update: function() {
                if ($(this).attr('id') === 'group_attribute') {
                    let data = $('#group_attribute').sortable('serialize', {
                        key: 'item_sort[]'
                    });

                    $.ajax({
                        url: "{{ route('admin.peta.update_pos_group_item') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_group: groupId,
                            data: data,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                }
            }
        });

        // Initialize draggable for all items
        $('.draggable_item').draggable({
            connectToSortable: '#group_attribute, #layer_attribute',
            cursor: 'grabbing',
            start: function() {
                this.parentOld = $(this).parent().attr('id');
            },
            stop: function() {
                let parent = $(this).parent().attr('id');
                let parentOld = this.parentOld;

                if (parent === 'group_attribute' && parent !== parentOld) {
                    // Add item to group
                    $('#loader_box').show();
                    $.ajax({
                        url: "{{ route('admin.peta.add_group_item') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_atribut: $(this).attr('data-attr-id'),
                            id_grup_atribut: groupId,
                            nama_atribut: $(this).html(),
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                $(this).attr('data-item-id', res.data.id_item);
                                // Refresh the container
                                $('.group_title_item[data-id="' + groupId + '"]').trigger('click');
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: res.message || 'Gagal menambahkan item ke grup',
                                    type: 'error'
                                });
                            }
                            $('#loader_box').hide();
                        },
                        error: function() {
                            $('#loader_box').hide();
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menambahkan item ke grup',
                                type: 'error'
                            });
                        }
                    });
                } else if (parent === 'layer_attribute' && parent !== parentOld) {
                    // Remove item from group
                    $('#loader_box').show();
                    $.ajax({
                        url: "{{ route('admin.peta.delete_group_item') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_item: $(this).attr('data-item-id'),
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                $(this).attr('data-item-id', 0);
                                $(this).html($(this).attr('data-attr-name'));
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: res.message || 'Gagal menghapus item dari grup',
                                    type: 'error'
                                });
                            }
                            $('#loader_box').hide();
                        },
                        error: function() {
                            $('#loader_box').hide();
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menghapus item dari grup',
                                type: 'error'
                            });
                        }
                    });
                }
            }
        });
    }
</script>
