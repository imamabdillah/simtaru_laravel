<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">

        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title">
                    <i class="si si-map text-body-bg-dark mr-2 font-size-sm"></i>
                    Referensi Ikon Peta
                </h3>

                <button id="btn_tambah_icon" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-icon"><i class="fa fa-plus"></i> Tambah Ikon Peta</button>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th style="text-align: center">Ikon</th>
                            <th style="text-align: center">Nama Ikon Peta</th>
                            <th style="text-align: center;width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<form id="form_icon" enctype="multipart/form-data">
    <div class="modal fade" id="modal-icon" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Ikon Peta</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- content -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <input type="hidden" name="id_icon">
                        <div class="form-group row">
                            <label class="col-12" for="nama_icon">Nama Ikon Peta</label>
                            <div class="col-md-12">
                                <input required type="text" class="form-control" id="nama_icon" name="nama_icon" placeholder="Masukkan nama ikon" pattern="[a-z0-9_]+">
                            </div>
                            <div style="font-size: smaller; margin-left: 20px;">
                                * Bersifat unik dan hanya huruf kecil ( a-z ), angka dan underscore ( _ ) yang diperbolehkan, contoh: rusunawa, rusunawa2, sebaran_sma
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="nama_icon">OPD</label>
                            <div class="col-md-12">
                                <select name="id_opd" id="id_opd" class="form-control">
                                    <?php foreach ($data_opd as $k => $v): ?>
                                        <?php if ($v['id_opd'] == $this->session->userdata('id_opd')): ?>
                                            <option value="<?= $v['id_opd'] ?>" selected><?= $v['nama_opd'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $v['id_opd'] ?>"><?= $v['nama_opd'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="file_icon">File Ikon</label>
                            <div class="col-md-12">
                                <input required type="file" class="form-control" id="file_icon" name="file_icon">
                            </div>
                            <div style="font-size: smaller; margin-left: 20px;">
                                * Hanya file .png yang diperbolehkan.
                            </div>
                        </div>

                        <!-- end content -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-ubah-icon">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END Pop In Modal -->