<style>
.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
    border: 1px solid #dcdfe3;
}
.select2-selection__arrow {
    height: 34px !important;
}
</style>
<main id="main-container">
    <div class="content">
        <button id="btn_tambah_layer" type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah">
            <i class="fa fa-plus mr-5"></i>Tambah Layer RTRW
        </button>
        <button id="btn_tambah_grup_layer" type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah">
            <i class="fa fa-plus mr-5"></i>Tambah Grup Layer RTRW
        </button>

        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Manajemen Layer Rencana Tata Ruang Wilayah</h3>
            </div>
            <div class="block-content">
                <table id="table_layer" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center">Nama Layer</th>
                            <th style="text-align: center">Grup Layer</th>
                            <th style="text-align: center">OPD</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="item_layer"></tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Pop In Modal Tambah Layer -->
<div class="modal fade" id="modal_layer" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin modal-md" role="document">
        <div class="modal-content">
            <form id="form_tambah_layer" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Form Layer Rencana Tata Ruang Wilayah</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="mb-10">
                        <label for="nama_layer">Nama Layer* 
                            <span id="cek_nama_loader" class="mr-20">
                            <svg  style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                            <span style="font-size: smaller; font-weight: normal;">Sedang memeriksa nama layer...</span>
                            </span>

                        </label>
                        <input type="text" name="nama_layer" class="form-control" required>
                        <p id="info_nama_layer" style="font-size: smaller;"></p>
                    </div>
                    <div class="mb-10">
                        <label for="grup_layer">Grup Layer* 
                            <svg id="grup_loader" style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                        </label>
                        <select name="grup_layer" class="form-control" style="width:100% !important;" required>
                            <option value="" disabled selected>Loading Grup Layer...</option>
                        </select>
                    </div>
                    <div class="mb-10">
                        <label for="opd_layer">OPD* 
                            <svg id="opd_loader" style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                        </label>
                        <select name="opd_layer" class="form-control" style="width:100% !important;" required>
                            <option value="" disabled selected>Loading OPD...</option>
                        </select>
                    </div>
                    <div class="mb-30">
                        <label for="geojson_layer">Upload Geojson*</label>
                        <input type="file" name="geojson_layer" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="simpan_loader" class="mr-20">
                <svg  style="margin-bottom:-5px;" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ring"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.base}}" ng-attr-stroke-width="{{config.width}}" fill="none" r="30" stroke="#d6eff9" stroke-width="10"></circle><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-width="{{config.innerWidth}}" ng-attr-stroke-linecap="{{config.linecap}}" fill="none" r="30" stroke="#63cff3" stroke-width="10" stroke-linecap="square" transform="rotate(323.411 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform><animate attributeName="stroke-dasharray" calcMode="linear" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1" dur="1" begin="0s" repeatCount="indefinite"></animate></circle></svg>
                <span>Sedang menyimpan layer, harap tunggu...</span>
                </span>
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button id="simpan_layer" type="submit" class="btn btn-alt-success">Simpan</button>
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
                    <h3 class="block-title">Form Tambah Grup Layer RTRW</h3>
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