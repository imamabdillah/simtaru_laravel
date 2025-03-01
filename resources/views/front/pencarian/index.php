<!-- content tabel start -->
<main class="main-bg-cstm" style="background-image: url('<?= base_url('assets/front_20232/') ?>images/bg/bg-1.jpg');">
    <div class="bg-overlay"></div>
    <!-- ==================== Start data tabel ==================== -->
    <section class="about">
        <div class="container section-padding">
            <div class="row col-12 mt-50">
                <div class="col-lg-12">
                    <div class="sec-head">
                        <span class="sub-title mb-15 opacity-8">Pencarian</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <form id="form_cari">
                        <div class="row"> 
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="cari" placeholder="pencarian . . .">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div> 
                        </div>
                    </form>
                </div> 
                

                <div class="row" style="overflow-y: scroll; height:350px !important;">
                    <?php foreach ($cari as $value) { ?>
                    <div class="col-lg-12 mt-5">
                        <div class="bg-white p-3" style="color: black;">
                            <h5><?= @$value->data_value ?></h5>

                            <div style="color: blank;">Atribut : <?= @$value->nama_atribut ?></div> 
                            <div style="color: blank;">Layer : <?= @$value->nama_layer ?></div> 
                        </div>
                    </div>
                        <!-- <?php } ?>
                        <?php echo $this->pagination->create_links(); ?> -->
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                </div>
                
            </div>
            
        </div>
    </section>
    <!-- ==================== End data tabel ==================== -->
</main>
<!-- content tabel ends -->  