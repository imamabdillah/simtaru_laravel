<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }

    .group_container {
        padding: 5px;
    }

    .group_box {
        border: 3px dashed #dedede;
        padding: 5px;
        border-radius: 4px;
        background: #efefef;
    }

    .group_item {
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #dedede;
        margin-top: 3px;
        background: #ffffff;
        height: 40px !important;
    }

    .group_box {
        height: 400px;
        margin-bottom: 50px;
        overflow-y: auto;
    }

    /* The whole thing */
    #cmenu {
        display: none;
        z-index: 1000;
        position: absolute;
        overflow: hidden;
        border: 1px solid #CCC;
        white-space: nowrap;
        background: #FFF;
        color: #333;
        border-radius: 4px;
        padding: 5px;
        font-size: smaller;
        box-shadow: 0px 5px 5px #dedede;
    }

    #cmenu div {
        width: 70px;
        /* padding: 5px; */
        color: #777777;
        padding-left: 5px;
    }

    #cmenu div:hover {
        cursor: pointer;
        font-weight: bold;
        color: #ffffff;
        background: #777777;
    }

    .group_title_item:hover {
        cursor: pointer;
        color: #000000;
    }

    #loader_box {
        position: fixed;
        width: 100vw;
        height: 100vh;
        text-align: center;
        display: none;
        z-index: 2000;
        top: 0px;
        background: #ababab;
        opacity: 0.7;
    }

    #loader{
        position: absolute;
        top: 35vh;
        left: 35vw;
    }
</style>

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Grup Atribut "<b class="header_layer"></b>"</h3>
                <div class="block-options"></div>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-md-3 group_container">
                        <h5 style="text-align: center; color: #ababab">Judul Grup</h5>
                        <button id="btn_modal_grup" class="btn btn-success btn-block" style="margin-bottom: 10px"><i class="fa fa-plus"></i> Tambah Grup</button>
                        <div id="group_title" class="group_box" style="height: 356px"></div>
                    </div>
                    <div class="col-md-4 group_container">
                        <h5 style="text-align: center; color: #ababab">Item Grup</h5>
                        <div id="group_attribute" class="group_box" style="overflow-x:hidden"></div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <div style="margin-top: 220px">
                                <i class="fa fa-angle-double-left  text-success"></i> <span class="text-success" style="font-size: smaller">Tambah</span>
                            </div>
                            <div>
                                <span class="text-danger" style="font-size: smaller">Hapus</span> <i class="fa fa-angle-double-right text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 group_container">
                        <h5 style="text-align: center; color: #ababab">Atribut Layer</h5>
                        <div id="layer_attribute" class="group_box"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Pop In Modal -->
<div class="modal fade" id="modal_grup" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <form id="form_grup">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah Grup Atribut</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="col-12">
                            <label for="judul_grup">Judul Group</label>
                            <input name="judul_grup" type="text" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="sub_judul_grup">Sub Judul Group</label>
                            <textarea name="sub_judul_grup" id="sub_judul_grup" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="tipe_grup">Tipe Group</label>
                            <select name="tipe_grup" id="tipe_grup" class="form-control">
                                <option value="table">Tabel</option>
                                <option value="vertical_bar_chart">Vertical Bar Chart</option>
                                <option value="horizontal_bar_chart">Horizontal Bar Chart</option>
                                <option value="pie_chart">Pie Chart</option>
                                <option value="doughnut_chart">Doughnut Chart</option>
                                <option value="radar_chart">Radar Chart</option>
                            </select>
                        </div>
                        <div class="col-12" style="margin-bottom: 20px">
                            <label for="ukuran_grup">Ukuran Group</label>
                            <select name="ukuran_grup" id="ukuran_grup" class="form-control">
                                <option value="penuh">Penuh</option>
                                <option value="setengah">Setengah</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Tambah
                    </button>
                </div>
        </form>
    </div>
</div>
</div>
<!-- END Pop In Modal -->

<!-- Pop In Modal -->
<div class="modal fade" id="modal_rename" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <form id="form_rename">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="col-12" style="margin-bottom: 20px;">
                            <label for="alias_grup_item">Alias Item Grup</label>
                            <input name="alias_grup_item" type="text" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Ubah
                    </button>
                </div>
        </form>
    </div>
</div>
</div>
<!-- END Pop In Modal -->

<div id="cmenu"></div>

<div id="loader_box">
    <svg id="loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <defs>
            <clipPath id="ldio-0sslxgday7x9-cp" x="0" y="0" width="100" height="100">
                <path d="M81.3,58.7H18.7c-4.8,0-8.7-3.9-8.7-8.7v0c0-4.8,3.9-8.7,8.7-8.7h62.7c4.8,0,8.7,3.9,8.7,8.7v0C90,54.8,86.1,58.7,81.3,58.7z"></path>
            </clipPath>
        </defs>
        <path fill="none" stroke="#6a6a6a" stroke-width="2.7928" d="M82 63H18c-7.2,0-13-5.8-13-13v0c0-7.2,5.8-13,13-13h64c7.2,0,13,5.8,13,13v0C95,57.2,89.2,63,82,63z"></path>
        <g clip-path="url(#ldio-0sslxgday7x9-cp)">
            <g transform="translate(78.5573 0)">
                <rect x="-100" y="0" width="25" height="100" fill="#979797"></rect>
                <rect x="-75" y="0" width="25" height="100" fill="#bdbdbd"></rect>
                <rect x="-50" y="0" width="25" height="100" fill="#e2e2e2"></rect>
                <rect x="-25" y="0" width="25" height="100" fill="#f8f8f8"></rect>
                <rect x="0" y="0" width="25" height="100" fill="#979797"></rect>
                <rect x="25" y="0" width="25" height="100" fill="#bdbdbd"></rect>
                <rect x="50" y="0" width="25" height="100" fill="#e2e2e2"></rect>
                <rect x="75" y="0" width="25" height="100" fill="#f8f8f8"></rect>
                <animateTransform attributeName="transform" type="translate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0;100"></animateTransform>
            </g>
        </g>
    </svg>
</div>