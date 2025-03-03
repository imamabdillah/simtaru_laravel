<h3><?php echo $hasil['nama_pemohon'] ?> <small class="text-red"><b>(<?php echo $hasil['nama_kelurahan'].', '.$hasil['nama_kecamatan'] ?>)</b></small></h3>
<hr>

<div class="row"> 
    <div class="col-md-12">
        <div class="js-wizard-simple block"> 
            <ul class="nav nav-tabs nav-tabs-alt nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#wizard-simple2-step-kkr-1" data-toggle="tab">1. Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#wizard-simple2-step-kkr-2" data-toggle="tab">2. Foto</a>
                </li> 
            </ul>
            <div class="block-content block-content-full tab-content" style="min-height: 267px;">
				<div class="tab-pane active" id="wizard-simple2-step-kkr-1" role="tabpanel">
					<table class="table">
						<tr>
							<td><b>Nama Pemohon</b></td>
							<td>: <?php echo $hasil['nama_pemohon'] ?></td>
						</tr>
						<tr>
							<td><b>Jenis Pemohon</b></td>
							<td>: <?php echo $hasil['jenis_pemohon'] ?></td>
						</tr> 
						<tr>
							<td><b>Alamat</b></td>
							<td>: <?php echo $hasil['alamat_pemohon'] ?></td>
						</tr>
						<tr>
							<td><b>Kecamatan</b></td>
							<td>: <?php echo $hasil['nama_kecamatan'] ?></td>
						</tr>
						<tr>
							<td><b>Kelurahan</b></td>
							<td>: <?php echo $hasil['nama_kelurahan'] ?></td>
						</tr>
						<tr>
							<td><b>Status</b></td>
							<td>: <?php echo $hasil['status'] ?></td>
						</tr>
						
					</table>
				</div>
				<div class="tab-pane" id="wizard-simple2-step-kkr-2" role="tabpanel">
					<div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="bukti_tanah">Bukti Tanah <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <img src="<?= base_url($data_perijinan->url_bukti_tanah);?>" style="width: 500px;">
                        </div>
                    </div> 
                    <!-- File -->  
                    <br>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="file_site_plan">Site Plan/Master Plan yang dimintakan rekomendasi </label>
                        <div class="col-lg-8">
                            <img src="<?= base_url($data_perijinan->url_site_plan);?>" style="width: 500px;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="file_foto_tanah_1">Foto Tanah 1 </label>
                        <div class="col-lg-8">
                            <img src="<?= base_url($data_perijinan->url_foto_tanah_1);?>" style="width: 500px;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="file_foto_tanah_2">Foto Tanah 2 </label>
                        <div class="col-lg-8">
                            <img src="<?= base_url($data_perijinan->url_foto_tanah_2);?>" style="width: 500px;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="file_ktp">KTP </label>
                        <div class="col-lg-8">
                            <img src="<?= base_url($data_perijinan->url_ktp);?>" style="width: 500px;">
                        </div>
                    </div>
				</div> 
            </div> 
        </div> 
    </div>
</div>

			<!-- </div>
		</div>
	</section>
</div> -->


<script>
	var optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

	$(document).ready(function(){
		let uang = parseInt($('#uang').html())
		let tglPerolehan = new Date($('#tgl-perolehan').html())
		let tglPajak = new Date($('#tgl-pajak').html())
		
		$('#uang').html('Rp. '+uang.toLocaleString('id'))
		$('#tgl-perolehan').html(tglPerolehan.toLocaleDateString('id-ID', optionsDate))
		$('#tgl-pajak').html(tglPajak.toLocaleDateString('id-ID', optionsDate))
		let list = $('.item')
		$(list[0]).addClass("selected");	
		var selected = $('.selected').attr('id')
		var path = $(".selected").children("img").attr("src");
		generateImage(path);
	});

	function generateImage(path){
		$("#viewed-image").attr("src", path);
	}

	function selectImage(e){
		let newPath = $(e.target).prev().attr('src')
		$("#list-image").find(".selected").removeClass("selected");
		$(e.target.parentNode).addClass("selected");		
		generateImage(newPath)
	}
</script> 