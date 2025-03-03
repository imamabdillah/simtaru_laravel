<main id="content" class="content">
    <div class="container py-5">
        <div class="row" style="margin-bottom: 150px">
            <div class="col-md-12">
                <div class="panel-group feature-accordion brand-accordion icon angle-icon" id="accordion-one">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-one" href="#informasi_dasar" aria-expanded="true" class="">
                                    Informasi Geospasial Dasar
                                </a>
                            </h3>
                        </div>
                        <div id="informasi_dasar" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body">
                                <div class="table-responsive ">
                                    <table id="table_informasi_dasar" class="table table-hover">
                                        <thead>
                                            <tr>

                                                <th style="text-align:center">NO</th>
                                                <th style="text-align:center">NAMA</th>
                                                <th style="text-align:center">DESKRIPSI</th>
                                                <th style="text-align:center">OPD</th>
                                                <th style="text-align:center">JUMLAH DATA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no1 = 1 ?>
                                            <?php foreach ($informasi_dasar as $v) : ?>
                                                <tr>
                                                    <td style="text-align:center"><?= $no1++ ?></td>
                                                    <td><?= $v['nama_layer'] ?></td>
                                                    <td><?= $v['deskripsi_layer'] ?></td>
                                                    <td style="text-align:center"><?= $v['nama_opd'] ?></td>
                                                    <td style="text-align:center"><?= $v['jumlah_data'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rencana Tata Ruang -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-one" href="#rencana_tata_ruang" aria-expanded="false">
                                    Rencana Tata Ruang
                                </a>
                            </h3>
                        </div>
                        <div id="rencana_tata_ruang" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="table_rencana_tata_ruang" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">NO</th>
                                                <th style="text-align:center">NAMA</th>
                                                <th style="text-align:center">DESKRIPSI</th>
                                                <th style="text-align:center">OPD</th>
                                                <th style="text-align:center">JUMLAH DATA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no2 = 1 ?>
                                            <?php foreach ($rencana_tata_ruang as $v) : ?>
                                                <tr>
                                                    <td style="text-align:center"><?= $no2++ ?></td>
                                                    <td><?= $v['nama_layer'] ?></td>
                                                    <td><?= $v['deskripsi_layer'] ?></td>
                                                    <td style="text-align:center"><?= $v['nama_opd'] ?></td>
                                                    <td style="text-align:center"><?= $v['jumlah_data'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tata Ruang -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-one" href="#informasi_tata_ruang" aria-expanded="false">
                                    Informasi Tata Ruang
                                </a>
                            </h3>
                        </div>
                        <div id="informasi_tata_ruang" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="table_informasi_tata_ruang" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">NO</th>
                                                <th style="text-align:center">NAMA</th>
                                                <th style="text-align:center">DESKRIPSI</th>
                                                <th style="text-align:center">OPD</th>
                                                <th style="text-align:center">JUMLAH DATA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no3 = 1 ?>
                                            <?php foreach ($informasi_tata_ruang as $v) : ?>
                                                <tr>
                                                    <td style="text-align:center"><?= $no3++ ?></td>
                                                    <td><?= $v['nama_layer'] ?></td>
                                                    <td><?= $v['deskripsi_layer'] ?></td>
                                                    <td style="text-align:center"><?= $v['nama_opd'] ?></td>
                                                    <td style="text-align:center"><?= $v['jumlah_data'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>