<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content"> 
        
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">INFORMASI LAYANAN</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-square btn-secondary mr-5 mb-5 btn-tambah" onclick="tombol_edti()"><i class="fa fa-edit mr-5"></i>EDIT</button>
                </div>
            </div>
            <div class="block-content">
                <div class="row" style="text-align: center;">
                    <h2 class="title" align="center" style="font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(51, 51, 51); margin: 30px auto; font-size: 30px;"><b><?= $data_layanan['nama_layanan'];?></b></h2>

                    <br>
                    <?= $data_layanan['isi_layanan'];?>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

