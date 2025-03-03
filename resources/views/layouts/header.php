<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" class="no-focus"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>SIMTARU | DPUPR Kabupaten Sukoharjo</title>

    <meta name="description" content="SIMTARU | DPUPR Kabupaten Sukoharjo">
    <meta name="author" content="Phicosdev">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="SIMTARU | DPUPR Kabupaten Sukoharjo">
    <meta property="og:site_name" content="SIMTARU | DPUPR Kabupaten Sukoharjo">
    <meta property="og:description" content="SIMTARU | DPUPR Kabupaten Sukoharjo">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="<?= base_url('assets/'); ?>favicon.png" type="image/x-icon" /> -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets_front/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() ?>assets_front/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets_front/images/favicon.png">

    <link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/leaflet.measure.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">

    <!-- Dropzone -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/dropzonejs/min/dropzone.min.css">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/magnific-popup/magnific-popup.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>

    <style>
        #sidebar {
            min-width: 17%;
            background-color: #DFB31C !important;
        }

        #page-container.sidebar-inverse #sidebar .content-side-user {
            background-color: rgba(0, 0, 0, 0) !important;
        }

        .nav-main a {
            text-transform: none !important;
            font-weight: 400 !important;
        }

        .sidebar-inverse #sidebar .nav-main li.open>ul {
            background-color: rgba(0, 0, 0, 0.05) !important;
        }

        .btn {
            border-radius: 8px !important;
        }

        .block.block-themed>.block-header {
            background-color: #080A71 !important;
            padding: 1rem 1.5rem !important;
        }

        .block.block-themed>.block-header>.block-title {
            font-weight: 600;
        }

        .content-side-user {
            height: fit-content !important;
        }

        #sidebar .nav-main li.open>a.nav-submenu>i {
            color: white !important;
        }

        .sidebar-mini-hide {
            font-weight: 400 !important;
            font-size: 14px !important;
        }

        .nav-main>li:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar-inverse #sidebar .nav-main a {
            color: #080A71 !important;
        }

        #sidebar .nav-main a>i {
            color: #080A71 !important;
        }

        #sidebar .nav-main a:hover>i {
            color: white !important;
        }

        .sidebar-inverse #sidebar .nav-main a:hover {
            color: white !important;
        }
    </style>
</head>

<body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed page-header-modern main-content-boxed">
        <nav id="sidebar" class="position relative">
            <!-- Sidebar Scroll Container -->
            <img src="<?= base_url(); ?>assets_front/images/batik-pattern-1.svg" alt="" class="position-absolute" style="opacity: .1; left: 0; translate: -40% 0;">

            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15" style="background-color: rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="font-w700 font-size-xl" href="<?= base_url() ?>">
                                    <!-- <i class="si si-globe text-primary"></i> -->
                                    <span class="text-dual-primary-dark">SIM</span><span style="color: white;">TARU</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user align-parent">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn">
                            <img class="img-avatar img-avatar32" src="<?= base_url(); ?>assets/img/avatars/avatar15.jpg" alt="" />
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center position-relative">
                            <div class="img-link">
                                <img class="img-avatar" src="<?= base_url(); ?>assets/img/avatars/avatar15.jpg" alt="" style="outline: 10px solid rgba(255,255,255,0.05);" />
                            </div>

                            <div class="mt-10">
                                <div class="text-dual-primary-dark font-w600" style="font-size: 16px;"><?= $this->session->userdata('nama'); ?></div>
                            </div>

                            <a class="position-absolute block text-white" style="top: 0; right: 0; background-color: rgba(255, 255, 255, 0.2); padding: 8px 12px 8px 10px; border-radius: 8px;" href="<?= base_url(); ?>auth/login/out">
                                <i class="si si-logout"></i>
                            </a>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->