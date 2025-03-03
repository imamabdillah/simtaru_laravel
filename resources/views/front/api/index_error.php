<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu</title>

    <meta name="description" content="Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu">
    <meta name="author" content="Phicosdev">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu">
    <meta property="og:site_name" content="INTIP">
    <meta property="og:description" content="Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>favicon.png" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/img/favicons/apple-touch-icon-180x180.png">

    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/main.css">
    

    <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
</head>
<body>
<main id="main-container">
    <!-- First Row -->
    <div class="content">
                
        <div class="block block-themed">
            <div class="block-header bg-danger">
                <h3 class="block-title">API INTIP Surakarta</h3>
            </div>

            <div class="block-content" style="padding: 50px">
                <div class="form-group row" style="background: #eeeeee; padding: 5px;">
                    <div class="col-lg-12" style="word-wrap: break-word;">
                        <?=$message?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
<footer id="page-footer" class="opacity-0">
        <div class="content py-20 font-size-xs clearfix">
            <div class="float-right">
            </div>
            <div class="float-left">
                <a class="font-w600" href="#"></a> &copy; Sistem Informasi PU Terpadu
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Codebase Core JS -->
<script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
<script src="<?= base_url(); ?>assets/js/codebase.js"></script>

<!-- Page JS Plugins -->
<script src="<?= base_url(); ?>assets/js/plugins/sweetalert2/new.js"></script>

<?php if(isset($extra_js)){echo $extra_js;}?>
</body>
</html>