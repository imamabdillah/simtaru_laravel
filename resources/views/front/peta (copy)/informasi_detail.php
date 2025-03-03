<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>INTIP KOTA SURAKARTA</title>
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>favicon.png" type="image/x-icon" />
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>assets/front/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/fonts/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/owl.carousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/flexSlider/flexslider.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/css/shortcodes/shortcodesae52.css?v=5" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/styleae52.css?v=5" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/revolution/css/navigation.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_front/css/leaflet.css"/>
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body id="top" class="has-header-search">
    <header id="header" class="tt-nav transparent-header">
        <div class="header-sticky light-header">
            <div class="container">
                <!-- <div class="search-wrapper">
                    <div class="search-trigger light pull-right">
                        <div class='search-btn '></div>
                        <i class="material-icons">&#xE8B6;</i>
                    </div>
                    <i class="search-close material-icons">&#xE5CD;</i>
                    <div class="search-form-wrapper ">
                        <form action="#" class="white-form">
                            <div class="input-field">
                                <input type="text" name="search" id="search">
                                <label for="search" class="">Search Here...</label>
                            </div>
                            <button class="btn blue-grey darken-4 search-button waves-effect waves-light" type="submit"><i class="material-icons">&#xE8B6;</i></button>
                        </form>
                    </div>
                </div> -->
                <div id="materialize-menu" class="menuzord">
                    <a href="<?=base_url()?>" class="logo-brand">
                        <img class="logo-dark" src="<?=base_url()?>assets/front/img/logo-bappeda-dark.png" alt="" />
                        <img class="logo-light" src="<?=base_url()?>assets/front/img/logo-bappeda.png" alt="" />
                    </a>
                    <ul class="menuzord-menu light pull-right">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="<?=base_url()?>peta">Peta</a></li>
                        <!-- <li><a href="#">Peta</a>
                            <ul class="dropdown">
                                <li><a href="<?=base_url()?>peta/rencana-tata-ruang-wilayah">Rencana Tata Ruang Wilayah</a></li>
                                <li><a href="<?=base_url()?>peta/informasi-tata-ruang-wilayah">Informasi Tata Ruang Wilayah</a></li>
                            </ul>
                        </li> -->
                        <li><a href="<?=base_url()?>layanan">Layanan</a></li>
                        <li><a href="<?=base_url()?>regulasi">Regulasi</a></li>
                        <li><a href="#">Data</a>
                            <ul class="dropdown">
                                <li><a href="<?=base_url()?>informasi-geospasial">Informasi Geospasial</a></li>
                                <li><a href="<?=base_url()?>album-peta">Album Peta</a></li>
                                <li><a href="<?=base_url()?>publikasi">Publikasi</a></li>
                                <li><a href="<?=base_url()?>statistik">Statistik</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=base_url()?>login">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <section class="rev_slider_wrapper">
        <div class="rev_slider materialize-slider">
            <ul>

                <?php $foto = glob('./assets/uploads/foto_collection/'.$this->uri->segment(3).'/*.*');?>
                <?php foreach($foto as $f):?>
                    <?php $x = explode('/',$f);?>
                    <li data-transition="fade" data-slotamount="default" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="<?=base_url().'assets/uploads/foto_collection/'.$this->uri->segment(3).'/'.$x[5];?>" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Unique Design" data-description="">
                        <img src="<?=base_url().'assets/uploads/foto_collection/'.$this->uri->segment(3).'/'.$x[5];?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <div class="tp-overlay"></div>
                        <div class="tp-caption rev-heading text-extrabold white-text tp-resizeme" data-x="center" data-y="center" data-voffset="-50" data-fontsize="['60','60','60','45']" data-lineheight="['60','60','60','50']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap;"><div class="info_title" style="min-height:70px;"></div>
                        </div>
                        <div class="tp-caption tp-resizeme rev-subheading  white-text text-center" data-x="center" data-y="center" data-voffset="30" data-fontsize="['30','30','30','35']" data-lineheight="['30','30','30','50']" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; white-space: nowrap;"><div class="info_subtitle"></div></div>
                        <div class="tp-caption tp-resizeme rev-btn" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['130','130','130','130']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-style_hover="cursor:default;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1200" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;">
                        </div>
                    </li>
                <?php endforeach;?> 
                
            </ul>
        </div>
    </section>
    <section class="padding-top-110 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="info_deskripsi"><?=$deskripsi['deskripsi']?></div>
                </div>
            </div>
        </div>
    </section>

    <section class=" padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div id="map" style="height:500px; width: 100%;"></div>
                </div>
                <div class="col-lg-4">
                    <div id="map_detail" style="height:500px;">

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include_once(APPPATH.'views/front/layout/footer.php')?>
    <div id="preloader">
        <div class="preloader-position">
            <img src="<?=base_url()?>assets/front/img/logo-bappeda-dark.png" alt="logo">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>assets/front/js/jquery-2.1.3.min.js"></script>
    <script src="<?=base_url()?>assets/front/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/front/materialize/js/materialize.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.sticky.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/smoothscroll.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/imagesloaded.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.stellar.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.inview.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.shuffle.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/menuzord.js"></script>
    <script src="<?=base_url()?>assets/front/js/bootstrap-tabcollapse.min.js"></script>
    <script src="<?=base_url()?>assets/front/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>assets/front/flexSlider/jquery.flexslider-min.js"></script>
    <script src="<?=base_url()?>assets/front/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/scriptsae52.js?v=5"></script>
    <script src="<?=base_url()?>assets/front/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?=base_url()?>assets/front/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".materialize-slider").revolution({
            sliderType: "standard",
            sliderLayout: "fullscreen",
            delay: 9000,
            navigation: {
                keyboardNavigation: "on",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: "gyges",
                    enable: true,
                    hide_onmobile: false,
                    hide_onleave: true,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 10,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 10,
                        v_offset: 0
                    }
                }
            },
            responsiveLevels: [1240, 1024, 778, 480],
            gridwidth: [1240, 1024, 778, 480],
            gridheight: [700, 600, 500, 500],
            disableProgressBar: "on",
            parallax: {
                type: "mouse",
                origo: "slidercenter",
                speed: 2000,
                levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
            }

        });
    });
    </script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/front/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>assets_front/js/leaflet.js"></script>
    <?php include_once('informasi_detail_js.php');?>
</body> 
</html>