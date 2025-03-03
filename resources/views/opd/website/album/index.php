<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content"> 
        
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Data Album Per-Kecamatan</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-square btn-secondary mr-5 mb-5" onclick="show_modal_tambah()"><i class="fa fa-plus mr-5"></i>Tambah Foto</button>
                </div>
            </div>
            <div class="block-content" id="tampil_kecamatan">

            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
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
                            <label class="col-12" for="nama_opd">Kecamatan</label>
                            <div class="col-md-12">
                                <select class="form-control select2" id="id_kecamatan" name="id_kecamatan">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="nama_opd">Nama Foto</label>
                            <div class="col-md-12">
                                <input required type="text" class="form-control" id="nama_foto" name="nama_foto" placeholder="Masukkan Keterangan Singkat Foto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="nama_opd">Foto</label>
                            <div class="col-md-12">
                                <input required type="file" class="form-control" id="file" name="file">
                            </div>
                        </div>
                        
                        <!-- end content -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <a href="javascript:;" type="submit" class="btn btn-alt-success" id="tombol_simpan" onclick="tombol_simpan()"><i class="fa fa-check"></i> Simpan </a>
                </div>
            </div>
        </div>
    </div>
</form>
