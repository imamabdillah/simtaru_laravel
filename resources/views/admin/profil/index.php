<main id="main-container">
    <!-- Page Content -->
    <div class="bg-image bg-image-bottom" style="background-image: url('<?= base_url(); ?>assets/img/photos/photo13@2x.jpg');">
        <div class="bg-primary-dark-op py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="#">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="<?= base_url(); ?>assets/img/avatars/avatar15.jpg" alt="">
                    </a>
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10"><?= $data_user_detail['nama'];?></h1>
                <h2 class="h5 text-white-op">
                    <?php
                    switch ($data_user_detail['role']) {
                    	case '1':$role = 'Administrator';break;
                    	case '2':$role = 'OPD';break;
                    	default:$role = 'Pemohon';break;
                    }
                    echo $role;
                    ?>
                </h2>
                <!-- END Personal -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    <div class="content">
    	<div class="block block-themed">
	        <div class="block-header bg-primary-dark">
	            <h3 class="block-title">Detail Profil</h3>
	            <div class="block-options">
	            </div>
	        </div>
	        <div class="block-content">
	            <div class="row justify-content-center py-20">
	                <div class="col-xl-8">
	                    <form id="form_profil">
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="no_ktp">NIK <span class="text-danger">*</span></label>
	                            <div class="col-lg-8">
	                                <input type="text" class="form-control " id="no_ktp" name="no_ktp" placeholder="Masukkan NIP" maxlength="16" minlength="16" value="<?= $data_user_detail['no_ktp'];?>">
	                                <div class="form-text text-muted">&nbsp;NIP harus 16 digit</div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="nama">Nama Lengkap <span class="text-danger">*</span></label>
	                            <div class="col-lg-8">
	                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required value="<?= $data_user_detail['nama'];?>">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="no_hp">No. Telp</label>
	                            <div class="col-lg-8">
	                                <input type="text" class="form-control " id="no_hp" name="no_hp" placeholder="Masukkan No. Telp" value="<?= $data_user_detail['no_hp'];?>">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="email">Email</label>
	                            <div class="col-lg-8">
	                                <input type="text" class="form-control " id="email" name="email" placeholder="Masukkan Email" value="<?= $data_user_detail['email'];?>">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="email">Kecamatan</label>
	                            <div class="col-lg-8">
	                                <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value=""></option>
                                        <?php
                                            foreach ($daftar_kecamatan->result() as $kecamatan){
                                                echo "<option value=".$kecamatan->id_kecamatan.">".$kecamatan->nama_kecamatan."</option>";
                                            }
                                        ?>
                                    </select>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="email">Desa</label>
	                            <div class="col-lg-8">
	                                <select name="desa" id="desa" class="form-control">
                                    </select>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="alamat">Alamat Lengkap</label>
	                            <div class="col-lg-8">
	                                <textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Masukkan Alamat Lengkap"><?= $data_user_detail['alamat'];?></textarea>
	                            </div>
	                        </div>
	                        <br>
	                        <hr>
	                        <br>
	                        <div class="form-group row">
	                            <label class="col-lg-4 col-form-label" for="username">Username <span class="text-danger">*</span></label>
	                            <div class="col-lg-8">
	                                <input disabled type="text" class="form-control " id="username" name="username" placeholder="Masukkan Username" required value="<?= $data_user_detail['user_name'];?>">
	                                <div class="form-text text-muted" onclick="show_ganti_password()"><font style="color: red;">&nbsp;Ganti Password Klik Disini</font></div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-lg-8 ml-auto">
	                                <button type="submit" class="btn btn-alt-success pull-right"><i class="fa fa-check"></i> Update </button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>

	        </div>
	    </div>
    </div>
</main>


<div class="modal fade" id="modal-ganti_password" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_ganti_password">

            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Reset Password</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <dir class="col-md-12">
                            <div class="form-group row" hidden>
                                <label class="col-12" for="nama_layer">ID User</label>
                                <div class="col-md-12">
                                    <input required type="text" class="form-control" id="ganti_id_user" name="ganti_id_user">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-12" for="nama_layer">Username</label>
                                <div class="col-md-12">
                                    <input required type="text" class="form-control" id="ganti_username" name="ganti_username" placeholder="Masukkan nama layer">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12" for="nama_layer">Password</label>
                                <div class="col-md-12">
                                    <input required type="password" class="form-control" id="ganti_password" name="ganti_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="nama_layer">Re-Type Password</label>
                                <div class="col-md-12">
                                    <input required type="password" class="form-control" id="ganti_password_2" name="ganti_password_2" onkeyup="cek_password_1_dan_2_edit()">
                                    <label class="err err_password"></label>
                                </div>
                            </div>

                        </dir>

                    </div>
                </div>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-simpan" id="tombol_ganti_password">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>