<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#3ed2a7">
    <link rel="shortcut icon" href="assets/img/custom/logo-solo-sq.png" />
    <title>INTIP | BAPPPEDA Kota Surakarta</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/liquid-icon/liquid-icon.min.css" />
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/theme-vendors.min.css" />
    <link rel="stylesheet" href="assets/css/theme.min.css" />
    <link rel="stylesheet" href="assets/css/themes/charity.css" />

    <script async src="assets/vendors/modernizr.min.js"></script>
    <link rel="stylesheet" href="assets/css/custom.css" />
    <?php if (isset($extra_css)) {
        echo $extra_css;
    } ?>
</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-align="left" data-mobile-nav-style="classic" data-mobile-nav-shceme="gray" data-mobile-header-scheme="gray" data-mobile-nav-breakpoint="1199">
    <div id="wrap">
        <header class="main-header main-header-overlay" data-sticky-header="true" data-sticky-options='{ "stickyTrigger": "first-section" }'>
            <div class="mainbar-wrap">
                <div class="container-fluid mainbar-container">
                    <div class="mainbar">
                        <div class="row mainbar-row align-items-lg-stretch">
                            <div class="col-md-3">
                                <div class="navbar-header">
                                    <a class="navbar-brand py-3" href="index-charity.html" rel="home">
                                        <span class="navbar-brand-inner">
                                            <img class="logo-sticky logo-sticky-cust" src="<?= base_url() ?>assets_front/images/logo-tegal.png" alt="tegal">
                                            <img class="mobile-logo-default logo-sticky-cust" src="<?= base_url() ?>assets_front/images/logo-tegal.png" alt="tegal">
                                            <img class="logo-default logo-sticky-cust" src="<?= base_url() ?>assets_front/images/logo-tegal.png" alt="tegal">
                                        </span>
                                    </a>
                                    <button type="button" class="navbar-toggle collapsed nav-trigger style-mobile" data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false" data-changeclassnames='{ "html": "mobile-nav-activated overflow-hidden" }'>
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="bars">
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="collapse navbar-collapse" id="main-header-collapse">
                                    <ul id="primary-nav" class="main-nav nav align-items-lg-stretch justify-content-lg-end main-nav-hover-fade-inactive d-md-flex d-block" data-submenu-options='{ "toggleType":"fade", "handler":"mouse-in-out" }' data-localscroll="true">
                                        <li>
                                            <a href="<?= base_url('covid') ?>" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">Intip Covid19</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://egov.phicos.co.id/surakarta/infrastruktur/" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">Intip Infrastruktur</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="is-active">
                                            <a href="<?= base_url() ?>" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">Beranda</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>peta" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">Peta</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>prioritas_pembangunan" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">Prioritas Pembangunan</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>regulasi" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">Regulasi</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0)" class="py-md-0 py-3">
                                                <span class="link-icon"></span>
                                                <span class="link-txt">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">
                                                        Data
                                                        <span class="submenu-expander">
                                                            <i class="fa fa-angle-down"></i>
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                            <ul class="nav-item-children">
                                                <li>
                                                    <a href="<?= base_url() ?>informasi-geospasial">
                                                        <span class="link-icon"></span>
                                                        <span class="link-txt">
                                                            <span class="link-ext"></span>
                                                            <span class="txt">
                                                                Informasi Geospasial
                                                                <span class="submenu-expander">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>album-peta">
                                                        <span class="link-icon"></span>
                                                        <span class="link-txt">
                                                            <span class="link-ext"></span>
                                                            <span class="txt">
                                                                Album Peta
                                                                <span class="submenu-expander">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>publikasi">
                                                        <span class="link-icon"></span>
                                                        <span class="link-txt">
                                                            <span class="link-ext"></span>
                                                            <span class="txt">
                                                                Publikasi
                                                                <span class="submenu-expander">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>statistik">
                                                        <span class="link-icon"></span>
                                                        <span class="link-txt">
                                                            <span class="link-ext"></span>
                                                            <span class="txt">
                                                                Statistik
                                                                <span class="submenu-expander">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-module">
                                    <a href="<?= base_url() ?>login" class="btn btn-md circle btn-bordered border-thick font-size-13 ltr-sp-025 font-weight-bold px-2 lh-115 px-2">
                                        <span>
                                            <span class="btn-txt">Login</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
