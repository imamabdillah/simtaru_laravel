<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="block block-themed">

            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:;" onclick="tampil_data_rtr()" id="tab_rtr">Recana Tata Ruang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" onclick="tampil_data_kkr()">Keterangan Kesesuaian Ruang</a>
                </li>
            </ul>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width: 20px;">No.</th>
                            <th style="text-align: center; width: 200px;">Nama Pemohon</th>
                            <th style="text-align: center;">Lokasi Lahan</th>
                            <th style="text-align: center; width: 100px;">Status Perijinan</th>
                            <th style="text-align: center; width: 100px;">Action</th>
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

<!-- Modal Detail -->
<div class="modal fade" id="modal-default-rtr">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom-color:transparent;padding-bottom:0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body asd" style="padding-top:0;">
                <!-- <p>One fine body&hellip;</p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modal-default-kkr">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom-color:transparent;padding-bottom:0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body asd2" style="padding-top:0;">
                <!-- <p>One fine body&hellip;</p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
