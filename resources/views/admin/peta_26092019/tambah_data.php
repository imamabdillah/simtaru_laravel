<style>
#map{
    height: 500px;
}
#floating_panel {
    position: relative;
    z-index: 5;
    text-align: left;
    left: 20px;
    /* top: 149px; */
    bottom: 440px;
}

#btn_hapus {
    width: 40px;
    height: 40px;
    background: #ffffff;
    text-decoration: none;
    border: none;
    box-shadow: 0 1px 2px #bbbbbb;
}

#btn_hapus:hover{
    cursor: pointer;
}

#btn_hapus i {
    font-size: 16pt;
}
</style>
<?php foreach ($data_peta as $peta) { ?>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="block block-themed" style="background: transparent;">
            <div class="block-header bg-primary-dark">
                <?= ucfirst($this->uri->segment(5)); ?> Layer <?= $peta->nama_layer; ?>
            </div>
            <div class="block-content" id="map"></div>
            <div id="floating_panel">
                <button id="btn_hapus"><i class="fa fa-trash-o"></i></button>
            </div>   
                
            
        </div>
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Tambah Data Layer <span><?= $peta->nama_layer; ?></span></h3>
            </div>
            <div class="block-content">
                <div class="row justify-content-center py-20">
                    <div class="col-xl-6">
                        <form method="post" id="tambah_data_peta">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_layer" value="<?= $this->uri->segment(4);?>">
                            <input type="hidden" name="tipe_layer" value="<?= ucfirst($this->uri->segment(5)); ?>">
                            <?php foreach ($data_atribut as $atribut) { ?>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="<?= $atribut->slug; ?>"><?= $atribut->nama_atribut; ?> <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="hidden" name="id_atribut_<?= $atribut->slug; ?>" value="<?= $atribut->id_atribut; ?>">
                                    <?php if($atribut->tipe_data != "File"){ ?>
                                        <input required type="text" class="form-control <?php if($atribut->tipe_data == "Angka"){echo "angka-saja";} ?>" id="<?= $atribut->slug; ?>" name="<?= $atribut->slug; ?>" placeholder="Masukkan <?= $atribut->nama_atribut; ?>">
                                    <?php }else{ ?>
                                        <input required type="file" id="<?= $atribut->slug; ?>" name="<?= $atribut->slug; ?>">
                                    <?php }?>
                                </div>
                            </div>
                            <?php } ?>

                            <!-- <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="longtitude">Longtitude <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" disabled class="form-control" id="longtitude" name="longtitude" placeholder="Masukkan longtitude">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="latitude">Latitude <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" disabled class="form-control" id="latitude" name="latitude" placeholder="Masukkan latitude">
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-alt-primary">Simpan Data <?= $peta->nama_layer; ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
<?php } ?>