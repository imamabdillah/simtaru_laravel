<style>
    .err {
        padding: 0px;
        color: red;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->

        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title">
                    <i class="fa fa-users text-body-bg-dark mr-2 font-size-sm"></i>
                    Daftar Pengguna
                </h3>

                <button type="button" class="btn btn-primary" id="show_modal_tambah">
                    <i class="fa fa-plus mr-5"></i> Tambah User
                </button>
            </div>

            <div class="block-content">
                <!-- Table start -->
                <table class="table table-bordered table-striped" id="mydata" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Username</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">

                    </tbody>
                </table>
                <!-- Table end -->
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-lg" role="document">
        <div class="modal-content">
            <form id="form_tambah">

                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Nama Lengkap</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="tambah_nama" name="tambah_nama">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-12" for="sumber">Status User</label>
                                    <div class="col-md-12">
                                        <select required class="sumber form-control" id="tambah_role" name="tambah_role" style="width: 100%;" onclick="change_role(this.value)">
                                            <!-- <option value=""></option> -->
                                            <option value="2">OPD</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- iki nggo sing role e OPD -->
                                <div id="kelompok_opd">
                                    <div class="form-group row">
                                        <label class="col-12" for="nama_layer">Pilih OPD</label>
                                        <div class="col-md-12">
                                            <select class="sumber form-control" id="tambah_id_opd" name="tambah_id_opd" style="width: 100%;">
                                                <!-- <option></option> -->
                                                <?php
                                                foreach ($data_opd as $tampil) {
                                                ?>
                                                    <option value="<?= $tampil['id_opd'] ?>"><?= $tampil['nama_opd'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Username</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="tambah_username" name="tambah_username" placeholder="Masukkan nama layer">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Password</label>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" id="tambah_password" name="tambah_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Re-Type Password</label>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" id="tambah_password_2" name="tambah_password_2" onkeyup="cek_password_1_dan_2()">
                                        <label class="err err_password"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-simpan" id="tombol_simpan">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <form id="form_edit">

                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Edit User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <dir class="col-md-12">
                                <div class="form-group row" hidden>
                                    <label class="col-12" for="nama_layer">ID User</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="edit_id_user" name="edit_id_user">
                                    </div>
                                </div>
                                <div class="form-group row" hidden>
                                    <label class="col-12" for="nama_layer">ID User Detail</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="edit_id_user_detail" name="edit_id_user_detail">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Nama Lengkap</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="edit_nama" name="edit_nama">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-12" for="sumber">Status User</label>
                                    <div class="col-md-12">
                                        <select required class="sumber form-control" id="edit_role" name="edit_role" style="width: 100%;" onclick="change_role(this.value)">
                                            <!-- <option value=""></option> -->
                                            <option value="2">OPD</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- iki nggo sing role e OPD -->
                                <div id="kelompok_opd_edit">
                                    <div class="form-group row">
                                        <label class="col-12" for="nama_layer">Pilih OPD</label>
                                        <div class="col-md-12">
                                            <select class="sumber form-control" id="edit_id_opd" name="edit_id_opd" style="width: 100%;">
                                                <!-- <option></option> -->
                                                <?php
                                                foreach ($data_opd as $tampil) {
                                                ?>
                                                    <option value="<?= $tampil['id_opd'] ?>"><?= $tampil['nama_opd'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </dir>

                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-alt-success btn-simpan" id="tombol_simpan">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ganti_password" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <form id="form_ganti_password">

                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Reset Password</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <dir class="col-md-12">
                                <div class="form-group row" hidden>
                                    <label class="col-12" for="nama_layer">ID User</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="ganti_id_user" name="ganti_id_user">
                                    </div>
                                </div>
                                <div class="form-group row" hidden>
                                    <label class="col-12" for="nama_layer">ID User Detail</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="ganti_id_user_detail" name="ganti_id_user_detail">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Username</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="ganti_username" name="ganti_username" placeholder="Masukkan nama layer">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Password</label>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" id="ganti_password" name="ganti_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="nama_layer">Re-Type Password</label>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" id="ganti_password_2" name="ganti_password_2" onkeyup="cek_password_1_dan_2_edit()">
                                        <label class="err err_password"></label>
                                    </div>
                                </div>

                            </dir>

                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-alt-success btn-simpan" id="tombol_ganti_password">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        tampil_data();
        $('#kelompok_opd_tambah').hide();
        // $('#kelompok_opd_edit').hide();
        // $('#kelompok_opd').hide();
        $('#tombol_simpan').prop('disabled', true);
        $('#tombol_ganti_password').prop('disabled', true);
    });

    $('#show_modal_tambah').click(function() { //button filter event click
        $('#modal-tambah').modal('show'); //just reload table
    });

    $('#form_tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/user/simpan',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(res) {
                if (res === true) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data Berhasil Disimpan',
                        type: 'success',
                        timer: 1500
                    });
                    $('#modal-tambah').modal('hide');
                    location.reload();
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data Gagal Disimpan',
                        type: 'error',
                        timer: 1500
                    });
                    $('#modal-tambah').modal('hide');
                }
            }
        });
        return false;
    });

    $('#form_edit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/user/edit',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(res) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Berhasil Disimpan',
                    type: 'success',
                    timer: 1500
                });
                $('#modal-form_edit').modal('hide');
                location.reload();

            }
        });
        return false;
    });

    $('#form_ganti_password').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/user/ganti_password',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(res) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Berhasil Disimpan',
                    type: 'success',
                    timer: 1500
                });
                $('#modal-form_ganti_password').modal('hide');
                location.reload();
            }
        });
        return false;
    });

    function change_role(role) {
        if (role === "2") {
            $('#kelompok_opd_tambah').show();
            $('#kelompok_opd_edit').show();
        } else {
            $('#kelompok_opd_tambah').hide();
            // $('#kelompok_opd_edit').hide();
        }
    }


    function cek_password_1_dan_2() {
        var password = $('#tambah_password').val();
        var password_2 = $('#tambah_password_2').val();

        if (password === password_2) {
            $('.err').hide();
            $('#tombol_simpan').prop('disabled', false);
        } else {
            $('.err').show();
            $('.err').html('Password 1 dan 2 Tidak Sama');
            $('#tombol_simpan').prop('disabled', true);
        }
    }

    function cek_password_1_dan_2_edit() {
        var password = $('#ganti_password').val();
        var password_2 = $('#ganti_password_2').val();

        if (password === password_2) {
            $('.err').hide();
            $('#tombol_ganti_password').prop('disabled', false);
        } else {
            $('.err').show();
            $('.err').html('Password 1 dan 2 Tidak Sama');
            $('#tombol_ganti_password').prop('disabled', true);
        }
    }


    function show_modal_edit(id_user_detail, id_user) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>admin/user/pencarian_user',
            async: false,
            dataType: 'json',
            data: {
                id_user_detail: id_user_detail
            },
            success: function(data) {
                // $('#kelompok_opd_edit').hide();

                $('#edit_id_user').val(data.id_user);
                $('#edit_id_user_detail').val(data.id_user_detail);
                $('#edit_nama').val(data.nama);
                $('#edit_role').val(data.role).change();
                $('#edit_id_opd').val(data.id_opd).change();

                if (data.role === "2") {
                    $('#kelompok_opd_edit').show();
                }

                $('#modal-edit').modal('show');
            }
        });
    }

    function show_modal_ganti_password(id_user_detail, id_user) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>admin/user/pencarian_user',
            async: false,
            dataType: 'json',
            data: {
                id_user_detail: id_user_detail
            },
            success: function(data) {
                // $('#kelompok_opd_edit').hide();

                $('#ganti_id_user').val(data.id_user);
                $('#ganti_id_user_detail').val(data.id_user_detail);
                $('#ganti_username').val(data.user_name);

                $('#modal-ganti_password').modal('show');
            }
        });
    }

    function show_modal_hapus(id_user_detail, id_user) {
        Swal.fire({
            title: 'Apakah anda yakin!',
            text: "Apakah anda yakin akan menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Hapus sekarang!',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>admin/user/hapus',
                    async: false,
                    dataType: 'json',
                    data: {
                        id_user_detail: id_user_detail,
                        id_user: id_user
                    },
                    success: function(data) {
                        Swal.fire(
                            'Terhapus!',
                            'Data yang dipilih telah dihapus!',
                            'success'
                        )
                        location.reload();
                    }
                });

            }
        });
    }

    //fungsi tampil barang
    function tampil_data() {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url() ?>admin/user/daftar_user',
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    role = data[i].role;
                    if (role == 1) {
                        role = 'Administrator';
                    } else
                    if (role == 2) {
                        role = 'OPD';
                    } else {
                        role = 'Pemohon';
                    }

                    status = data[i].is_active;
                    if (status == 1) {
                        status = 'Aktif';
                    } else {
                        status = 'Non Aktif';
                    }
                    html += '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + data[i].nama + '</td>' +
                        '<td>' + role + '</td>' +
                        '<td>' + data[i].user_name + '</td>' +
                        '<td style="text-align:center;">' +
                        '<button data="' + data[i].id_user_detail + '" type="button" class="btn btn-warning btn-sm" onclick="show_modal_ganti_password(' + data[i].id_user_detail + ', ' + data[i].id_user + ')"><i class="fa fa-key"></i></button>' +
                        '&nbsp;' +
                        '<button data="' + data[i].id_user_detail + '" type="button" class="btn btn-info btn-sm" onclick="show_modal_edit(' + data[i].id_user_detail + ', ' + data[i].id_user + ')"><i class="fa fa-edit"></i></button>' +
                        '&nbsp;' +
                        '<button data="' + data[i].id_user_detail + '" type="button" class="btn btn-danger btn-sm" onclick="show_modal_hapus(' + data[i].id_user_detail + ', ' + data[i].id_user + ')"><i class="fa fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });

        $('#mydata').dataTable({
            "columnDefs": [{
                    "width": "10px",
                    "targets": 0
                },
                {
                    "width": "80px",
                    "orderable": false,
                    "targets": 4
                }
            ],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang cocok",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_ total halaman",
                "infoEmpty": "Belum ada data yang bisa ditampilkan",
                "infoFiltered": "(diseleksi dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            }
        });
    }
</script>