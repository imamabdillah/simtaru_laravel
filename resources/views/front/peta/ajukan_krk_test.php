<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" class="no-focus"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>SIMPUTER | DPUPR Kota Tegal</title>

    <meta name="description" content="SIMPUTER | DPUPR Kota Tegal">
    <meta name="author" content="Phicosdev">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="SIMPUTER | DPUPR Kota Tegal">
    <meta property="og:site_name" content="INTIP">
    <meta property="og:description" content="SIMPUTER | DPUPR Kota Tegal">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="<?= base_url('assets') ?>/favicon.png" type="image/x-icon" /> -->
    <link rel="shortcut icon" href="<?= base_url('assets') ?>_front/images/favicon.ico" />
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets') ?>/img/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets') ?>/img/favicons/apple-touch-icon-180x180.png">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" id="css-main" href="<?= base_url('assets') ?>/css/codebase.min.css">
    <link rel="stylesheet" id="css-main" href="<?= base_url('assets') ?>/css/main.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/leaflet.measure.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Dropzone -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/dropzonejs/min/dropzone.min.css">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/magnific-popup/magnific-popup.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">

    <script src="<?= base_url('assets') ?>/js/core/jquery.min.js"></script>
</head>

<body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed page-header-modern main-content-boxed">
    </div>
    <!-- END Sidebar Scroll Container -->
    </nav>
    <style>
        #data_per_layer {
            width: 100%;
            height: 500px;
        }

        #layer_per_opd,
        #data_per_opd,
        #layer_per_grup_layer,
        #data_per_grup_layer,
        #layer_per_jenis_peta,
        #data_per_jenis_peta,
        #data_per_status,
        #data_per_halaman_detail {
            width: 100%;
            height: 400px;
        }
    </style>
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="col-lg-12">
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item" id="nav-item-auth">
                            <a class="nav-link active" href="#tabs-login">Detail</a>
                        </li>
                        <li class="nav-item" id="nav-item-identitas">
                            <a class="nav-link" href="#tabs-form">Form Identitas</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left show active" id="tabs-login" role="tabpanel">
                            <form class="js-validation-signin col-6 m-auto" action="<?= base_url('auth/login/krk_auth') ?>" method="post" onsubmit="return false;" id="form-auth-krk">
                                <?php echo ($this->session->flashdata('msg') == '' ? '' : $this->session->flashdata('msg')); ?>
                                <div class="block block-themed block-rounded block-shadow">
                                    <div class="block-header bg-gd-dusk">
                                        <h3 class="block-title">Silakan Login</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option">
                                                <i class="si si-wrench"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <input type="hidden" class="form-control" name="keyword" value="<?= @$keyword ?>">
                                        <input type="hidden" class="form-control" name="lat" value="<?= @$lat ?>">
                                        <input type="hidden" class="form-control" name="lng" value="<?= @$lng ?>">
                                        <input type="hidden" class="form-control" name="kegiatan" value="<?= @$kegiatan ?>">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="login-username">Username</label>
                                                <input type="text" class="form-control" id="login-username" name="username" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="login-password">Password</label>
                                                <input type="password" class="form-control" id="login-password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <!-- <div class="col-sm-6 d-sm-flex align-items-center push">
                                            <div class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                                <input type="checkbox" class="custom-control-input" id="login-remember-me" name="login-remember-me">
                                                <label class="custom-control-label" for="login-remember-me">Remember Me</label>
                                            </div>
                                        </div> -->
                                            <div class="col-sm-8 text-sm-right push">
                                                <!-- <a href="https://ministry.phicos.co.id/tegal-krk/register/pemohon" class="btn btn-alt-success">
                                                    <i class="si si-action-undo mr-10"></i> Registrasi
                                                </a> -->
                                            </div>
                                            <div class="col-sm-4 text-sm-right push">
                                                <button type="submit" class="btn btn-alt-primary">
                                                    <i class="si si-login mr-10"></i> Login
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-12 badge badge-danger" style="text-align: left;">
                                <ol>
                                    <li>Silakan login menggunakan akun yang sudah terdaftar pada sistem KRK Kota Tegal </li>
                                    <li>Jika belum mempunyai akun silakan registasi terlebih dahulu dengan memilih tombol registrasi yang telah tersedia</li>
                                    <li>Dan pastikan akun sudah terverifikasi juga, sehingga dapat login ke sistem KRK Kota Tegal</li>
                                </ol>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-left" id="tabs-form" role="tabpanel">
                            <form id="add-form" action="<?= base_url('pengajuan_krk/simpan') ?>" enctype="multipart/form-data" method="post" autocomplete="off" onsubmit="return false;">
                                <input type="hidden" name="auth_token" required>
                                <input type="hidden" name="id_pengajuan" id="id_pengajuan">
                                <style>
                                    .select2-selection__rendered {
                                        line-height: 31px !important;
                                    }

                                    .select2-container .select2-selection--single {
                                        height: 35px !important;
                                    }

                                    .select2-selection__arrow {
                                        height: 34px !important;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="block">
                                            <div class="block-header bg-gd-dusk">
                                                <h3 class="block-title text-white">1. Identitas Pemohon</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_pemohon_1">Nama Pemohon 1 <span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="nama_pemohon_1" name="nama_pemohon_1" placeholder="Masukkan nama pemohon 1" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_pemohon_2">Nama Pemohon 2</label>
                                                            <input class="form-control" type="text" id="nama_pemohon_2" name="nama_pemohon_2" placeholder="Masukkan nama pemohon 2">
                                                            <br>
                                                            <label for="ket_nama_pemohon_2">
                                                                <span class="text-primary">
                                                                    *) Keterangan : Jika Nama Pemohon lebih dari dua maka dituliskan Nama Pemohon dan CS.
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nik_pemohon_1">NIK Pemohon 1 <span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="nik_pemohon_1" name="nik_pemohon_1" placeholder="Masukkan nama pemohon 1" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nik_pemohon_2">NIK Pemohon 2</label>
                                                            <input class="form-control" type="text" id="nik_pemohon_2" name="nik_pemohon_2" placeholder="Masukkan nama pemohon 2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="hp_pemohon">HP Pemohon<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="hp_pemohon" name="hp_pemohon" placeholder="08xx ......." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="alamat_pemohon">Alamat Pemohon<span class="text-danger"> *)</span></label>
                                                            <textarea name="alamat_pemohon" id="alamat_pemohon" class="form-control" rows="4" placeholder="Masukkan alamat pemohon" required></textarea>
                                                            <br>
                                                            <label class="col-form-label">
                                                                <span class="text-primary">
                                                                    *) Keterangan : Tambahkan Nama Jalan dan/atau Nama Gang atau Nomor Rumah
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="rt_pemohon">RT Pemohon<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="rt_pemohon" name="rt_pemohon" placeholder="Masukkan rt pemohon" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="rw_pemohon">RW Pemohon<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="rw_pemohon" name="rw_pemohon" placeholder="Masukkan rw pemohon" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kode_kabupaten_pemohon">Kabupaten / Kota<span class="text-danger"> *)</span></label>
                                                            <select name="kode_kabupaten_pemohon" id="kode_kabupaten_pemohon" class="form-control select2">
                                                                <option value="">Pilih Salah Satu</option>
                                                                <?php foreach ($all_kab as $row) : ?>
                                                                    <option value="<?= $row->kode_bersih ?>"><?= "{$row->nama} (Prov. {$row->nama_propinsi})" ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kode_kecamatan_pemohon">Kecamatan<span class="text-danger"> *)</span></label>
                                                            <select name="kode_kecamatan_pemohon" id="kode_kecamatan_pemohon" class="form-control select2">
                                                                <option value="">Pilih Salah Satu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kode_kelurahan_pemohon">Kelurahan<span class="text-danger"> *)</span></label>
                                                            <select name="kode_kelurahan_pemohon" id="kode_kelurahan_pemohon" class="form-control select2">
                                                                <option value="">Pilih Salah Satu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="block">
                                            <div class="block-header bg-gd-dusk">
                                                <h3 class="block-title text-white">2. Informasi Tanah</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="latitude_tanah">Latitude<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="latitude" name="latitude_tanah" value="<?= @$lat ?>" placeholder="Masukkan latitude tanah" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="langitude_tanah">Longitude<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="longitude" name="longitude_tanah" value="<?= @$lng ?>" placeholder="Masukkan longitude tanah" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="keyword">Keyword<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="keyword" name="keyword" value="<?= @$keyword ?>" placeholder="Masukkan keyword" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Kegiatan<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="kegiatan" name="kegiatan" value="<?= @$kegiatan ?>" placeholder="Masukkan kegiatan" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="lokasi_tanah">Lokasi Tanah<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="lokasi_tanah" name="lokasi_tanah" placeholder="Masukkan lokasi tanah" required>
                                                            <br>
                                                            <label class="col-form-label">
                                                                <span class="text-primary">
                                                                    *) Keterangan :
                                                                    Tambahkan
                                                                    Nama Jalan
                                                                    dan/atau Nama Gang atau Nomor Rumah
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="rt_tanah">RT Tanah<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="rt_tanah" name="rt_tanah" placeholder="Masukkan rt tanah" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="rw_tanah">RW Tanah<span class="text-danger"> *)</span></label>
                                                            <input class="form-control" type="text" id="rw_tanah" name="rw_tanah" placeholder="Masukkan rw tanah" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kode_kecamatan_tanah">Kode Kecamatan Tanah<span class="text-danger"> *)</span></label>
                                                            <select name="kode_kecamatan_tanah" id="kode_kecamatan_tanah" class="form-control select2">
                                                                <option value="" selected>Pilih Salah Satu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kode_kelurahan_tanah">Kode Kelurahan Tanah<span class="text-danger"> *)</span></label>
                                                            <select name="kode_kelurahan_tanah" id="kode_kelurahan_tanah" class="form-control select2">
                                                                <option value="" selected>Pilih Salah Satu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="kbli_kegiatan">Kegiatan yang diajukan<span class="text-danger"> *)</span></label>
                                                            <input type="text" name="kbli_kegiatan" id="kbli_kegiatan" class="form-control" placeholder="Masukkan kegiatan yang diajukan" value="<?= @$kegiatan ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="status_tanah">Status Tanah<span class="text-danger"> *)</span></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered" id="list-table-status" style="width: 100%;">
                                                                    <thead>
                                                                        <td style="width: 25%;">Status</td>
                                                                        <td style="width: 25%;">No. Sertifikat
                                                                        </td>
                                                                        <td style="width: 25%;">Luas Tanah
                                                                            (m<sup>2</sup>)
                                                                        </td>
                                                                        <td style="width: 20%;">Atas Nama</td>
                                                                        <td style="width: 5%;">Aksi</td>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-default add-list-status"><i class="fa fa-plus"></i> Tambah status tanah</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Dokumen Persyaratan -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="block">
                                            <div class="block-header bg-gd-dusk">
                                                <h3 class="block-title text-white">3. Dokumen Persyaratan</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php foreach ($dokumen as $row) : ?>
                                                            <?php if ($row->jenis == "1") : ?>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="dok"><?= $row->nama ?> <span class="text-danger"> *)</span></label>
                                                                    </div>
                                                                </div>
                                                                <div class="upload-section" id="uploadSection<?= $row->id ?>">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-8">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">Upload</span>
                                                                                </div>
                                                                                <div class="custom-file">
                                                                                    <input type="file" name="file<?= $row->id ?>" class="custom-file-input" id="inputGroupFile<?= $row->id ?>" accept="<?= $row->eks ?>">
                                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                    <br>
                                                                                </div>
                                                                            </div>
                                                                            <label class="text-primary">Ekstensi : <?= $row->eks ?> <br>Ukuran Dok : maks. 10 mb</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <label for="text" class="col-form-label"><?= $row->pertanyaan ?></label>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="custom-control custom-radio">
                                                                                            <input type="radio" class="custom-control-input" id="customRadio<?= $row->id ?>_yes" name="upload_option_<?= $row->id ?>" value="yes" onclick="toggleUploadSection('<?= $row->id ?>')">
                                                                                            <label class="custom-control-label" for="customRadio<?= $row->id ?>_yes">Ya</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="custom-control custom-radio">
                                                                                            <input type="radio" class="custom-control-input" id="customRadio<?= $row->id ?>_no" name="upload_option_<?= $row->id ?>" value="no" onclick="toggleUploadSection('<?= $row->id ?>')">
                                                                                            <label class="custom-control-label" for="customRadio<?= $row->id ?>_no">Tidak</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="upload-section" id="uploadSection<?= $row->id ?>" style="display:none;"> <!-- Menambahkan ID untuk upload section -->
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text">Upload</span>
                                                                                        </div>
                                                                                        <div class="custom-file">
                                                                                            <input type="file" name="file<?= $row->id ?>" class="custom-file-input" id="inputGroupFile<?= $row->id ?>" accept="<?= $row->eks ?>">
                                                                                            <label class="custom-file-label" for="inputGroupFile<?= $row->id ?>">Choose file</label>
                                                                                            <br>
                                                                                        </div>
                                                                                    </div>
                                                                                    <label class="text-primary">Ekstensi : <?= $row->eks ?> <br>Ukuran Dok : maks. 10 mb</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Kondisi Situasi Lokasi -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="block">
                                            <div class="block-header bg-gd-dusk">
                                                <h3 class="block-title text-white">4. Kondisi Situasi Lokasi</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label class="col-form-label">Lokasi</label>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped" id="list-table-foto" style="width: 100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <td style="width: 45%;">Jenis Foto</td>
                                                                        <td style="width: 50%;">Berkas Foto
                                                                        </td>
                                                                        <td style="width: 5%;">Aksi</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn-default add-list-foto"><i class="fa fa-plus"></i> Tambah foto lokasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="block-content mb-4">
                                            <button type="submit" form="add-form" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
    <footer id="page-footer" class="opacity-0">
        <div class="content py-20 font-size-xs clearfix">
            <div class="float-right">
            </div>
            <div class="float-left">
                <a class="font-w600" href="#"></a> &copy; Sistem Informasi PU Terpadu
            </div>
        </div>
    </footer>
    <!-- END Footer -->
    </div>

    <!-- Page JS Plugins -->
    <script src="<?= base_url('assets') ?>/js/plugins/amcharts4/core.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/amcharts4/charts.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/amcharts4/themes/material.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/amcharts4/themes/animated.js"></script>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script src="<?= base_url('assets') ?>/js/core/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/core/jquery.scrollLock.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/core/jquery.appear.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/core/jquery.countTo.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/core/js.cookie.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/codebase.js"></script>

    <!-- Page JS Plugins -->
    <script src="<?= base_url('assets') ?>/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- Page JS Code -->
    <script src="<?= base_url('assets') ?>/js/pages/be_forms_wizard.js"></script>

    <!-- Page JS Plugins -->
    <!-- <script src="<?= base_url() ?>_assets_front/js/leaflet.js"></script> -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    <script src="<?= base_url('assets') ?>/js/plugins/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/select2/select2.full.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/select2/i18n/id.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/leaflet.measure.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuidv4.min.js"></script>

    <!-- Page JS Code -->
    <script src="<?= base_url('assets') ?>/js/pages/be_pages_dashboard.js"></script>

    <script>
        window.ref_foto = <?= json_encode($ref_foto) ?>;
        window.id_pengajuan = null;
        window.dokumen_persyaratan = <?= json_encode($dokumen) ?>;

        var temp_array_of_foto_id = [];
        var list_table_foto = $('#list-table-foto');

        var temp_array_of_status_id = [];
        var list_table_status = $('#list-table-status');

        function toggleUploadSection(index) {
            var uploadSection = document.getElementById('uploadSection' + index);
            var yesRadio = document.getElementById('customRadio' + index + '_yes');
            if (yesRadio.checked) {
                uploadSection.style.display = 'block'; // Menampilkan upload section jika radio button "Ya" dipilih
            } else {
                uploadSection.style.display = 'none'; // Menyembunyikan upload section jika radio button "Tidak" dipilih
            }
        }

        // Panggil fungsi toggleUploadSection() untuk menyembunyikan upload section saat halaman dimuat
        // document.addEventListener("DOMContentLoaded", function() {
        //     <?php foreach ($dokumen as $row) : ?>
        //         toggleUploadSection('<?= $row->id ?>');
        //     <?php endforeach; ?>
        // });

        $('.add-list-foto').on('click', (e) => {
            let tbody = list_table_foto.find('tbody');
            let id = uuidv4();
            temp_array_of_foto_id.push(id);
            let tr = $('<tr>', {
                id: `tr-${id}`
            });

            // jenis foto
            let select = $('<select>', {
                class: 'form-control ref_foto_id'
            });
            for (const i of ref_foto) {
                select.append(new Option(i.keterangan, i.id));
            }
            tr.append($('<td>', {
                html: select.prop('outerHTML')
            }));

            // file
            tr.append($('<td>', {
                html: `<input type="file" class="form-control foto" accept="image/png,image/jpg,image/jpeg" required><span class="text-primary">png/jpg/jpeg maks 2Mb</span>`
            }));

            // aksi
            tr.append($('<td>', {
                html: `<button class="btn btn-danger delete-list" data-id="${id}" type="button"><i class="fa fa-trash" data-id="${id}"></i></button>`
            }));
            tbody.append(tr.prop('outerHTML'));
            return;
        });

        // list table action
        list_table_foto.on('click', '.delete-list', (e) => {
            list_table_foto.find(`#tr-${e.target.dataset.id}`).remove();
            temp_array_of_foto_id = temp_array_of_foto_id.filter(o => {
                return o != e.target.dataset.id;
            });
            return;
        });
        // END list table action

        // collect data foto lokasi
        const get_data_list_foto = () => {
            var data = [];
            let tbody = list_table_foto.find('tbody');
            for (const [k, i] of Object.entries(temp_array_of_foto_id)) {
                let tr = tbody.find(`#tr-${i}`);
                let row = {
                    'id': i,
                    'ref_foto_id': tr.find('.ref_foto_id').val(),
                    'index': k
                };

                let find_ket = ref_foto.find(o => {
                    return o.id == tr.find('.ref_foto_id').val();
                });
                if (typeof find_ket != 'undefined') row['nama_foto'] = find_ket.keterangan;
                else row['nama_foto'] = null;

                let fileInput = tr.find('.foto')[0];
                if (fileInput && fileInput.files.length > 0) {
                    row['file'] = fileInput.files[0];
                }

                data.push(row);
            }
            return data;
        }
        // END: collect data foto lokasi

        // try submit
        function submit_foto() {
            var data = new FormData();
            let foto = get_data_list_foto();
            foto.forEach((item) => {
                if (item.file) {
                    data.append(`foto_lokasi_${item.index}`, item.file);
                }
            });
            data.append('foto', JSON.stringify(foto.map(({id, ref_foto_id, index}) => ({id, ref_foto_id, index}))));

            $.ajax({
                url: "<?= base_url('peta/simpan-foto-lokasi') ?>",
                type: 'POST',
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: () => {

                },
                success: (res) => {
                    console.log(res);
                },
                error: ({
                    status,
                    responseJSON
                }) => {
                    console.log('server error');
                },
            });
        };

        // STATUS TANAH
        function set_val_status() {
            if (id_pengajuan != null) {
                let tbody = list_table_status.find('tbody');
                for (const i of status_tanah) {
                    temp_array_of_status_id.push(i.id);
                    let tr = $('<tr>', {
                        id: `tr-${i.id}`
                    });

                    // status
                    tr.append($('<td>', {
                        // html: `<input type="text" class="form-control status" value="${i.status}">`
                        html: `<select type="text" class="form-control status">
                            <option value="">-- Pilih Status Tanah --</option>
                            <option value="HP" ${i.status=='HP' ? 'selected':''}>HP</option>
                            <option value="HM" ${i.status=='HM' ? 'selected':''}>HM</option>
                            <option value="HGB" ${i.status=='HGB' ? 'selected':''}>HGB</option>
                            <option value="Letter C" ${i.status=='Letter C' ? 'selected':''}>Letter C</option>
                            <option value="Sewa" ${i.status=='Sewa' ? 'selected':''}>Sewa</option>
                        </select>`
                    }));

                    // nomor_sertifikat
                    tr.append($('<td>', {
                        html: `<input type="text" class="form-control nomor_sertifikat" value="${i.nomor_sertifikat}">`
                    }));

                    // luas_tanah
                    tr.append($('<td>', {
                        html: `<input type="text" class="form-control luas_tanah" value="${i.luas_tanah}">`
                    }));

                    // atas_nama
                    tr.append($('<td>', {
                        html: `<input type="text" class="form-control atas_nama" value="${i.atas_nama}">`
                    }));

                    // aksi
                    tr.append($('<td>', {
                        html: `<button class="btn btn-danger delete-list" data-id="${i.id}" type="button"><i class="fa fa-trash" data-id="${i.id}"></i></button>`
                    }));
                    tbody.append(tr.prop('outerHTML'));
                }
            }
        }

        $('.add-list-status').on('click', (e) => {
            let tbody = list_table_status.find('tbody');
            let id = uuidv4();
            temp_array_of_status_id.push(id);
            let tr = $('<tr>', {
                id: `tr-${id}`
            });

            // status
            tr.append($('<td>', {
                // html: `<input type="text" class="form-control status">`
                html: `<select type="text" class="form-control status">
                    <option value="">-- Pilih Status Tanah --</option>
                    <option value="HP">HP</option>
                    <option value="HM">HM</option>
                    <option value="HGB">HGB</option>
                    <option value="Letter C">Letter C</option>
                    <option value="Sewa">Sewa</option>
                </select>`
            }));

            // nomor_sertifikat
            tr.append($('<td>', {
                html: `<input type="text" class="form-control nomor_sertifikat">`
            }));

            // luas_tanah
            tr.append($('<td>', {
                html: `<input type="text" class="form-control luas_tanah">`
            }));

            // atas_nama
            tr.append($('<td>', {
                html: `<input type="text" class="form-control atas_nama">`
            }));

            // aksi
            tr.append($('<td>', {
                html: `<button class="btn btn-danger delete-list" data-id="${id}" type="button"><i class="fa fa-trash" data-id="${id}"></i></button>`
            }));
            tbody.append(tr.prop('outerHTML'));
            return;
        });

        // list table action
        list_table_status.on('click', '.delete-list', (e) => {
            list_table_status.find(`#tr-${e.target.dataset.id}`).remove();
            temp_array_of_status_id = temp_array_of_status_id.filter(o => {
                return o != e.target.dataset.id;
            });
            return;
        });
        // END list table action

        // collect data status tanah
        const get_data_list_status = () => {
            var data = [];
            let tbody = list_table_status.find('tbody');
            for (const i of temp_array_of_status_id) {
                let tr = tbody.find(`#tr-${i}`);
                let row = {
                    'id': i,
                    'status': tr.find('.status').val(),
                    'nomor_sertifikat': tr.find('.nomor_sertifikat').val(),
                    'luas_tanah': tr.find('.luas_tanah').val(),
                    'atas_nama': tr.find('.atas_nama').val()
                };
                data.push(row);
            }
            return data;
        }
        // END: collect data status tanah

        // try submit
        function submit_status() {
            var data = new FormData();
            let status = get_data_list_status();
            data.append('status', JSON.stringify(status));
            $.ajax({
                url: '<?= base_url('peta/simpan-status-tanah') ?>',
                type: 'POST',
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: () => {

                },
                success: (res) => {
                    console.log(res);
                },
                error: ({
                    status,
                    responseJSON
                }) => {
                    console.log('server error');
                },
            });
        };
        // try submit
        // END STATUS TANAH

        $(".custom-file-input").on("change", function() {
            let fileName = $(this).val().split("\\").pop();
            $(this)
                .siblings(".custom-file-label")
                .addClass("selected")
                .html(fileName);
        });

        // SUBMIT ALL FORM
        $("#add-form").on("submit", function(e) {
            e.preventDefault();
            let missingPhotos = [];
            ref_foto.forEach((photo) => {
                if (photo.is_required == 1) {
                    if ($(`.ref_foto_id option:selected[value="${photo.id}"]`).parent().length === 0)
                        missingPhotos.push(photo.keterangan);
                    else {
                        let selectsWithPhotoId = $(`.ref_foto_id option:selected[value="${photo.id}"]`).closest(".ref_foto_id");
                        selectsWithPhotoId.each(function () {
                            let fileInput = $(this)
                                .closest("tr")
                                .find('input[type="file"]');
                            if (fileInput.length === 0 || fileInput[0].files.length === 0) {
                                missingPhotos.push(photo.keterangan);
                            }
                        });
                    }
                }
            });

            if (missingPhotos.length > 0 && id_pengajuan == null) {
                Swal.fire({
                    icon: "error",
                    title: "",
                    html: "Silakan lengkapi foto:<br>" + missingPhotos.join(";<br>"),
                    showConfirmButton: true,
                    confirmButtonText: 'Lengkapi',
                }).then(() => {
                    
                });
                return false; // Stop form submission
            } else{
                // init form
                var data_add_form = new FormData(this);
    
                // status tanah
                var append_status_tanah = get_data_list_status();
                data_add_form.append("status_tanah", JSON.stringify(append_status_tanah));
    
                // dokumen persyaratan
                for (const i of dokumen_persyaratan) {
                    data_add_form.delete(`upload_option_${i.id}`);
                    let option_value = typeof $(`input[name="upload_option_${i.id}"]:checked`).val() != "undefined" ? $(`input[name="upload_option_${i.id}"]:checked`).val() : "";
                    data_add_form.append(`upload_option_${i.id}`, option_value);
    
                    let fileInput = $(`#customFile${i.id}`)[0];
                    if (fileInput && fileInput.files.length > 0) {
                        data_add_form.delete(`file${i.id}`);
                        data_add_form.append(`file${i.id}`, fileInput.files[0]);
                    }
                }

                // foto lokasi
                let foto = get_data_list_foto();
                foto.forEach((item) => {
                    if (item.file) {
                        data_add_form.append(`foto_lokasi_${item.index}`, item.file);
                    }
                });
                data_add_form.append("foto",
                    JSON.stringify(
                        foto.map(({ id, ref_foto_id, nama_foto, index }) => ({
                            id,
                            ref_foto_id,
                            nama_foto,
                            index,
                        }))
                    )
                );
                
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    data: data_add_form,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: "Mohon Tunggu ...",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                }).then((res)=>{
                    if(res.status===true){
                        Swal.fire({
                            icon: "success",
                            title: "",
                            html: res.message,
                            showConfirmButton: true,
                            confirmButtonText: 'Selesai',
                        }).then(() => {
                            window.close();
                        });
                    } else{
                        Swal.fire({
                            icon: "error",
                            title: "",
                            text: res.message,
                            showConfirmButton: true,
                            confirmButtonText: 'Ulangi',
                        }).then(() => {
                            
                        });
                    }
                }).fail((xhr)=>{
                    Swal.fire({
                        icon: "error",
                        title: "",
                        text: xhr.responseJSON.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Ulangi',
                    }).then(() => {
                        
                    });
                });
            }

        });
        // END SUBMIT ALL FORM
    </script>
    <script>
        $(".select2").select2({
            width: '100%',
        })

        jQuery(function() {
            // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
            Codebase.helpers(['colorpicker']);
        });
    </script>

    <script>
        var all_wilayah_tegal = <?= json_encode($all_tegal) ?>;
        var temp_wilayah_pemohon = [];
        $(() => {
            set_ref_kecamatan_tanah();
        });
        $("#kode_kabupaten_pemohon").on("change", (e) => {
            let data = new FormData();
            data.append("kode_kab", e.target.value);
            $.ajax({
                url: `<?= base_url() ?>peta/get_kecamatan_filtered`,
                type: "POST",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: () => {
                    temp_wilayah_pemohon = [];
                    $("#kode_kecamatan_pemohon").val("").trigger("change");
                    $("#kode_kelurahan_pemohon").val("").trigger("change");
                },
                success: (res) => {
                    temp_wilayah_pemohon = res.data;
                    set_ref_kecamatan_pemohon();
                },
                error: ({
                    status,
                    responseJSON
                }) => {},
            });
            return;
        });

        const set_ref_kecamatan_pemohon = () => {
            let kec = temp_wilayah_pemohon.filter((o) => {
                return o.id_level_wilayah === '3';
            });
            let select = $("#kode_kecamatan_pemohon");
            select.select2({
                width: "100%",
            });
            select.empty();
            select.append(new Option("Pilih Salah Satu", ""));
            for (const i of kec) {
                select.append(new Option(i.nama, i.kode_bersih));
            }

            select.trigger("change");

            return;
        };

        $("#kode_kecamatan_pemohon").on("change", (e) => {
            let kel = [];
            if (e.target.value != "") {
                kel = temp_wilayah_pemohon.filter((o) => {
                    return (
                        o.kode_bersih.includes(e.target.value) &&
                        o.id_level_wilayah === '4'
                    );
                });
            }
            let select = $("#kode_kelurahan_pemohon");
            select.select2({
                width: "100%",
            });
            select.empty();
            select.append(new Option("Pilih Salah Satu", ""));
            for (const i of kel) {
                select.append(new Option(i.nama, i.kode_bersih));
            }

            select.trigger("change");
            return;
        });

        const set_ref_kecamatan_tanah = () => {
            let kec = all_wilayah_tegal.filter((o) => {
                return o.id_level_wilayah === '3';
            });
            let select = $("#kode_kecamatan_tanah");
            select.select2({
                width: "100%",
            });
            for (const i of kec) {
                select.append(new Option(i.nama, i.kode_bersih));
            }
            return;
        };

        $("#kode_kecamatan_tanah").on("change", (e) => {
            let kel = all_wilayah_tegal.filter((o) => {
                return (
                    o.kode_bersih.includes(e.target.value) && o.id_level_wilayah === '4'
                );
            });
            let select = $("#kode_kelurahan_tanah");
            select.select2({
                width: "100%",
            });
            select.empty();
            select.append(new Option("Pilih Salah Satu", ""));
            for (const i of kel) {
                select.append(new Option(i.nama, i.kode_bersih));
            }
            return;
        });
    </script>

    <script>
        $(()=>{
            $('#nav-item-identitas').hide();
        });

        $('#form-auth-krk').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: () => {
                    Swal.fire({
                        title: "Mohon Tunggu ...",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
            }).then((res)=>{
                if(res.status===true){
                    Swal.fire({
                        icon: "success",
                        title: "",
                        html: res.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Lanjut',
                    }).then(() => {
                        $('input[name="auth_token"]').val(res.auth_callback.token);
                        $('#nav-item-auth').hide();
                        $('#nav-item-identitas').show();
                        $('a[href="#tabs-form"]').trigger('click');
                    });
                } else{
                    Swal.fire({
                        icon: "error",
                        title: "",
                        text: res.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Ulangi',
                    }).then(() => {
                        
                    });
                }
            }).fail((xhr)=>{
                console.log(xhr.responseJSON);
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: xhr.responseJSON.message,
                    showConfirmButton: true,
                    confirmButtonText: 'Ulangi',
                }).then(() => {
                    
                });
            });
        });
    </script>
</body>

</html>