<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form id="simpan_berita">
    <div class="content row">
        <div class="col-12" style="padding:0px">
        <div class="block block-themed">
            <div class="block-header bg-earth">
                <h3 class="block-title">Berita Baru</h3>
            </div>
            <div class="block-content">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="form-group row">
                    <label class="col-12" for="judul">Judul Berita</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul berita">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="slug">Permalink</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Masukkan permalink berita">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea class="form-control summernote" name="isi" id="isi" cols="30" rows="10"></textarea>
                    </div>
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
                <div id="thumbnail_preview_container" class="form-group row" style="height: 207px; overflow:hidden;line-height:200px;padding:15px;">
                    <img id="thumbnail_preview" src="" alt="" style="width: 300px; height: auto;vertical-align:middle">
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <button type="submit" value="submit" name="submit" class="btn btn-square btn-primary btn-block">Simpan</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-square btn-danger btn-block">Batal</button>
                    </div>
                </div>
            </div>
        </div>      
    </div>   
    </form>
    <!-- END Page Content -->
    
</main>
<!-- END Main Container -->

