<style>
    .err {
        padding: 0px;
        color: red;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #42a5f5;
        border: 1px solid #0088f6;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #ffffff;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <!-- First Row -->
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->

        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-plus mr-2" style="font-size: 14px;"></i> Tambah Permohonan API</h3>
            </div>

            <div class="block-content">
                <form id="form_api">
                    <div class="form-group row">
                        <label class="col-12" for="nama_pemohon">Nama Pemohon</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Masukkan nama pemohon" required>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="akses_layer">Akses Layer</label>
                        <div class="col-lg-12">
                            <select class="js-select2 form-control danger" id="akses_layer" name="akses_layer[]" style="width: 100%;" data-placeholder="Pilih Akses Layer" multiple>
                                <option></option>
                                <?php foreach ($data_layer as $v): ?>
                                    <option value="<?= $v['id_layer'] ?>"><?= $v['nama_layer'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12" style="text-align:right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Permohonan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->

        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-link mr-2" style="font-size: 14px;"></i> Daftar Permohonan API Layer Peta</h3>
            </div>

            <div class="block-content">
                <!-- Table start -->
                <table class="table table-bordered table-striped" id="mydata" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Pemohon</th>
                            <th style="text-align: center;">Token</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">API</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- Table end -->
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->

<!-- <script src="<?= base_url() ?>assets/js/pages/be_forms_plugins.js"></script> -->
<script>
    jQuery(function() {
        Codebase.helpers(['select2']);
    });
</script>