<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form id="form_deskripsi">
    <div class="content row">
        <div class="col-12" style="padding:0px">
        <div class="block block-themed">
            <div class="block-header bg-earth">
                <h3 class="block-title">Diskripsi</h3>
            </div>
            <div class="block-content">
                <input type="hidden" class="form-control" id="id_collection" name="id_collection">

                <div class="form-group row">
                    <label class="col-12" for="nama">Nama</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Sanggar">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="website">Website</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="website" name="website" placeholder="Website Sanggar (Optional)">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea class="form-control summernote" name="deskripsi" id="deskripsi" cols="50" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <button type="submit" value="submit" name="submit" id="simpan" class="btn btn-square btn-primary btn-block">Simpan</button>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url('opd/peta/data_peta/').$id;?>" class="btn btn-square btn-danger btn-block" >Batal</a>
                    </div>
                </div>
            </div>
        </div>      
    </div>   
    </form>
    <!-- END Page Content -->
    
</main>
<!-- END Main Container -->

