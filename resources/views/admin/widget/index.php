<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
.no-wrap {
    white-space: nowrap;
}
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
                
        <div class="block block-themed">
            <div class="block-header bg-gd-sun">
                <h3 class="block-title">Manajeman Widget</h3>
                <button id="btn_tambah_widget" type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-widget"><i class="fa fa-plus"></i> Tambah Widget</button>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th style="text-align: center">Nama App</th>
                            <th style="text-align: center">Url API</th>
                            <th style="text-align: center">Url Peta</th>
                            <th style="text-align: center">Access Token</th>
                            <th style="text-align: center">API Token</th>
                            <th style="text-align: center">Pemohon</th>
                            <th style="text-align: center">OPD</th>
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
<form id="form_widget">
<div class="modal fade" id="modal-widget" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Widget</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <div class="col-12">
                            <!-- content -->
                            <div class="form-group row">
                                <label class="col-12" for="id_opd">OPD</label>
                                <div class="col-md-12">
                                    <select name="id_opd" id="id_opd" class="form-control">
                                        <?php foreach($data_opd as $k=>$v):?>
                                            <?php if($v['id_opd'] == $this->session->userdata('id_opd') && $this->session->userdata('role' != 1)):?>
                                                <option value="<?=$v['id_opd']?>" selected><?=$v['nama_opd']?></option>
                                            <?php else:?>
                                                <option value="<?=$v['id_opd']?>"><?=$v['nama_opd']?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_api_widget">
                            <div class="form-group row">
                                <label class="col-12" for="nama_pemohon">Nama Pemohon</label>
                                <div class="col-md-12">
                                    <input required type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Masukkan nama pemohon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="nama_app">Nama Aplikasi</label>
                                <div class="col-md-12">
                                    <input required type="text" class="form-control" id="nama_app" name="nama_app" placeholder="Masukkan nama aplikasi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="url_app">URL Widget API</label>
                                <div class="col-md-12">
                                    <input required type="text" class="form-control" id="url_app" name="url_app" placeholder="Masukkan url dimana widget akan dipasang">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="url_map">URL Widget Peta</label>
                                <div class="col-md-12">
                                    <input required type="text" class="form-control" id="url_map" name="url_map" placeholder="Masukkan url dimana widget akan dipasang">
                                </div>
                            </div>

                            <div id="reset_token_box" class="form-check row">
                                <div class="col-md-12">
                                    <input type="checkbox" class="form-check-input" id="reset_token" name="reset_token" value="true" title="Reset ulang Access Token & API Token.">
                                    <label class="col-12 form-check-label" for="reset_token">Reset Token</label>
                                </div>
                            </div>
                            
                            <!-- end content -->
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-widget">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- END Pop In Modal -->