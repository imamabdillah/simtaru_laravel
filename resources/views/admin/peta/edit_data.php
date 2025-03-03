<style>
#map{
    height: 500px;
}

.select2_img{
    width: 25px ;
    height: 25px ;
    margin-right: 10px;
}

.select2-container .select2-selection--single{
    height: 34px;
    border-color: #dddddd;
}

.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 34px;
    color: #777777;
    margin-left: 7px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow{
    height: 34px;
}
</style>
<link rel="stylesheet" href="<?=base_url()?>_assets_front/css/leaflet.css"/>
<link rel="stylesheet" href="<?=base_url()?>_assets_front/css/leaflet.draw.css"/>
<?php foreach ($data_peta as $peta) { ?>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="block block-themed" style="background: transparent;">
            <div class="block-header bg-primary-dark">
                <?= ucfirst($this->uri->segment(5)); ?> Layer <?= $peta->nama_layer; ?>
            </div>
            <div class="block-content" id="map"></div>
        </div>
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Tambah Data Layer <span><?= $peta->nama_layer; ?></span></h3>
            </div>
            <div class="block-content">
                <div class="row justify-content-center py-20">
                    <div class="col-xl-6">
                        <form method="post" id="tambah_data_peta">
                            <!-- <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="pilih_koordinat">Pilih Koordinat</label>
                                <div class="col-lg-8">
                                    <select name="pilih_koordinat" id="pilih_koordinat" class="" style="width:100%;">
                                    <?php if(count($data_koordinat) > 0):?>
                                        <option value="">-- Pilih Koordinat --</option>
                                        <?php foreach($data_koordinat as $koord):?>
                                            <option value="<?=$koord['id_koordinat']?>"><?=$koord['nama_koordinat']?></option>
                                        <?php endforeach?>
                                    <?php else: ?>
                                        <option value="">-- Koordinat Tidak Tersedia--</option>
                                    <?php endif ?>                
                                    </select>
                                    <div style="font-size: smaller">
                                        * Koordinat yang tersimpan dari menu referensi koordinat
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="pilih_koordinat">Pilih Koordinat</label>
                                <div class="col-lg-8">
                                    <select name="pilih_koordinat" id="pilih_koordinat" class="" style="width:100%;"></select>
                                    <div style="font-size: smaller">
                                        * Koordinat yang tersimpan dari menu referensi koordinat
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_layer" value="<?= $this->uri->segment(4);?>">
                            <input type="hidden" name="tipe_layer" value="<?= ucfirst($this->uri->segment(5)); ?>">
                            <input type="hidden" name="id_collection" value="<?= $this->uri->segment(6); ?>">
                            <?php foreach ($data_atribut as $atribut) { ?>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="<?= $atribut->slug; ?>"><?= $atribut->nama_atribut; ?> <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="hidden" name="id_atribut_<?= $atribut->slug; ?>" value="<?= $atribut->id_atribut; ?>">
                                    <?php if($atribut->tipe_data != "File"){ ?>
                                        <input required type="text" class="form-control <?php if($atribut->tipe_data == "Angka"){echo "angka-saja";} ?>" id="<?= $atribut->slug; ?>" name="<?= $atribut->slug; ?>" placeholder="Masukkan <?= $atribut->nama_atribut; ?>" value="<?=@$data_collection[$atribut->slug]?$data_collection[$atribut->slug]:''?>">
                                    <?php }else{ ?>
                                        <input required type="file" id="<?= $atribut->slug; ?>" name="<?= $atribut->slug; ?>">
                                    <?php }?>
                                </div>
                            </div>
                            <?php } ?>

                            <!-- Static input form -->
                            <hr>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="name" type="text" class="form-control" value="<?=$data_collection['name']?>">
                                    <div style="font-size: smaller">
                                        * Ditampilkan sebagai nama pencarian pada peta halaman depan
                                    </div>
                                </div>
                                
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="group">Group<span class="text-danger"></span></label>
                                <div class="col-lg-8">
                                    <input name="group" type="text" class="form-control" value="<?=$data_collection['group']?>">
                                </div>
                            </div> -->

                            <!-- Input Map Feature Styles | Polygon -->
                            <?php if($this->uri->segment(5) == 'Polygon'):?>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke">Stroke <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="js-colorpicker input-group">
                                        <input name="stroke" type="text" class="form-control" value="<?=@$data_collection['stroke']?$data_collection['stroke']:'#FF0000'?>">
                                        <div class="input-group-append input-group-addon">
                                            <div class="input-group-text">
                                                <i></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_opacity">Stroke Opacity <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="stroke_opacity" type="number" min="0" max="1" step="0.1" class="form-control" value="<?=@$data_collection['stroke_opacity']?$data_collection['stroke_opacity']:1?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_width">Stroke Width <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="stroke_width" type="number" min="0" class="form-control" value="<?=@$data_collection['stroke_width']?$data_collection['stroke_width']:1?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_dash">Stroke Dash <span class="text-danger"></span></label>
                                <div class="col-lg-8">
                                    <input name="stroke_dash" type="text" class="form-control" value="<?=@$data_collection['stroke_dash']?$data_collection['stroke_dash']:''?>" placeholder="Contoh: 5,5"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="fill">Fill <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="js-colorpicker input-group">
                                        <input name="fill" type="text" class="form-control" value="<?=@$data_collection['fill']?$data_collection['fill']:'#FF7070'?>">
                                        <div class="input-group-append input-group-addon">
                                            <div class="input-group-text">
                                                <i></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="fill_opacity">Fill Opacity <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="fill_opacity" type="number" min="0" max="1" step="0.1" class="form-control" value="<?=@$data_collection['fill_opacity']?$data_collection['fill_opacity']:1?>">
                                </div>
                            </div>

                            <!-- Input Map Feature Styles | Line / LineString -->
                            <?php elseif($this->uri->segment(5) == 'LineString'):?>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke">Stroke <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="js-colorpicker input-group">
                                        <input name="stroke" type="text" class="form-control" value="<?=@$data_collection['stroke']?$data_collection['stroke']:'#FF0000'?>">
                                        <div class="input-group-append input-group-addon">
                                            <div class="input-group-text">
                                                <i></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_opacity">Stroke Opacity <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="stroke_opacity" type="number" min="0" max="1" class="form-control" value="<?=@$data_collection['stroke_opacity']?$data_collection['stroke_opacity']:1?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_width">Stroke Width <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="stroke_width" type="number" min="0" class="form-control" value="<?=@$data_collection['stroke_width']?$data_collection['stroke_width']:1?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_dash">Stroke Dash <span class="text-danger"></span></label>
                                <div class="col-lg-8">
                                    <input name="stroke_dash" type="text" class="form-control" value="<?=@$data_collection['stroke_dash']?$data_collection['stroke_dash']:''?>" placeholder="Contoh: 5,5"> 
                                </div>
                            </div>

                            <!-- Input Map Feature Styles | Point -->
                            <?php elseif($this->uri->segment(5) == 'Point'):?>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="stroke_width">Icon Name <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <select  id="icon_name" name="icon_name" class="form-control" style="width: 100%;">
                                        <option data-img="default" value="default">default</option>
                                        <?php foreach($data_icon as $icon): ?>
                                            <?php if($icon['nama_icon'] == $data_collection['icon_name']):?>
                                                <option data-img="<?=$icon['nama_icon']?>" value="<?=$icon['nama_icon']?>" selected><?=$icon['nama_icon']?></option>
                                            <?php else:?>
                                                <option data-img="<?=$icon['nama_icon']?>" value="<?=$icon['nama_icon']?>"><?=$icon['nama_icon']?></option>
                                            <?php endif;?>
                                            
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            

                            <?php endif;?>

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="css-control css-control-success css-checkbox">
                                        <input type="checkbox" name="page_detail" class="css-control-input" <?=$data_collection['page_detail']?'checked':''?>>
                                        <span class="css-control-indicator"></span> Aktifkan Fitur Halaman Detail
                                    </label>
                                </div>
                            </div>
                           
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