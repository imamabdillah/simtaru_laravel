<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <button id="btn_tambah_layer" type="button" class="btn btn-primary mr-5 mb-5" data-toggle="modal" data-target="#modal-popin">
            <i class="fa fa-plus mr-5"></i> Tambah Layer Peta
        </button>
        <button id="btn_tambah_grup_layer" type="button" class="btn btn-primary mr-5 mb-5 btn-tambah">
            <i class="fa fa-plus mr-5"></i>Tambah Grup Layer
        </button>
        <button type="button" class="btn btn-secondary mr-5 mb-5 btn-filter-layer">
            <i class="fa fa-sliders mr-5"></i> Filter Layer Peta
        </button>
        <!-- Div filter -->
        <div class="block block-themed div-filter" style="margin-top: 8px;">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-sliders"></i> Filter</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option block-cancel">
                        <i class="si si-close"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form id="form-filter">
                <!-- content -->
                <div class="form-group row">
                    <div class="col-2" style="padding-right:0px">
                        <label for="filter_nama">Nama Layer</label>
                        <input type="text" class="filter_nama form-control" id="filter_nama" name="filter_nama" style="width: 100%;" placeholder="Masukkan nama layer">
                    </div>
                    <div class="col-2" style="padding-right:0px">
                        <label for="filter_opd">Nama OPD</label>
                        <select class="filter_opd form-control" id="filter_opd" name="filter_opd" style="width: 100%;">
                            <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <?php
                                foreach ($daftar_opd->result() as $opd){
                                    echo "<option value=".$opd->id_opd.">".$opd->nama_opd."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-2" style="padding-right:0px">
                        <label for="filter_sumber">Sumber</label>
                        <select class="filter_sumber form-control" id="filter_sumber" name="filter_sumber" style="width: 100%;">
                            <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <option value="1">Database</option>
                            <!-- <option value="2">API Web Lain</option>
                            <option value="3">Upload GeoJSON</option> -->
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="rfilter_status">Status</label>
                        <select class="filter_status form-control" id="filter_status" name="filter_status" style="width: 100%;">
                            <option value=""></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <option value="1">Ditampilkan</option>
                            <option value="2">Disembuyikan</option>
                        </select>
                    </div>
                    <div class="col-2" style="padding-right:0px">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-block btn-primary btn-filter"><i class="fa fa-search mr-5"></i> Cari</button>                        
                    </div>
                    <div class="col-2">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-block btn-warning btn-reset"><i class="fa fa-refresh mr-5"></i> Reset</button>                        
                    </div>
                </div>
                <!-- content -->
                </form>
            </div>
        </div>
        <!-- end filter -->
        <div class="block block-themed" style="margin-top: 16px;">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="si si-map mr-2 font-size-sm"></i> Daftar Layer Peta</h3>
            </div>
            <div class="block-content">
            <!-- Table start -->
            <table class="table table-striped" id="mydata" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layer</th>
                        <th>Nama OPD</th>
                        <th>Sumber</th>
                        <th>Status</th>
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

<!-- Pop In Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="tambah_layer">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Layer Peta</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <div class="form-group row">
                            <label class="col-12" for="nama_layer">Nama Layer</label>
                            <div class="col-md-12">
                                <input required type="text" class="form-control" id="nama_layer" name="nama_layer" placeholder="Masukkan nama layer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="opd">Grup Layer</label>
                            <div class="col-md-12">
                            <select required class="form-control" id="grup_layer" name="grup_layer" style="width: 100%;"></select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="opd">Jenis Peta</label>
                            <div class="col-md-12">
                            <select required class="form-control" id="jenis_peta" name="jenis_peta" style="width: 100%;"></select>

                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-12" for="opd">Nama OPD</label>
                            <div class="col-md-12">
                            <select required class="opd form-control" id="opd" name="opd" style="width: 100%;">
                                <option value="" selected disabled>-- Pilih OPD --</option>
                                <?php
                                    foreach ($daftar_opd->result() as $opd){
                                        echo "<option value=".$opd->id_opd.">".$opd->nama_opd."</option>";
                                    }
                                ?>
                            </select>

                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-12" for="sumber">Sumber Data</label>
                            <div class="col-md-12">
                                <select class="sumber form-control" name="sumber" id="sumber" style="width: 100%;">
                                <option value="" disabled>-- Pilih OPD --</option>
                                    <option value="1" selected>Database</option>
                                    <option value="2">API</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="link_api_box" style="display:none;">
                            <label class="col-12" for="link_api">Link API</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="link_api" name="link_api" placeholder="Masukkan link API">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="opd">Deskripsi Layer</label>
                            <div class="col-md-12">
                            <textarea class="form-control" name="deskripsi_layer" id="deskripsi_layer" cols="30" rows="5"></textarea>

                            </div>
                        </div>
                        <!-- <div class="form-group row pengembangan">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                <strong><i class="fa fa-exclamation"></i></strong> Fitur ini masih dalam pengembangan.
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success btn-simpan">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->

<!-- Pop In Modal Tambah Grup Layer -->
<div class="modal fade" id="modal_grup_layer" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-md" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Form Tambah Grup Layer</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div>
                        <label for="nama_grup_layer">Nama Grup Layer</label>
                        <div class="input-group">
                            <input type="text" name="nama_grup_layer" class="form-control" placeholder="Masukkan nama grup layer...">
                            <div class="input-group-append">
                                <button id="btn_simpan_grup_layer" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah Grup
                                </button>
                            </div>
                        </div>
                    </div> 
                    <h5 class="mt-30">List Grup Layer</h5>
                    <div id="list_grup_layer" class="mb-20">
                    <svg id="list_grup_loader" style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                        <span>Sedang mengambil data grup layer...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <!-- <button id="simpan_grup_layer" type="button" class="btn btn-alt-success">Simpan</button> -->
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->

<!-- Pop In Modal Tambah Jenis Peta -->
<div class="modal fade" id="modal_jenis_peta" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-md" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Form Tambah Jenis Peta</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div>
                        <label for="nama_jenis_peta">Nama Jenis Peta</label>
                        <div class="input-group">
                            <input type="text" name="nama_jenis_peta" class="form-control" placeholder="Masukkan nama jenis peta...">
                            <div class="input-group-append">
                                <button id="btn_simpan_jenis_peta" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah Jenis Peta
                                </button>
                            </div>
                        </div>
                    </div> 
                    <h5 class="mt-30">List Jenis Peta</h5>
                    <div id="list_jenis_peta" class="mb-20">
                    <svg id="list_grup_loader" style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                        <span>Sedang mengambil data jenis peta...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <!-- <button id="simpan_jenis_peta" type="button" class="btn btn-alt-success">Simpan</button> -->
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->
