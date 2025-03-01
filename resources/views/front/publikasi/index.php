<main id="content" class="content">
    <div class="container py-5">
        <h4 class="text-center mb-5">Publikasi INTIP Kota Surakarta</h4>
        <div class="row">
                <table id="table_publikasi" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">Judul</th>
                            <th style="text-align: center">Tanggal</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php foreach($publikasi as $v):?>
                        <tr>
                            <td  style="text-align: center"><?=$no++?></td>
                            <td><?=$v['judul']?></td>
                            <td style="text-align: center"><?=$v['added']?></td>
                            <td style="text-align: center"><a href="<?=base_url()?>publikasi/detail/<?=$v['id_berita']?>" target="_blank" class="btn btn-md circle" style="font-size: smaller; padding: 3px 10px; background: #e6262d; color: #ffffff; border: 1px solid #e6262d;">Baca Selengkapnya</a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
    </div>
</main>