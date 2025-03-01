<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style> 
<!-- Main Container -->
<main id="main-container">
    <div class="content">  
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-database"></i> Daftar Data "<b id="judul-sub-layer"><?= $value_attribut['data_value']; ?></b>"</h3>
                <div class="col-md-6">
                    <button class="btn btn-success pull-right my-auto mt-0" type="button" id="tombol_tambah">Tambah</button>
                </div>
            </div> 
                                
            <div class="block-content">
                <table class="table table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th class="th-background-dark-blue" style=""></th>
                            <th class="th-background-dark-blue" style="">Tahun</th>
                            <th class="th-background-dark-blue" style="">Pekerjaan</th>
                            <th class="th-background-dark-blue" style="">Lokasi</th>
                            <th class="th-background-dark-blue" style="">Pelaksanaan</th> 
                            <th class="th-background-dark-blue" style="width: 8%;">Aksi</th>
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

<div class="modal" id="modal_input" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Work Center</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="block"> 
                        <form id="form_input">
                            <div class="row">
                                <div class="form-group col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Id</label>
                                            <input type="text" class="form-control" name="id_data" id="form_id_data" value="<?= $id ?>"> 
                                        </div>
                                        <div class="col-md-12">
                                            <label>Id</label>
                                            <input type="text" class="form-control" name="id_perbaikan" id="form_id_perbaikan"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" name="tahun" id="form_tahun"> 
                                        </div>
                                        <div class="col-md-12">
                                            <label>Paket Pekerjaan</label>
                                            <textarea class="form-control" name="paket_pekerjaan" id="form_paket_pekerjaan"></textarea> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Anggaran</label>
                                            <input type="text" class="form-control" name="anggaran" id="form_anggaran"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Pelaksana</label>
                                            <input type="text" class="form-control" name="pelaksana" id="form_pelaksana"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nomor Kontrak</label>
                                            <input type="text" class="form-control" name="no_kontrak" id="form_no_kontrak"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal Kontrak</label>
                                            <input type="date" class="form-control" name="tgl_kontrak" id="form_tgl_kontrak"> 
                                        </div>
                                        <div class="col-md-12">
                                            <label>Lokasi</label>
                                            <textarea class="form-control" name="lokasi" id="form_lokasi"></textarea> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Jangka Waktu</label>
                                            <input type="text" class="form-control" name="jangka_waktu" id="form_jangka_waktu"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal Mulai</label>
                                            <input type="date" class="form-control" name="tgl_mulai" id="form_tgl_mulai"> 
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal Mulai</label>
                                            <input type="date" class="form-control" name="tgl_selesai" id="form_tgl_selesai"> 
                                        </div>
                                        <div class="col-md-12">
                                            <label>Realisasi</label>
                                            <textarea class="form-control" name="realisasi" id="form_realisasi"></textarea> 
                                        </div>
                                    </div> 

                                    
                                    
                                    <div class="row"> 
                                        <div class="col-md-12 mt-5">                                                        
                                            <button type="button" class="btn btn-danger" id="tombol_clear">Clear</button> 
                                            <button type="submit" class="btn btn-primary" id="tombol_tambah">Simpan</button> 
                                            <!-- <button type="button" class="btn btn-primary">Simpan</button>  -->
                                        </div>  
                                    </div>
                                </div>
                                
                            </div> 
                        </form> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>