<script src="<?= base_url() ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    let mode = '';
    let id_group = 0;
    const id_layer = <?= $this->uri->segment(4) ?>;
    $(document).ready(function() {
        isian();
        init_group();

        $('#btn_modal_grup').click(function(e) {
            e.preventDefault();
            mode = 'tambah';
            $('#modal_grup').modal('show');
            $('.modal-footer button[type="submit"]').html('Tambah');
            $('#form_grup').trigger('reset');
        })

        $('#form_grup').submit(function(e) {
            e.preventDefault();
            $('#modal_grup').modal('hide');
            $('#loader_box').show();
            let data = new FormData(this);
            data.append('id_layer', id_layer);
            data.append('id_group', id_group);

            if (mode == 'tambah') {

                $.ajax({
                        url: '<?= base_url() ?>admin/peta/add_group',
                        type: "POST",
                        dataType: "JSON",
                        data: data,
                        contentType: false,
                        processData: false
                    })
                    .then(res => {
                        $('#loader_box').hide();
                        if (res.status == 'success') {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Grup berhasil ditambahkan!',
                                type: 'success',
                                timer: 1500
                            });

                            let x = '<div id="group_' + res.data.id + '" class="group_title_item group_item" data-id="' + res.data.id + '">' + res.data.judul + '</div>';
                            $('#group_title').append(x)
                            // $('#group_title').sortable('refresh');

                            let data = $('#group_title').sortable('serialize', {
                                key: 'group_sort[]'
                            });

                            $.ajax({
                                    url: '<?= base_url() ?>admin/peta/update_pos_group',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: {
                                        id_layer: id_layer,
                                        data: data
                                    }
                                })
                                .then(res => {
                                    location.reload();
                                })

                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Grup tidak berhasil ditambahkan!',
                                type: 'error',
                                timer: 1500
                            });
                        }
                    })
            } else if (mode == 'edit') {
                $.ajax({
                        url: '<?= base_url() ?>admin/peta/edit_group',
                        type: "POST",
                        dataType: "JSON",
                        data: data,
                        contentType: false,
                        processData: false
                    })
                    .then(res => {
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
                    })
            }
        });

    });

    function isian() {
        var id = '<?= $this->uri->segment(4); ?>';
        $.ajax({
            type: "GET",
            url: '<?= base_url() ?>admin/peta/get_layer_data',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $.each(data, function(nama, opd, sumber, status) {
                    $('.header_layer').html(data.nama);
                    $('[name="nama_layer"]').val(data.nama);
                    $('[name="deskripsi_layer"]').val(data.deskripsi_layer);
                    $('[name="grup_layer"]').val(data.grup_layer).trigger('change');
                    $('[name="jenis_peta"]').val(data.jenis_peta).trigger('change');
                    $('[name="nama_opd"]').val(data.opd).trigger('change');
                    $('[name="sumber_data"]').val(data.sumber);
                    $('[name="status_layer"]').val(data.status).trigger('change');;
                });
            }
        });
    }


    function init_group() {
        let id = <?= $this->uri->segment(4) ?>;
        $.ajax({
                url: '<?= base_url() ?>admin/peta/get_group',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_layer: id
                }
            })
            .then((res) => {
                let a = {};
                let build_array = res.group.map(v => {

                    return new Promise(x => {
                        // setTimeout(function() {
                        let n = v.judul_grup_atribut == null || v.judul_grup_atribut == '' ? 'Judul ' + v.id_grup_atribut : v.judul_grup_atribut;
                        let nn = n.length > 27 ? n.substring(0, 27) + ' ...' : n;
                        a[v.id_grup_atribut] = '<div id="group_' + v.id_grup_atribut + '" class="group_title_item group_item" data-id="' + v.id_grup_atribut + '" title="' + n + '">' + nn + '</div>';
                        // $('#group_title').append(x)
                        x(a[v.id_grup_atribut]);
                        // }, 5000)
                    })
                })

                Promise.all(build_array)
                    .then(() => {
                        // console.log('2: ', a);
                        if (res.group_order != null) {
                            res.group_order.group_sort.map(v => {
                                $('#group_title').append(a[v]);
                            })
                        }
                    })
            })
            .then(res => {
                $('#group_title').sortable({
                    revert: false,
                    update: function(e, i) {

                        let data = $(this).sortable('serialize', {
                            key: 'group_sort[]'
                        });

                        $.ajax({
                            url: '<?= base_url() ?>admin/peta/update_pos_group',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                id_layer: id,
                                data: data
                            }
                        })

                    },
                    stop: function(e, i) {

                        // console.log('group:', i.item.attr('data-id'));
                        // console.log('posisi: ', i.item.index());
                    }
                });

                $('.group_title_item').contextmenu(async function(e) {
                    e.preventDefault();
                    // console.log(e);
                    $('#cmenu').finish().toggle(100)
                        .css({
                            top: e.pageY + 'px',
                            left: e.pageX + 'px'
                        });
                    $(document).bind("mousedown", function(ee) {
                        if (!$(ee.target).parents("#cmenu").length > 0) {
                            $("#cmenu").hide(100);
                        }
                    });
                    h = '';
                    h += '<div class="edit_group_title" data-id="' + e.target.attributes['data-id'].value + '"> <i class="fa fa-edit"></i> Edit</div>';
                    h += '<div class="delete_group_title" data-id="' + e.target.attributes['data-id'].value + '"> <i class="fa fa-trash"></i> Hapus</div>';

                    function x() {
                        $('#cmenu').html(h);
                        return true;
                    }

                    let z = await x();

                    if (z) {

                        $('.edit_group_title').click(function(e) {
                            $("#cmenu").hide(100);
                            // id_group = e.target.attributes['data-id'].value;
                            id_group = $(this).attr('data-id');
                            $('#modal_grup').modal('show');
                            $.ajax({
                                    url: '<?= base_url() ?>admin/peta/get_group_detail',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: {
                                        id: id_group
                                    }
                                })
                                .then(res => {
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
                                })
                        })

                        $('.delete_group_title').click(function(e) {
                            $("#cmenu").hide(100);
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
                                            url: '<?= base_url() ?>admin/peta/delete_group',
                                            type: 'POST',
                                            dataType: 'JSON',
                                            data: {
                                                id: e.target.attributes['data-id'].value
                                            }
                                        })
                                        .then(res => {
                                            if (res.status == 'success') {

                                                $('#group_'+e.target.attributes['data-id'].value).remove();

                                                let data = $('#group_title').sortable('serialize', {
                                                    key: 'group_sort[]'
                                                });

                                                $.ajax({
                                                        url: '<?= base_url() ?>admin/peta/update_pos_group',
                                                        type: 'POST',
                                                        dataType: 'JSON',
                                                        data: {
                                                            id_layer: id_layer,
                                                            data: data
                                                        }
                                                    })
                                                    .then(res => {
                                                        Swal.fire(
                                                            'Terhapus!',
                                                            'Grup yang dipilih telah dihapus!',
                                                            'success',
                                                            1500
                                                        );
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 1500);
                                                    })


                                            } else {
                                                Swal.fire(
                                                    'Gagal dihapus!',
                                                    res.message,
                                                    'error'
                                                );
                                            }
                                        })
                                }
                            });
                        })
                    }
                    return false;
                })

                $('.group_title_item').click(function(e) {

                    $('.group_title_item').css('background', '#ffffff');
                    $(this).css('background', '#f7f8d0');

                    let id = $(this).attr('data-id');
                    $('#loader_box').show();
                    $.ajax({
                            url: '<?= base_url() ?>admin/peta/get_group_items',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                id: id
                            }
                        })
                        .then(res => {
                            if (res.status == 'success') {
                                $('#layer_attribute').html('');
                                $('#group_attribute').html('');
                                let a = {};
                                let build_array = res.data.map(v => {

                                    return new Promise(r => {
                                        if (v.id_grup_atribut_item > 0) {

                                            let x = '<div id="draggable_' + v.id_atribut + '" class="group_item draggable_item col-12" data-attr-id="' + v.id_atribut + '" data-group-id="' + v.id_grup_atribut + '" data-item-id="' + v.id_grup_atribut_item + '" data-attr-name="' + v.nama_atribut_layer + '">' + (v.alias_atribut_layer != null && v.alias_atribut_layer != '' ? v.alias_atribut_layer : v.nama_atribut_layer) + '</div>';
                                            // $('#group_attribute').append(x)
                                            a[v.id_atribut] = x;
                                            r(x);

                                        } else {
                                            let x = '<div id="draggable_' + v.id_atribut + '" class="group_item draggable_item col-12" data-attr-id="' + v.id_atribut + '" data-group-id="' + v.id_grup_atribut + '" data-item-id="0" data-attr-name="' + v.nama_atribut_layer + '">' + v.nama_atribut + '</div>';
                                            $('#layer_attribute').append(x)
                                            r(x);
                                        }

                                    })
                                })

                                Promise.all(build_array)
                                    .then(() => {
                                        if (res.item_order != null) {
                                            res.item_order.item_sort.map(v => {
                                                $('#group_attribute').append(a[v]);
                                            })
                                        }
                                    })

                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    res.message,
                                    'error'
                                );
                            }
                        })
                        .then(res => {
                            $('#loader_box').hide();

                            let parent_old = '';
                            let xpos = '';

                            $('#group_attribute, #layer_attribute').sortable({
                                revert: false,
                                update: function(e, i) {

                                    // let id_name = $(this).attr('id');

                                    // if (id_name == 'group_attribute') {

                                    let data = $('#group_attribute').sortable('serialize', {
                                        key: 'item_sort[]'
                                    });

                                    $.ajax({
                                        url: '<?= base_url() ?>admin/peta/update_pos_group_item',
                                        type: 'POST',
                                        dataType: 'JSON',
                                        data: {
                                            id_group: id,
                                            data: data
                                        }
                                    })
                                    // }

                                },
                                stop: function(e, i) {

                                    // console.log('item: ', i.item.attr('data-item-id'));
                                    // console.log('posisi: ', i.item.index());

                                }
                            });

                            //tambah
                            $('.draggable_item').draggable({
                                connectToSortable: '#group_attribute, #layer_attribute',
                                cursor: 'grabbing',
                                start: function(x) {
                                    parent_old = $(this).parent().attr('id');
                                },
                                stop: function(x) {

                                    let parent = $(this).parent().attr('id');

                                    if (parent == 'group_attribute' && parent != parent_old) {
                                        //tambah
                                        $('#loader_box').show();
                                        $.ajax({
                                                url: '<?= base_url() ?>admin/peta/add_group_item',
                                                type: 'POST',
                                                dataType: 'JSON',
                                                data: {
                                                    id_atribut: $(this).attr('data-attr-id'),
                                                    id_grup_atribut: id,
                                                    nama_atribut: $(this).html()
                                                }
                                            })
                                            .then(res => {
                                                $(this).attr('data-item-id', res.data.id_item);
                                            })
                                            .then(x => {
                                                $('.group_title_item[data-id="' + $(this).attr('data-group-id') + '"]').trigger('click');
                                                $('#loader_box').hide();
                                            })
                                    } else if (parent == 'layer_attribute' && parent != parent_old) {
                                        //hapus
                                        $('#loader_box').show();
                                        $.ajax({
                                                url: '<?= base_url() ?>admin/peta/delete_group_item',
                                                type: 'POST',
                                                dataType: 'JSON',
                                                data: {
                                                    id_item: $(this).attr('data-item-id'),
                                                }
                                            })
                                            .then(res => {
                                                $(this).attr('data-item-id', 0);
                                                $(this).html($(this).attr('data-attr-name'));
                                            })
                                            .then(res => {
                                                $('#loader_box').hide();
                                            })
                                    }
                                }
                            })

                            x_contex();

                            function x_contex() {
                                $('#group_attribute .group_item').contextmenu(async function(e) {
                                    e.preventDefault();
                                    // console.log(e);
                                    $('#cmenu').finish().toggle(100)
                                        .css({
                                            top: e.pageY + 'px',
                                            left: e.pageX + 'px'
                                        });
                                    $(document).bind("mousedown", function(ee) {
                                        if (!$(ee.target).parents("#cmenu").length > 0) {
                                            $("#cmenu").hide(100);
                                        }
                                    });
                                    h = '';
                                    h += '<div class="rename_group_item" data-item-id="' + e.target.attributes['data-item-id'].value + '"> <i class="fa fa-edit"></i> Rename</div>';

                                    function x() {
                                        $('#cmenu').html(h);
                                        return true;
                                    }

                                    let z = await x();

                                    if (z) {

                                        $('.rename_group_item').click(function(f) {
                                            $("#cmenu").hide(100);
                                            $('#modal_rename').modal('show');
                                            $('[name="alias_grup_item"]').val(e.target.innerHTML);
                                        })

                                        $('#form_rename').unbind().submit(function(f) {
                                            f.preventDefault();
                                            $('#modal_rename').modal('hide');
                                            $('#loader_box').show();
                                            let id_item, alias;
                                            id_item = e.target.attributes['data-item-id'].value;
                                            alias = $('[name="alias_grup_item"]').val().trim();

                                            if (alias != '') {
                                                $.ajax({
                                                        url: '<?= base_url() ?>admin/peta/rename_group_item',
                                                        type: 'POST',
                                                        dataType: 'JSON',
                                                        data: {
                                                            id_item: id_item,
                                                            alias: alias
                                                        }
                                                    })
                                                    .then(res => {
                                                        if (res.status == 'success') {
                                                            $('.draggable_item[data-item-id="' + id_item + '"]').html(alias);
                                                        } else {
                                                            // Swal.fire(
                                                            //     'Gagal!',
                                                            //     res.message,
                                                            //     'error'
                                                            // );
                                                        }
                                                    })
                                                    .then(res => {
                                                        $('#loader_box').hide();
                                                    })
                                            } else {
                                                $('#modal_rename').modal('hide');
                                                $('#loader_box').hide();
                                            }
                                        })

                                    }
                                    return false;
                                })
                            }

                        })
                        .then(res => {


                        })

                })

            })
    }
</script>