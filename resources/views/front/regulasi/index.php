<!-- content tabel start -->
<main class="main-bg-cstm" style="background-image: url('<?= base_url('assets/front_20232/') ?>images/bg/bg-1.jpg');">
    <div class="bg-overlay"></div>
    <!-- ==================== Start data tabel ==================== -->
    <section class="about">
        <div class="container section-padding">
            <div class="row col-12 mt-50">
                <div class="col-lg-12">
                    <div class="sec-head">
                        <span class="sub-title mb-15 opacity-8">Regulasi</span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-body">
                        <div class="table-responsive"> 

                            <table id="table_regulasi" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center">Regulasi</th>
                                        <th style="text-align: center">Tanggal disahkan</th>
                                        <th style="text-align: center">File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; if (@$regulasi) { ?>
                                        <?php foreach ($regulasi as $v) : ?>
                                            <tr>
                                                <td style="text-align: center"><?= $no++ ?></td>
                                                <td><?= $v['nama_dokumen'] ?></td>
                                                <td style="text-align: center"><?= $v['tanggal_disahkan'] ?></td>
                                                <td style="text-align: center">
                                                    <a href="<?= base_url() ?>assets/regulasi/<?= $v['file'] ?>" target="_blank" class="btn btn-md circle" style="font-size: smaller; padding: 3px 10px; background: #007bff; color: #ffffff; border: 1px solid #007bff;">Unduh File</a>
                                                </td>
                                            </tr>
                                            <!-- <?php $no = 1; ?> -->
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <tr><td colspan="4"><label class="text-center">Data Kosong</label></td></tr>
                                    <?php } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- ==================== End data tabel ==================== -->
</main>
<!-- content tabel ends -->  