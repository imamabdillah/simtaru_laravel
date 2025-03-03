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
                    Referensi Koordinat Peta
                </h3>

                <button id="btn_tambah_koordinat" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-koordinat"><i class="fa fa-plus"></i> Tambah Koordinat Peta</button>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th style="text-align: center">Nama Koordinat</th>
                            <th style="text-align: center">Keterangan</th>
                            <th style="text-align: center">Tipe</th>
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
<form id="form_koordinat" enctype="multipart/form-data">
    <div class="modal fade" id="modal-koordinat" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-lg" role="document" style="max-width: 80%">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah Koordinat</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div id="contoh_koordinat">
                                    <div>
                                        <h5>Contoh Koordinat Polygon <span style="font-size: smaller; font-weight: lighter;">[ Latitude, Longitude]</span></h5>
                                    </div>
                                    <pre><code class="json hljs">
[
    [
        [
            109.18212890625,
            -6.980954426458483
        ],
        [
            109.09423828125,
            -7.5585466060931426
        ],
        [
            110.093994140625,
            -7.885147283424331
        ],
        [
            110.79711914062499,
            -8.102738577783168
        ],
        [
            111.258544921875,
            -7.863381805309173
        ],
        [
            111.1376953125,
            -6.871892962887516
        ],
        [
            110.753173828125,
            -6.566388979822327
        ],
        [
            110.335693359375,
            -7.079088026071719
        ],
        [
            109.18212890625,
            -6.980954426458483
        ]
    ]
]
</code></pre>

                                    <div>
                                        <h5>Contoh Koordinat LineString <span style="font-size: smaller; font-weight: lighter;">[ Latitude, Longitude]</span></h5>
                                    </div>
                                    <pre><code class="json hljs">
[
    [
        -101.744384,
        39.32155
    ],
    [
        -101.552124,
        39.330048
    ],
    [
        -101.403808,
        39.330048
    ],
    [
        -97.635498,
        38.873928
    ]
 ]
</code></pre>

                                    <div>
                                        <h5>Contoh Koordinat Point <span style="font-size: smaller; font-weight: lighter;">[ Latitude, Longitude]</span></h5>
                                    </div>
                                    <pre><code class="json hljs">[110.70966432255051,-7.459751510223953]</code></pre>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- content -->
                                <div class="form-group row">
                                    <label class="col-12" for="id_opd">OPD</label>
                                    <div class="col-md-12">
                                        <select name="id_opd" id="id_opd" class="form-control">
                                            <option value="0">-- Semua OPD --</option>
                                            <?php foreach ($data_opd as $k => $v): ?>
                                                <?php if ($v['id_opd'] == $this->session->userdata('id_opd') && $this->session->userdata('role' != 1)): ?>
                                                    <option value="<?= $v['id_opd'] ?>" selected><?= $v['nama_opd'] ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $v['id_opd'] ?>"><?= $v['nama_opd'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <input type="hidden" name="id_koordinat">
                                <div class="form-group row">
                                    <label class="col-12" for="nama_koordinat">Nama Koordinat</label>
                                    <div class="col-md-12">
                                        <input required type="text" class="form-control" id="nama_koordinat" name="nama_koordinat" placeholder="Masukkan nama koordinat">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="ket_koordinat">Keterangan Koordinat</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="ket_koordinat" name="ket_koordinat" placeholder="Tambahkan keterangan koordinat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="tipe_koordinat">Tipe Koordinat</label>
                                    <div class="col-md-12">
                                        <select name="tipe_koordinat" id="tipe_koordinat" class="form-control">
                                            <option value="Polygon">Polygon</option>
                                            <option value="LineString">LineString</option>
                                            <option value="Point">Point</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="koordinat">Koordinat</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="koordinat" name="koordinat" placeholder="Tambahkan koordinat" rows="5"></textarea>
                                    </div>
                                </div>

                                <!-- end content -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-ubah-koordinat">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END Pop In Modal -->