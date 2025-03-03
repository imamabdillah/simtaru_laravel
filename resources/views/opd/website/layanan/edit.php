<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form id="form_berita" enctype='multipart/form-data'>
    <div class="content row">
        <div class="col-12" style="padding:0px">
            <div class="block block-themed">
                <div class="block-header bg-earth">
                    <h3 class="block-title">EDIT LAYANAN</h3>
                </div>
                <div class="block-content">
                    <input type="hidden" name="id" value="<?= $data_layanan['id'];?>">
                    <div class="form-group row">
                        <label class="col-12" for="judul_berita">Layanan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Judul Layanan" value="<?= $data_layanan['nama_layanan'];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea class="form-control summernote" name="isi_layanan" id="isi_layanan"><?= $data_layanan['isi_layanan'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <a href="<?= base_url('/opd/website/layanan/edit/');?>" class="btn btn-square btn-primary btn-block">Batal</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-square btn-primary btn-block">Simpan</button>
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
