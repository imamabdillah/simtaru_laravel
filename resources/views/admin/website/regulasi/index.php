<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content"> 
        
        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title">
                <i class="fa fa-file text-body-bg-dark mr-2 font-size-sm"></i>
                Daftar Dokumen Regulasi
            </h3>
                <div class="block-options">
                    <button type="button" class="btn btn-primary btn-tambah" onclick="show_modal_tambah()"><i class="fa fa-plus mr-5"></i>Tambah Regulasi</button>
                </div>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width: 20px;">No.</th>
                            <th style="text-align: center;">Nama Regulasi</th>
                            <th style="text-align: center; width: 100px;">Tanggal Disahkan</th>
                            <th style="text-align: center; width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                         
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->


<!-- END Main Container -->
<form action="#" id="form_tambah" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- content -->
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" name="id_opd">
                        <div class="form-group row">
                            <label class="col-12" for="nama_opd">Nama Dokumen</label>
                            <div class="col-md-12">
                                <input required type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="nama_opd">Tanggal Disahkan</label>
                            <div class="col-md-12">
                                <input required type="date" class="form-control" id="tanggal_disahkan" name="tanggal_disahkan" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="nama_opd">Dokumen</label>
                            <div class="col-md-12">
                                <input required type="file" class="form-control" id="file" name="file">
                            </div>
                        </div>
                        
                        <!-- end content -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <a href="javascript:;" type="submit" class="btn btn-success" id="tombol_simpan" onclick="tombol_simpan()"><i class="fa fa-check"></i> Simpan </a>
                </div>
            </div>
        </div>
    </div>
</form>
