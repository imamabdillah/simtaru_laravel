<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">

        <div class="block block-themed">
            <div class="block-header bg-gd-sun">
                <h3 class="block-title">Data Prioritas Pembangunan</h3>
                <button type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah Prioritas Pembangunan</button>
            </div>
            <div class="block-content">
                <table class="table table-striped table-bordered" id="table-data" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 20%;">Gambar</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<div class="modal fade" id="modal-tambah" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Prioritas Pembangunan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                  <form id="form-tambah">
                    <!-- content -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="form-group row">
                        <label class="col-12" for="foto">Foto</label>
                        <div class="col-md-12">
                          <input type="file" name="foto" class="form-control" id="tambah-foto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="nama">Nama Prioritas Pembangunan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="tambah-nama" name="nama" placeholder="Masukkan nama prioritas pembangunan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="link">Link Peta</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="tambah-link" name="link" placeholder="Masukkan link peta" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12" for="nama_opd">Deskripsi Prioritas Pembangunan</label>
                        <div class="col-md-12">
                          <textarea name="deskripsi" class="form-control" id="tambah-deskripsi" rows="8" cols="80" placeholder="Masukkan deskripsi prioritas pembangunan" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <!-- end content -->
                  </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" form="form-tambah" class="btn btn-alt-success btn-ubah-opd">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ubah" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Ubah Prioritas Pembangunan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                  <form id="form-ubah">
                    <!-- content -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="form-group row">
                        <label class="col-12" for="foto">Foto</label>
                        <div class="col-md-12">
                          <input type="file" name="foto" class="form-control" id="ubah-foto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="nama">Nama Prioritas Pembangunan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="ubah-nama" name="nama" placeholder="Masukkan nama prioritas pembangunan" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="link">Link Peta</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="ubah-link" name="link" placeholder="Masukkan link peta" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12" for="nama_opd">Deskripsi Prioritas Pembangunan</label>
                        <div class="col-md-12">
                          <textarea name="deskripsi" class="form-control" id="ubah-deskripsi" rows="8" cols="80" placeholder="Masukkan deskripsi prioritas pembangunan" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <!-- end content -->
                  </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" form="form-ubah" class="btn btn-alt-success btn-ubah-opd">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->
