<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>
<?php foreach($data_peta as $peta){ ?>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <?php if($header != 0){ ?>
        <!-- <h2 class="content-heading"></h2> -->
        <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah-data" data-toggle="modal" data-target="#modal-popin">
            <i class="fa fa-plus mr-5"></i> Tambah Data <span><?= $peta->nama_layer; ?></span>
        </button>
        <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah-data" data-toggle="modal" data-target="#modal-import">
            <i class="fa fa-upload mr-5"></i> Import Data <span><?= $peta->nama_layer; ?></span>
        </button>
        <button id="btn_import_template" type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah-data" data-toggle="modal" data-target="#modal-template">
            <i class="fa fa-file mr-5"></i> Template Geojson <span><?= $peta->nama_layer; ?></span>
        </button>
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-database"></i> Daftar Data "<b id="judul-sub-layer"><?= $peta->nama_layer; ?></b>"</h3>
            </div>
            <div class="block-content">
            <!-- Table start -->
            
            <table class="table table-striped" id="mydata" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 40px;">No</th>
                        <?php foreach ($header as $row) {
                            echo '<th  style="text-align: center;">'.$row->nama_atribut.'</th>';
                        }?>
                        <th style="text-align: center; width: 40px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>
            <!-- Table end -->
            </div>
        </div>
        <?php }else{ ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Mohon maaf</h4>
                    <p>Layer peta belum memiliki atribut</p>
                <hr>
                    <button type="button" class="btn btn-square btn-danger" onclick="window.location.href='<?= base_url('opd/peta/kelola/').$this->uri->segment(4); ?>'"><i class="fa fa-plus"></i> Buat atribut</button>
            </div>
        <?php } ?>
    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Buat Data <?= $peta->nama_layer; ?></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="tipe">Tipe Layer</label>
                        <div class="col-md-12">
                        <select required class="tipe form-control" id="tipe" name="tipe" style="width: 100%;">
                            <option value=""></option>
                            <option value="point">Point</option>
                            <option value="line">Line</option>
                            <option value="polygon">Polygon</option>
                        </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-alt-success btn-simpan">
                    <i class="fa fa-check"></i> Buat Data Baru
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->

<!-- modal import -->
<div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-import" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <form id="import_geojson">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Import data <?= $peta->nama_layer; ?></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <label for="import_geojson">Import Geojson</label>
                            <input type="file" name="import_geojson" class="form-control">
                            <input type="hidden" name="id_layer" value="<?=$this->uri->segment(4)?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="import_process" style="width:100%">
                    <svg  style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                    <span style="font-size: smaller; font-weight: normal;">Sedang memproses import data...</span>
                    </span>
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button id="btn_import" type="submit" class="btn btn-alt-success btn-import">
                        <i class="fa fa-upload"></i> Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal import -->

<!-- modal template -->
<div class="modal fade" id="modal-template" tabindex="-1" role="dialog" aria-labelledby="modal-template" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-lg" role="document">
        <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Template Geojson <?= $peta->nama_layer; ?></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div id="template_geojson" class="form-group row" style="padding:20px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                </div>
        </div>
    </div>
</div>
<!-- end modal template -->


<!-- modal foto -->
<div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="modal-template" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-lg" role="document">
        <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Album Foto <?= $peta->nama_layer; ?></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div id="template_geojson" class="form-group row" style="padding:20px">
                            <input type="hidden" name="id_collection" id="id_collection">
                            <div class="row items-push js-gallery img-fluid-100" id="form_tempat_foto">

                                <!-- Lokaso Foto Disini -->

                                <div class="form-group row ml-20" data-toggle="appear" data-offset="-200">
                                    <div class="dropzone" id="jaringan_jalan_block" action="<?= base_url('api/psu/upload_foto/do_upload');?>" method="post" style="min-width: 230px; height: 200px; "></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                </div>
        </div>
    </div>
</div>
<!-- end modal foto -->

<?php } ?>