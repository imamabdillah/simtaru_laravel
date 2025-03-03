
<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
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
        <link rel="shortcut icon" href="<?= base_url('assets') ?>_front/images/favicon.ico"/>
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

        <!-- Dropzone -->
        <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/dropzonejs/min/dropzone.min.css">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?= base_url('assets') ?>/js/plugins/magnific-popup/magnific-popup.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        

        <script src="<?= base_url('assets') ?>/js/core/jquery.min.js"></script>
    </head>
    <body
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed page-header-modern main-content-boxed">
        </div>
<!-- END Sidebar Scroll Container -->
</nav>
<style>
    #data_per_layer{
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
    #data_per_halaman_detail
    {
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
                    <li class="nav-item">
                        <a class="nav-link active" href="#tabs-login">Detail</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#tabs-form">Form Identitas</a>
                    </li> 
                </ul>
                <div class="block-content tab-content overflow-hidden">
                    <div class="tab-pane fade fade-left show active" id="tabs-login" role="tabpanel">
                        
                        <!-- <?php print_r($this->session->userdata()) ?> -->
                        <form class="js-validation-signin col-6 m-auto" action="<?= base_url('auth/login/auth_krk') ?>" method="post">
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

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="login-username">Username</label>
                                            <input type="text" class="form-control" id="login-username" name="username">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="login-password">Password</label>
                                            <input type="password" class="form-control" id="login-password" name="password">
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
                                            <a href="https://ministry.phicos.co.id/tegal-krk/register/pemohon" class="btn btn-alt-success">
                                                <i class="si si-action-undo mr-10"></i> Registrasi
                                            </a> 
                                        </div>
                                        <div class="col-sm-2 text-sm-right push"> 
                                            <button type="submit" class="btn btn-alt-primary">
                                                <i class="si si-login mr-10"></i> Sign In
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
                        <form class="js-validation-signin m-auto" action="<?= base_url('peta/store_krk') ?>" method="post">
                        <div>
                                <!-- <form> -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="my-0 text-primary">Identitas Pemohon</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input" class="col-md-4 col-form-label">Nama Pemohon 1 *</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text" placeholder="Masukkan nama pemohon 1" id="nama_pemohon_1" name="nama_pemohon_1" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-nama_pemohon_1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-4 col-form-label">Nama Pemohon 2</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text" placeholder="Masukkan nama pemohon 2" id="nama_pemohon_2" name="nama_pemohon_2">
                                                                <label for=""><span class="text-primary"><b>*)</b> Keterangan : Jika Nama Pemohon lebih dari dua maka dituliskan Nama Pemohon dan CS.</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-nama_pemohon_2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-4 col-form-label">NIK
                                                                Pemohon
                                                                1 *</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control nik_1" type="number"
                                                                    placeholder="Masukkan nik pemohon 1" id="nik_pemohon_1"
                                                                    name="nik_pemohon_1" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-nik_pemohon_1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-4 col-form-label">NIK Pemohon 2</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="number" placeholder="Masukkan nik pemohon 2" id="nik_pemohon_2" name="nik_pemohon_2">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-nik_pemohon_2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-2 col-form-label">No HP Pemohon *</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text" placeholder="08xx ......" id="hp_pemohon" name="hp_pemohon" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-2">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-hp_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-2">
                                                            <label for="example-text-input" class="col-md-2 col-form-label">Alamat Pemohon *</label>
                                                            <div class="col-md-8">
                                                                <textarea name="alamat_pemohon" id="alamat_pemohon" rows="3" class="form-control" placeholder="Masukkan alamat pemohon" required></textarea>
                                                                <label for="text"><span class="text-primary"><b>*)</b> Keterangan : Tambahkan Nama Jalan dan/atau Nama Gang atau Nomor Rumah</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-2">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-alamat_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-4 col-form-label">RT Pemohon *</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" id="rt_pemohon" name="rt_pemohon" placeholder="Masukkan RT" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-rt_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-4 col-form-label">RW Pemohon *</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" id="rw_pemohon" name="rw_pemohon" placeholder="Masukkan RW" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-rw_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- kabupaten -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-2 col-form-label">Kabupaten/Kota *</label>
                                                            <div class="col-md-4">
                                                                <select name="kode_kabupaten_pemohon" id="kode_kabupaten_pemohon" class="form-control select2" required>
                                                                    <option value="" selected>Pilih Salah Satu
                                                                    </option>
                                                                    @foreach ($ref_kab as $row)
                                                                        <option value="{{ $row->kode_bersih }}">
                                                                            {{ "{$row->nama_propinsi} - {$row->nama}" }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-2">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-kode_kabupaten_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- kecamatan -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-2 col-form-label">Kecamatan *</label>
                                                            <div class="col-md-4">
                                                                <select name="kode_kecamatan_pemohon" id="kode_kecamatan_pemohon" class="form-control select2" required>
                                                                    <option value="" selected>Pilih Salah Satu
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-2">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-kode_kecamatan_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- kelurahan -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-md-2 col-form-label">Kelurahan *</label>
                                                            <div class="col-md-4">
                                                                <select name="kode_kelurahan_pemohon" id="kode_kelurahan_pemohon" class="form-control select2" required>
                                                                    <option value="" selected disabled>Pilih Salah
                                                                        Satu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-2">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div id="error-kode_kelurahan_pemohon"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </form> -->

                                <!-- <form> -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="my-0 text-primary">Informasi Tanah</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-2">
                                                            <div class="col-sm-2">
                                                                <label for="text"
                                                                    class="col-form-label">Lokasi</label>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div
                                                                    style="position: absolute; top: 10px ; right: 25px ;   z-index: 99999999999">
                                                                    <div class="text-right" style="margin-bottom: 5px;">
                                                                        <button type="button" id="btn-lokasi"
                                                                            class="btn btn-danger glow"
                                                                            style="width: 150px;">
                                                                            <i class="bx bx-map-pin"></i> Lokasi Anda
                                                                        </button>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="button" id="btn-reload"
                                                                            class="btn btn-success glow"
                                                                            style="width: 150px;">
                                                                            <i class="bx bx-sync"></i> Reload </button>
                                                                    </div>
                                                                </div>
                                                                <div id="chart-map"
                                                                    style="height: 500px; width: 100%; border: solid grey 2px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label for="text"
                                                                            class="col-form-label">Latitude *</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="latitude_tanah"
                                                                            class="form-control" id="latitude" value="<?= @$lat ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label for="text"
                                                                            class="col-form-label">Longitude *</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="longitude_tanah"
                                                                            class="form-control" id="longitude" lng value="<?= @$lng ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Lokasi
                                                                Tanah *</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text"
                                                                    placeholder="Masukkan lokasi tanah" id="lokasi_tanah"
                                                                    name="lokasi_tanah" required>
                                                                <label>
                                                                    <span class="text-primary">*) Keterangan :
                                                                        Tambahkan
                                                                        Nama Jalan
                                                                        dan/atau Nama Gang atau Nomor Rumah</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-4 col-form-label">RT
                                                                Tanah *</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text"
                                                                    placeholder="Masukkan rt tanah" id="rt_tanah"
                                                                    name="rt_tanah" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-4 col-form-label">RW
                                                                Tanah *</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text"
                                                                    placeholder="Masukkan rw tanah" id="rw_tanah"
                                                                    name="rw_tanah" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- kecamatan -->
                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Kecamatan Tanah *</label>
                                                            <div class="col-md-8">
                                                                <select name="kode_kecamatan_tanah"
                                                                    id="kode_kecamatan_tanah" class="form-control"
                                                                    style="width: 100%;" required>
                                                                    <option value="" selected>Pilih Salah Satu
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- kelurahan -->
                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Kelurahan Tanah *</label>
                                                            <div class="col-md-8">
                                                                <select name="kode_kelurahan_tanah"
                                                                    id="kode_kelurahan_tanah" class="form-control"
                                                                    style="width: 100%;" required>
                                                                    <option value="" selected disabled>Pilih
                                                                        Salah
                                                                        Satu
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Kegiatan yang
                                                                diajukan</label>
                                                            <div class="col-md-8">
                                                                <select name="ref_kbli_id" id="ref_kbli_id"
                                                                    class="form-control select2" multiple="">
                                                                    @foreach ($kbli as $row)
                                                                        <option value="{{ $row->id }}">
                                                                            {{ $row->kode }} -
                                                                            {{ $row->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row mt-3">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Status
                                                                Tanah</label>
                                                            <div class="col-md-10">
                                                                <div class="row table-responsive">
                                                                    <table class="table table-bordered"
                                                                        id="list-table-status" style="width: 100%;">
                                                                        <thead>
                                                                            <tr>
                                                                                <td style="width: 25%;">Status</td>
                                                                                <td style="width: 25%;">No. Sertifikat
                                                                                </td>
                                                                                <td style="width: 25%;">Luas Tanah
                                                                                    (m<sup>2</sup>)
                                                                                </td>
                                                                                <td style="width: 20%;">Atas Nama</td>
                                                                                <td style="width: 5%;">Aksi</td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="col-lg-12">
                                                                        <button type="button"
                                                                            class="btn btn-default add-list-status"><i
                                                                                class="fa fa-plus"></i> Tambah status
                                                                            tanah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-5">
                                                        <button type="submit" class="btn btn-alt-primary">
                                                            <i class="si si-login mr-10"></i> Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </form> -->
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

<!-- Page JS Plugins -->
<script src="<?= base_url('assets') ?>/js/plugins/amcharts4/core.js"></script>
<script src="<?= base_url('assets') ?>/js/plugins/amcharts4/charts.js"></script>
<script src="<?= base_url('assets') ?>/js/plugins/amcharts4/themes/material.js"></script>
<script src="<?= base_url('assets') ?>/js/plugins/amcharts4/themes/animated.js"></script><footer id="page-footer" class="opacity-0">
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
        <script src="<?= base_url() ?>_assets_front/js/leaflet.js"></script>

        <script src="<?= base_url('assets') ?>/js/plugins/chartjs/Chart.bundle.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/select2/select2.full.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/select2/i18n/id.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/sweetalert2/new.js"></script>
        <script src="<?= base_url('assets') ?>/js/leaflet.measure.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?= base_url('assets') ?>/js/pages/be_pages_dashboard.js"></script>


        <script>
            jQuery(function () {
                // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
                Codebase.helpers(['colorpicker']);
            });
        </script> 
        
        <script>
            var map;
            var basemap = {};
            var active_basemap = 'osm';
            var zoom = 13;
            var layers = {};
            var search_marker = '';
            var active_icons = {};
            var marker, circles;
            const xconfig = [];
            const xdata = [];
            const xalias = [];

            $(document).ready(function() {
                $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=-6.874440167384315&lon=109.10874898811036', function(data){
                    console.log(data.address.road);
                });
            });
            
            function init_map() {
                map = L.map('map', {
                    attributionControl: false,
                    zoomControl: false
                }).setView([-6.868354, 109.131658], zoom);

                basemap = {
                    osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }),
                    google_roadmap: L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    }),
                    google_satellite: L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    }),
                    google_hybrid: L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    }),
                    google_terrain: L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    }),
                    esri_world_imagery: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                        maxZoom: 17
                    }),
                    esri_world_street_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'),
                    esri_world_topo_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'),
                    esri_gray_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                        maxZoom: 17
                    }),
                    citra_satelit: L.esri.imageMapLayer({
                        url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/CITRASATELIT/JawaBaliNusra_2015_ImgServ1/ImageServer',
                        attribution: 'Badan Informasi Geospasial'
                    }),
                    peta_rbi: L.esri.dynamicMapLayer({
                        url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/IGD/RupabumiIndonesia/MapServer',
                        attribution: 'Badan Informasi Geospasial'
                    }),
                    peta_rbi_opensource: L.tileLayer.wms('http://palapa.big.go.id:8080/geoserver/gwc/service/wms', {
                        maxZoom: 20,
                        layers: "basemap_rbi:basemap",
                        format: "image/png",
                        attribution: 'Badan Informasi Geospasial'
                    })
                }

                basemap[active_basemap].addTo(map);
            }
        </script>
</body>
</html> 