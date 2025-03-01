<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form id="form_berita" enctype='multipart/form-data'>
    <div class="content row">
        <div class="col-8" style="padding:0px">
        <div class="block block-themed">
            <div class="block-header bg-earth">
                <h3 class="block-title">Berita Baru</h3>
            </div>
            <div class="block-content">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="form-group row">
                    <label class="col-12" for="judul_berita">Judul Berita</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Masukkan judul berita" value="<?=$judul?>">
                        <input type="hidden" name="id_berita" value="<?=$id_berita?>">
                        <input type="hidden" name="thumbnail_old" value="<?=$thumbnail_url?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="slug_berita">Permalink</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="slug_berita" name="slug_berita" placeholder="Masukkan permalink berita" value="<?=$slug?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea class="form-control summernote" name="content_berita" id="content_berita" cols="30" rows="10"><?=$isi?></textarea>
                    </div>
                </div>
            </div>
        </div>      
    </div>  
    <div class="col-4" style="padding-right:0px;">
        <div class="block block-themed">
            <div class="block-header bg-earth">
                <h3 class="block-title">Manajemen Berita</h3>
            </div>
            <div class="block-content" style="padding-bottom:18px;">
                <div class="form-group row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-square btn-primary btn-block">Simpan</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-square btn-primary btn-block">Batal</button>
                    </div>
                </div>
                <div id="thumbnail_preview_container" class="form-group row" style="height: 207px; overflow:hidden;line-height:200px;padding:15px">
                    <img id="thumbnail_preview" src="<?=base_url()?>assets/img/uploads/berita/<?=$thumbnail_url?>" alt="" style="width: 100%; height: auto;vertical-align:middle">
                </div>
                <div class="form-group row">
                    <label class="col-12">Upload Gambar Thumbnail</label>
                    <div class="col-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                            <label id="label_thumbnail" class="custom-file-label" for="thumbnail">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </form>
    <!-- END Page Content -->
    
</main>
<!-- END Main Container -->
