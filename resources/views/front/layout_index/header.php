
<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="simputer, tegal, kota tegal">
    <meta name="description" content="Sistem Informasi PU Terpadu Kota Tegal">
    <meta name="author" content="">

    <!-- Title  -->
    <title>SIMPUTER | Kota Tegal</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/front_20232/') ?>images/favicon-tegal.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/front_20232/') ?>fonts/mona-sans/style.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/front_20232/') ?>css/plugins.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <!-- Core Style Css -->
    <link rel="stylesheet" href="<?= base_url('assets/front_20232/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/front_20232/') ?>css/custom.css">

</head>

<body>

    <div id="siteWrapper">

        <!-- ==================== Start Loading ==================== -->
        <div class="loader-wrap">
            <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
                <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
            </svg>

            <div class="loader-wrap-heading">
                <div class="load-text text-center">
                    <span>D</span>
                    <span>P</span>
                    <span>U</span>
                    <span>P</span>
                    <span>R</span><br>
                    <span>K</span>
                    <span>O</span>
                    <span>T</span>
                    <span>A</span>
                    <span></span>
                    <span>T</span>
                    <span>E</span>
                    <span>G</span>
                    <span>A</span>
                    <span>L</span>
                </div>
            </div>
        </div>
        <!-- ==================== End Loading ==================== -->

        <!-- ==================== Start progress-scroll-button ==================== -->
        <div class="progress-wrap cursor-pointer">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
        <!-- ==================== End progress-scroll-button ==================== -->

        <!-- ==================== Start Navgition ==================== -->
        <div id="navi" class="topnav">
            <div class="container">
                <div class="logo">
                    <a href="index.html"><img src="<?= base_url('assets/front_20232/') ?>images/logo-tegal.jpeg" alt="" height="55" class="logo-style"></a>
                </div>
                <div class="menu-icon cursor-pointer mr-35">
                    <ul class="navigation-menu d-none d-sm-block">
                        <li><a href="<?= base_url('home') ?>" class="sub-menu-item">Beranda</a></li>
                        <li><a href="<?= base_url('peta') ?>" class="sub-menu-item">Peta</a></li>
                        <!-- <li class="has-submenu parent-parent-menu-item">
                            <a href="index.html">Data</a><span class="menu-arrow"></span>
                            <ul class="submenu">
                                <li>
                                    <a href="informasi-geospasial.html">Informasi Geospasial</a>
                                </li>
                                <li>
                                    <a href="">Link 1</a>
                                </li>
                                <li>
                                    <a href="">Link 1</a>
                                </li>
                            </ul>
                        </li> -->
                        <li><a href="<?= base_url('regulasi') ?>" class="sub-menu-item">Regulasi</a></li>
                        <li><a href="<?= base_url('login') ?>" class="sub-menu-item btn btn btn-outline-warning p-2">Login</a></li>
                    </ul>
                    <span class="text d-md-none d-lg-none"><span class="word">Menu</span></span>
                    <span class="icon d-md-none d-lg-none">
                        <i></i>
                        <i></i>
                    </span>
                </div>
            </div>
        </div>

        