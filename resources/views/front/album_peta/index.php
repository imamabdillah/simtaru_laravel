<main id="content" class="content">
    <section class="vc_row pt-40 pb-40">
        <div class="container">
            <div class="row">
                <div class="lqd-column col-md-12 text-center">
                    <h3 class="mb-5">Album Peta INTIP Surakarta</h3>
                </div>
                <div class="lqd-column col-md-12">
                    <div class="ld-media-row row d-flex" data-liquid-masonry="true" data-custom-animations="true" data-ca-options='{"triggerHandler":"inview","animationTarget":".ld-media-item","duration":700,"delay":100,"easing":"easeOutQuint","initValues":{"scale":1},"animations":{"scale":1}}'>
                        <?php foreach ($album as $v) : ?>
                            <div class="lqd-column col-md-4 col-sm-6 masonry-item">
                                <h5><?= $v['nama_foto'] ?></h5>
                                <div class="ld-media-item">
                                    <figure data-responsive-bg="true">
                                        <img class="invisible" src="<?= base_url() ?>assets/img/album/<?= $v['file'] ?>" alt="Media Gallery">
                                    </figure>
                                    <div class="ld-media-item-overlay d-flex flex-column align-items-center text-center justify-content-center">
                                        <div class="ld-media-bg"></div>
                                        <div class="ld-media-content">
                                            <span class="ld-media-icon">
                                                <span class="ld-media-icon-inner">
                                                    <i class="icon-ion-ios-add"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="<?= base_url() ?>assets/img/album/<?= $v['file'] ?>" class="liquid-overlay-link fresco" data-fresco-group="media-group-3"></a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>