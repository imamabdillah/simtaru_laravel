
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

        <div class="hamenu valign">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-links">
                            <ul class="main-menu rest">
                                <li>
                                    <div class="o-hidden">
                                        <a href="<?= base_url('home') ?>"><span class="nm">01.</span>Beranda</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="o-hidden">
                                        <a href="<?= base_url('peta') ?>" class="link animsition-link"><span class="nm">02.</span>Peta</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="o-hidden">
                                        <span class="link dmenu"><span class="nm">03.</span>Data </span>
                                    </div>
                                    <div class="sub-menu">
                                        <ul class="rest">
                                            <li>
                                                <div class="o-hidden">
                                                    <span class="sub-link back"><i class="pe-7s-angle-left"></i> Kembali</span>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="rest">
                                                    <li>
                                                        <div class="o-hidden">
                                                            <a href="informasi-geospasial.html" class="sub-link animsition-link">Informasi Geospasial</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="o-hidden">
                                                            <a href="javascript:void(0);" class="sub-link animsition-link">Link 1</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="o-hidden">
                                                            <a href="javascript:void(0);" class="sub-link animsition-link">Link 2</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="o-hidden">
                                        <a href="regulasi.html" class="link animsition-link"><span class="nm">04.</span>Regulasi</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="o-hidden">
                                        <a href="https://ministry.phicos.co.id/tegal/login" class="link animsition-link"><span class="nm">05.</span>Login</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==================== End Navgition ==================== -->

        <!-- ==================== Start Slider ==================== -->
        <header class="full-showcase">
            <div class="swiper-container parallax-slider">
                <div class="swiper-wrapper">
                    <!-- slide 1 start -->
                    <div class="swiper-slide">
                        <div class="bg-img valign" data-background="<?= base_url('assets_front/images/gd-dpupr.jpeg') ?>" data-overlay-dark="3">
                            <div class="bg-overlay"></div>
                            <div class="container">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-6">
                                        <div class="caption">
                                            <h6 class="sub-title mb-10" data-swiper-parallax="-1000">Selamat Datang di Website</h6>
                                            <h2 class="mb-10">
                                                <a href="#">
                                                    <span data-swiper-parallax="-2000">Sistem Informasi PU Terpadu Kota Tegal</span>
                                                </a>
                                            </h2>
                                            <div data-swiper-parallax="-1000">
                                                <a href="<?= base_url('peta') ?>" class="btn btn btn-warning animsition-link mb-30">Lihat Peta</a>
                                                <form action="<?= base_url('pencarian/index') ?>">
                                                    <div class="search-box">
                                                        <input type="text" class="search-input" name="cari" placeholder="Search">
                                                        <button type="submit" class="search-btn">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="position-relative">
                                            <img src="<?= base_url('assets_front/images/gd-dpupr.jpeg') ?>" class="img-fluid mx-auto d-block position-relative rounded-cstm" style="z-index: 1;">
                                            <div class="illustrasi-border"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slide 1 ends -->
                    <!-- slide 2 start -->
                    <div class="swiper-slide">
                        <div class="bg-img valign" data-background="<?= base_url('assets_front/images/bg-2.jpg') ?>" data-overlay-dark="3">
                            <img class="w-100 position-absolute" src="https://img.freepik.com/free-vector/black-wavy-lines-background_78370-2010.jpg?w=1380&amp;t=st=1690782791~exp=1690783391~hmac=a42d47d99b3db7d7dc46fd1d2c56c6063a02269d996c459bc7728018daef9243" alt="" style="mix-blend-mode: color-burn; opacity: .85;">
                            <div class="bg-overlay"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="caption">
                                            <h6 class="sub-title mb-10" data-swiper-parallax="-1000">Tentang Kami</h6>
                                            <h3>
                                                <a href="#">
                                                    <span data-swiper-parallax="-2000">Selamat Datang di Sistem Informasi PU Terpadu <b style="color: #143588; background-color: #fff; border-radius: 12px; padding: 5px;"> Kota Tegal </b></span>
                                                </a>
                                            </h3>
                                            <p class="mt-5">Sistem informasi yang di kelola DPUPR Kota Tegal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slide 2 ends -->
                    <!-- slide 3 start -->
                    <div class="swiper-slide">
                        <div class="bg-img valign" data-background="<?= base_url('assets/front_20232/images/bg/bg-1.jpg') ?>" data-overlay-dark="3">
                            <div class="bg-overlay"></div>
                            <div class="container">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-12">
                                        <div class="caption">
                                            <h6 class="sub-title mb-10" data-swiper-parallax="-1000">Kontak Kami</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-cstm d-flex flex-direction-row flex-wrap">
                                    <div><img class="eclipse1 position-absolute" src="<?= base_url('assets_front/images/intip-tegal/Ellipse 3.svg') ?>" alt=""></div>
                                    <div><img class="eclipse2 position-absolute" src="<?= base_url('assets_front/images/intip-tegal/Ellipse 3.svg') ?>" alt=""></div>
                                    <div class="row p-5">
                                        <div class="col-lg-4 br-right-cstm mb-3">
                                            <h5 class="card-title">Layanan Contact Center</h5>
                                            <div class="card-text mt-3">
                                                <p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill me-2" viewBox="0 0 16 16">
                                                    <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z"></path>
                                                    <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z"></path>
                                                    </svg>dpukotategal@gmail.com
                                                </p>
                                                <p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill me-2" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path>
                                                    </svg>(0283) 356353
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 br-right-cstm mb-3">
                                            <h5 class="card-title">Link Terkait</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item ps-0" style="border: none;"> <a href="https://dpupr.tegalkota.go.id/" class="text-link">Website DPUPR Kota Tegal</a>
                                                </li>
                                                <li class="list-group-item ps-0" style="border: none;"> <a href="https://www.tegalkota.go.id/" class="text-link">Website Tegal Kota</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <h5 class="card-title">Social Media</h5>
                                            <div class="col-12 soc-med my-3">
                                                <a href="https://www.instagram.com/dpupr_kota_tegal/" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- slide 3 ends -->
                </div>
                <!-- slider setting -->
                <div class="swiper-controls">
                    <div class="swiper-button-next swiper-nav-ctrl cursor-pointer">
                        <div>
                            <span>Next Slide</span>
                        </div>
                        <div><i class="fas fa-chevron-right"></i></div>
                    </div>
                    <div class="swiper-button-prev swiper-nav-ctrl cursor-pointer">
                        <div><i class="fas fa-chevron-left"></i></div>
                        <div>
                            <span>Prev Slide</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </header>
        <!-- ==================== End Slider ==================== -->

    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/front_20232') ?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('assets/front_20232') ?>/js/jquery-migrate-3.4.0.min.js"></script>

    <!-- plugins -->
    <script src="<?= base_url('assets/front_20232') ?>/js/plugins.js"></script>
    <script src="<?= base_url('assets/front_20232') ?>/js/ScrollTrigger.min.js"></script>
    <script src="<?= base_url('assets/front_20232') ?>/js/animsition.min.js"></script>

    <!-- custom scripts -->
    <script src="<?= base_url('assets/front_20232') ?>/js/scripts.js"></script>

</body>

</html>

                