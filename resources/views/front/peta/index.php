<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMPUTER | DPUPR Kota Tegal</title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="<?= base_url('assets/'); ?>favicon.png" type="image/x-icon" /> -->

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="shortcut icon" href="<?= base_url() ?>assets-peta/images/logo-kota-tegal-favicon.png">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/leaflet.measure.css">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>_assets_front/css/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

    <link rel="stylesheet" id="css-main" href="<?= base_url() ?>assets/css/codebase.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>_assets_front/css/custom.css">
    <style>
        #myfooter {
            position: fixed;
            width: 100%;
            bottom: 0px;
            z-index: 1000;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }

        /* #myfooter {
            position: fixed;
            width: 100%;
            bottom: 120px;
            z-index: 1000;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        } */


        #side_layers [data-toggle="collapse"] {
            padding: 5px;
        }

        #side_layers [data-toggle="collapse"]:hover {
            cursor: pointer;
            color: #e9a837;
            font-weight: bolder;
        }

        #side_layers .jp {
            margin-top: 20px;
        }

        .feature_name:hover {
            font-weight: bold;
            color: #e9a837;
            cursor: pointer;
        }

        #modal_infografis_content {
            padding-top: 50px;
            padding-bottom: 20px;
        }

        #modal_infografis_content .kontainer_grup {
            /* border: 1px solid #bababa; */
            border-radius: 8px;
            padding: 5px 15px;
            margin-bottom: 20px;
        }

        #modal_infografis_content .judul_grup {
            text-align: center;
            color: #767676;
            font-size: 18px;
            font-weight: bolder;
            margin-bottom: 7px;
        }

        #modal_infografis_content .sub_judul_grup {
            text-align: center;
            color: #9a9a9a;
        }

        .mfp-wrap {
            z-index: 1055 !important;
            background-color: rgba(0, 0, 0, .7);
        }

        .content-header {
            height: auto;
            flex-direction: column;
            align-items: start;

            gap: 24px;
        }

        .content-header-section {
            gap: 8px;
        }

        .side_option {
            left: 111px;
            top: 130px;
        }

        #logo {
            background: #2a1e1a;
            margin-right: -25px;
            margin-top: 25px;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 0;
        }

        #page-header {
            pointer-events: none;
        }

        #page-header .content-header-section {
            pointer-events: auto;
        }

        .leaflet-ruler {
            background-color: #2666a8 !important;
        }
    </style>
</head>

<body>
    <div id="page-container" class="page-header-fixed page-header-glass">

        <div id="page-header">
            <div class="content-header p-0">

                <div id="logo" class="content-header-section position-relative m-0" style="background: rgb(49 91 147); padding: 10px; font-family: 'Poppins', sans-serif; left: 0">
                    <div class="row">
                        <div class="col-2" style="padding-left: 20px;"><img src="<?= base_url() ?>assets-peta/images/logo-kota-tegal-favicon.png" alt=""></div>
                        <div class="col-10 d-md-none d-lg-block" style="padding-right: 00px;padding-top: 3px">
                            <h3 style="color: #ffffff; font-family: 'Poppins', sans-serif;">SIMPUTER</h3>
                            <div style="color: #ffffff; font-size: larger; margin-top: -20px">
                                Sistem Informasi Pekerjaan Umum Terpadu
                            </div>
                        </div>

                    </div>
                </div>

                <div id="peta-section">
                    <div class="interface-2">
                        <div class="d-flex zoom" style="gap: 5px;">
                            <button id="btn_map_current" type="button" class="btn btn-lg btn_map" title="Lokasi Terkini">
                                <i class="si si-paper-plane"></i>
                            </button>
                            <button id="btn_map_zoom_in" type="button" class="btn btn-lg btn_map" title="Perbesar peta">
                                <i class="si si-magnifier-add"></i>
                            </button>
                            <button id="btn_map_zoom_out" type="button" class="btn btn-lg btn_map" title="Perkecil peta">
                                <i class="si si-magnifier-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="content-header-section d-flex flex-column pl-4">
                    <a href="<?= base_url() ?>" id="btn_map_home" class="btn btn-lg  btn_map mr-10" title="Kembali ke beranda">
                        <i class="si si-home"></i>
                    </a>
                    <!-- <button id="btn_map_zoom_in" type="button" class="btn btn-lg btn_map mr-10" title="Perbesar peta">
                        <i class="si si-magnifier-add"></i>
                    </button>
                    <button id="btn_map_zoom_out" type="button" class="btn btn-lg btn_map mr-10" title="Perkecil peta">
                        <i class="si si-magnifier-remove"></i>
                    </button> -->
                    <!-- <button id="btn_map_search" type="button" class="btn btn-lg btn_map mr-10" title="Pencarian">
                        <i class="si si-magnifier" style="pointer-events: none;"></i>
                    </button> -->
                    <button id="btn_map_info" type="button" class="btn btn-lg btn_map mr-10" title="Tampilkan Informasi Layer">
                        <i class="si si-info" style="pointer-events: none;"></i>
                    </button>
                    <button id="btn_map_layers" type="button" class="btn btn-lg btn_map mr-10" title="Tampilkan layer peta">
                        <i class="si si-layers" style="pointer-events: none;"></i>
                    </button>
                    <button id="btn_map_base" type="button" class="btn btn-lg btn_map mr-10" title="Pilih peta dasar">
                        <i class="si si-globe" style="pointer-events: none;"></i>
                    </button>
                    <button id="btn_map_menu" type="button" class="btn btn-lg" title="Tampil atau sembunyikan menu">
                        <i class="fa fa-tasks" style="pointer-events: none;"></i>
                    </button>
                </div>

            </div>
        </div>

        <div id="mobile_header" style="display:none; background-color: #2d91dc; font-family: 'Poppins', sans-serif;">
            <div class="row" style="margin-right:0px">
                <div class="col-2" style="padding-top: 30px; padding-left: 30px; "><img src="<?= base_url() ?>assets-peta/images/logo-kota-tegal-favicon.png" alt=""></div>
                <div class="col-10" style="padding-left: 10px;padding-top: 10px">
                    <h2 style="color: #ffffff;  font-family: 'Poppins', sans-serif;">SIM Tegal</h2>
                    <div style="color: #ffffff; font-size: larger; margin-top: -20px;">
                        <p>
                            Sistem Informasi Tata Ruang Kota Tegal
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="map"></div>
        <div id="side_layers" class="side_option large_screen" style="z-index: 2000; width: 100px;">
            <div class="side_option_title">Layer</div>
            <div class="side_option_content">
                <div class="layer_group">
                    <!-- <div class="layer_group_title">Layer Group</div> -->
                    <div class="layer_group_title"></div>
                    <div class="layer_group_content pl-10 pb-50">

                        <?php foreach ($list_layer as $jpk => $jpv) : ?>
                            <div class="jp" style="font-size: large"><b><?= $jpv['src']['nama_jenis_peta'] ?></b></div>
                            <?php foreach ($jpv['data'] as $glk => $glv) : ?>

                                <div style="font-size: normal; margin-left:10px" data-toggle="collapse" data-target="#gl_<?= $jpk . '_' . $glk ?>" data-id="<?= $jpk . '_' . $glk ?>" data-from-api="false" data-device="large-screen"><i class="si si-pointer"></i> <?= $glv['src']['nama_grup_layer'] ?> <span id="cl_<?= $jpk . '_' . $glk ?>" class="count_layer badge badge-pill badge-success"><?= count($glv['data']) ?></span></div>
                                <div id="gl_<?= $jpk . '_' . $glk ?>" class="collapse">
                                    <?php foreach ($glv['data'] as $lk => $lv) : ?>
                                        <div style="margin-left:30px">
                                            <label class="css-control css-control-warning css-checkbox">
                                                <input type="checkbox" class="css-control-input dynamic_layers cb_layer db_layer" name="<?= $lv['slug'] ?>" id_layer="<?= $lv['id'] ?>" data-name="<?= $lv['name'] ?>">
                                                <span class="css-control-indicator"></span> <?= $lv['name'] ?>
                                            </label>
                                            <span class="bar_loader" data-name="<?= $lv['slug'] ?>">
                                                <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 -25 100 100" preserveAspectRatio="xMidYMid" class="lds-facebook">
                                                    <rect ng-attr-x="{{config.x1}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c1}}" x="17.5" y="30" width="15" height="40" fill="#e9a837">
                                                        <animate attributeName="y" calcMode="spline" values="18;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate>
                                                        <animate attributeName="height" calcMode="spline" values="64;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate>
                                                    </rect>
                                                    <rect ng-attr-x="{{config.x2}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c2}}" x="42.5" y="30" width="15" height="40" fill="#e9a877">
                                                        <animate attributeName="y" calcMode="spline" values="20.999999999999996;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate>
                                                        <animate attributeName="height" calcMode="spline" values="58.00000000000001;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate>
                                                    </rect>
                                                    <rect ng-attr-x="{{config.x3}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c3}}" x="67.5" y="30" width="15" height="40" fill="#e9cdcd">
                                                        <animate attributeName="y" calcMode="spline" values="24;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate>
                                                        <animate attributeName="height" calcMode="spline" values="52;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate>
                                                    </rect>
                                                </svg>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>

                        <?php endforeach; ?>

                        <!-- end simonela -->
                    </div>

                </div>
            </div>
        </div>
        <div id="side_info" class="side_option">
            <div class="side_option_title">Info Layer</div>
            <div id="info_content" style="padding: 20px;" class="side_option_content"></div>
        </div>
        <div id="side_base" class="side_option">
            <div class="side_option_title"> Base Map</div>
            <div class="side_option_content">
                <div>
                    <!-- OSM -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="osm" checked>
                        <span class="css-control-indicator"></span> Open Street Map
                    </label>
                </div>
                <div>
                    <!-- GOOGLE ROADMAP -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="google_roadmap">
                        <span class="css-control-indicator"></span> Google Roadmap
                    </label>
                </div>
                <div>
                    <!-- GOOGLE SATELLITE -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="google_satellite">
                        <span class="css-control-indicator"></span> Google Satellite
                    </label>
                </div>
                <div>
                    <!-- GOOGLE HYBRID -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="google_hybrid">
                        <span class="css-control-indicator"></span> Google Hybrid
                    </label>
                </div>
                <div>
                    <!-- GOOGLE TERRAIN -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="google_terrain">
                        <span class="css-control-indicator"></span> Google Terrain
                    </label>
                </div>
                <div>
                    <!-- ESRI WORLD IMAGERY -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="esri_world_imagery">
                        <span class="css-control-indicator"></span> ESRI World Imagery
                    </label>
                </div>
                <div>
                    <!-- ESRI WORLD STREET MAP -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="esri_world_street_map">
                        <span class="css-control-indicator"></span> ESRI World Street Map
                    </label>
                </div>
                <div>
                    <!-- ESRI WORLD TOPO MAP-->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="esri_world_topo_map">
                        <span class="css-control-indicator"></span> ESRI World Topo Map
                    </label>
                </div>
                <div>
                    <!-- ESRI GRAY MAP-->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="esri_gray_map">
                        <span class="css-control-indicator"></span> ESRI Gray Map
                    </label>
                </div>
                <div>
                    <!-- Citra Satelit -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="citra_satelit">
                        <span class="css-control-indicator"></span> Citra Satelit
                    </label>
                </div>
                <div>
                    <!-- Rupa Bumi Indonesia -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="peta_rbi">
                        <span class="css-control-indicator"></span> Peta Rupa Bumi Indonesia
                    </label>
                </div>
                <div>
                    <!-- Rupa Bumi Indonesia Open Source -->
                    <label class="css-control css-control-warning css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="peta_rbi_opensource">
                        <span class="css-control-indicator"></span> Peta Rupa Bumi Indonesia Open Source
                    </label>
                </div>
            </div>
        </div>

        <div id="side_search" class="side_option">
            <div class="side_option_title">Pencarian Data Layer</div>
            <div class="side_option_content">
                <div style="margin-bottom: 5px">
                    <select name="kecamatan_search" id="kecamatan_search" style="width:100%">
                        <option value="">-- Semua Kecamatan--</option>
                    </select>
                </div>
                <div style="margin-bottom: 5px">
                    <select name="kelurahan_search" id="kelurahan_search" style="width:100%">
                        <option value="">-- Semua Kelurahan--</option>
                    </select>
                </div>
                <div style="margin-bottom: 5px">
                    <select name="layer_search" id="layer_search" style="width:100%"></select>
                </div>
                <div class="mt-10">
                    <input id="feature_search" type="text" class="form-control">
                </div>
                <div id="feature_name" class="mt-20"></div>
            </div>
        </div>

        <!-- mobile tabs -->
        <!-- Block Tabs Animated Fade -->
        <div id="mobile_tabs" class="block" style="display:none">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist" style="font-family: 'Poppins', sans-serif;">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>" onclick="location.replace('<?= base_url() ?>')"><i class="si si-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mobile_base_map"><i class="si si-globe"></i> Peta Dasar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#mobile_layers"><i class="si si-layers"></i> Layer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mobile_info"><i class="si si-info"></i> Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mobile_search"><i class="si si-magnifier"></i> Cari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#mobile_latlng"><i class="si si-pointer"></i> LatLng</a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden" style="font-family: 'Poppins', sans-serif;">
                <div class="tab-pane fade" id="mobile_base_map" role="tabpanel">
                    <div id="side_base">
                        <div>
                            <!-- OSM -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="osm" checked>
                                <span class="css-control-indicator"></span> Open Street Map
                            </label>
                        </div>
                        <div>
                            <!-- GOOGLE ROADMAP -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="google_roadmap">
                                <span class="css-control-indicator"></span> Google Roadmap
                            </label>
                        </div>
                        <div>
                            <!-- GOOGLE SATELLITE -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="google_satellite">
                                <span class="css-control-indicator"></span> Google Satellite
                            </label>
                        </div>
                        <div>
                            <!-- GOOGLE HYBRID -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="google_hybrid">
                                <span class="css-control-indicator"></span> Google Hybrid
                            </label>
                        </div>
                        <div>
                            <!-- GOOGLE TERRAIN -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="google_terrain">
                                <span class="css-control-indicator"></span> Google Terrain
                            </label>
                        </div>
                        <div>
                            <!-- ESRI WORLD IMAGERY -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="esri_world_imagery">
                                <span class="css-control-indicator"></span> ESRI World Imagery
                            </label>
                        </div>
                        <div>
                            <!-- ESRI WORLD STREET MAP -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="esri_world_street_map">
                                <span class="css-control-indicator"></span> ESRI World Street Map
                            </label>
                        </div>
                        <div>
                            <!-- ESRI WORLD TOPO MAP-->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="esri_world_topo_map">
                                <span class="css-control-indicator"></span> ESRI World Topo Map
                            </label>
                        </div>
                        <div>
                            <!-- Citra Satelit -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="citra_satelit">
                                <span class="css-control-indicator"></span> Citra Satelit
                            </label>
                        </div>
                        <div>
                            <!-- Rupa Bumi Indonesia -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="peta_rbi">
                                <span class="css-control-indicator"></span> Peta Rupa Bumi Indonesia
                            </label>
                        </div>
                        <div>
                            <!-- Rupa Bumi Indonesia Open Source -->
                            <label class="css-control css-control-warning css-radio">
                                <input type="radio" class="css-control-input" name="base_map" value="peta_rbi_opensource">
                                <span class="css-control-indicator"></span> Peta Rupa Bumi Indonesia Open Source
                            </label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="mobile_layers" role="tabpanel">
                    <div id="side_layers">
                        <div class="layer_group">
                            <div class="layer_group_title"></div>
                            <div class="layer_group_content pl-10">
                                <?php foreach ($list_layer as $jpk => $jpv) : ?>
                                    <div style="font-size: large"><b><?= $jpv['src']['nama_jenis_peta'] ?></b></div>
                                    <?php foreach ($jpv['data'] as $glk => $glv) : ?>
                                        <div style="font-size: normal; margin-left:10px" data-toggle="collapse" data-target="#mgl_<?= $jpk . '_' . $glk ?>" data-id="<?= $jpk . '_' . $glk ?>" data-device="mobile"><i class="si si-pointer"></i> <?= $glv['src']['nama_grup_layer'] ?> <span id="mcl_<?= $jpk . '_' . $glk ?>" class="count_layer badge badge-pill badge-success"><?= count($glv['data']) ?></span></div>
                                        <div id="mgl_<?= $jpk . '_' . $glk ?>" class="collapse">
                                            <?php foreach ($glv['data'] as $lk => $lv) : ?>
                                                <div style="margin-left:30px">
                                                    <label class="css-control css-control-warning css-checkbox">
                                                        <input type="checkbox" class="css-control-input dynamic_layers" name="<?= $lv['slug'] ?>" id_layer="<?= $lv['id'] ?>" data-name="<?= $lv['name'] ?>">
                                                        <span class="css-control-indicator"></span> <?= $lv['name'] ?>
                                                    </label>
                                                    <span class="bar_loader" data-name="<?= $lv['slug'] ?>">
                                                        <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 -25 100 100" preserveAspectRatio="xMidYMid" class="lds-facebook">
                                                            <rect ng-attr-x="{{config.x1}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c1}}" x="17.5" y="30" width="15" height="40" fill="#e9a837">
                                                                <animate attributeName="y" calcMode="spline" values="18;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate>
                                                                <animate attributeName="height" calcMode="spline" values="64;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate>
                                                            </rect>
                                                            <rect ng-attr-x="{{config.x2}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c2}}" x="42.5" y="30" width="15" height="40" fill="#e9a877">
                                                                <animate attributeName="y" calcMode="spline" values="20.999999999999996;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate>
                                                                <animate attributeName="height" calcMode="spline" values="58.00000000000001;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate>
                                                            </rect>
                                                            <rect ng-attr-x="{{config.x3}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c3}}" x="67.5" y="30" width="15" height="40" fill="#e9cdcd">
                                                                <animate attributeName="y" calcMode="spline" values="24;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate>
                                                                <animate attributeName="height" calcMode="spline" values="52;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate>
                                                            </rect>
                                                        </svg>
                                                    </span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="mobile_info" role="tabpanel">
                    <div id="info_content"></div>
                </div>
                <div class="tab-pane fade" id="mobile_latlng" role="tabpanel">
                    <div>
                        <label for="m_cari_lat">Latitude</label>
                        <input class="form-control" type="number" name="m_cari_lat">
                    </div>
                    <div>
                        <label for="m_cari_lng">Longitude</label>
                        <input class="form-control" type="number" name="m_cari_lng">
                    </div>

                    <div class="mt-20 mb-20">
                        <button id="m_cari_latlng" class="btn btn-map col-12" style="background: #2d91dc; color:#ffffff"><i class="si si-magnifier"></i> Cari</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="mobile_search" role="tabpanel">
                    <div>
                        <select name="m_layer_search" id="m_layer_search" style="width:100%"></select>
                    </div>
                    <div class="mt-10">
                        <input id="m_feature_search" type="text" class="form-control">
                    </div>
                    <div id="m_feature_name" class="mt-20"></div>
                </div>
            </div>
        </div>
        <!-- END Block Tabs Animated Fade -->

    </div>
    <div id="myfooter" style="margin-left: 110px;">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
            </div>
            <input class="form-control" type="hidden" id="krk_klik_lat" name="krk_lat">
            <input class="form-control" type="hidden"  id="krk_klik_lng" name="krk_lng">
            
            <div class="col-lg-3 col-sm-12 mb-sm-2 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text text-white" style="font-family: 'Poppins', sans-serif; background: #2e5d8f!important;">
                        Latitude:
                    </div>
                </div>
                <input class="form-control" type="number" name="cari_lat">
            </div>
            <div class="col-lg-3 col-sm-12 mb-sm-2 input-group ">
                <div class="input-group-prepend">
                    <div class="input-group-text text-white" style="font-family: 'Poppins', sans-serif; background: #2e5d8f!important;">
                        Longitude:
                    </div>
                </div>
                <input class="form-control" type="number" name="cari_lng">
            </div>

            <div class="col-lg-1 col-sm-12 pl-0">
                <button id="cari_latlng" class="btn btn-lg btn-map rounded" style="background: #2e5d8f!important; color:#ffffff;"><i class="si si-magnifier"></i> Cari</button>
            </div>
        </div>

    </div>

    <div class="modal" id="modal_infografis" tabindex="-1" role="dialog" aria-labelledby="modal-large" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
            <div class="modal-content" style="border-radius: 20px; border: 3px solid #2a1e1a;">
                <div class="block block-themed block-transparent mb-0">
                    <!-- <div class="block-header ">
                        <h3 class="block-title">Terms &amp; Conditions</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div> -->
                    <div id="modal_infografis_content" class="block-content row"></div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                        <i class="fa fa-check"></i> Perfect
                    </button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="modal_monitoring">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Monitoring</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body konten">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Bulan</th>
                                    <th>Target Fisik</th>
                                    <th>Realisasi Fisik</th>
                                    <th>Item Identifikasi</th>
                                    <th>Item Kejadian</th>
                                    <th>Ringan</th>
                                    <th>Sedang</th>
                                    <th>Berat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="modal_monitoring_foto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Foto Monitoring</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mr-0">
                        <div class="col-md-12">
                            <div class="zoom-gallery">
                                <div class="row konten">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="modal_layer_foto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Foto Layer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mr-0">
                        <div class="col-md-12">
                            <div class="zoom-gallery">
                                <div class="row konten">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal" id="modal_layer_perbaikan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Data Perbaikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body konten">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="modal_krk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi KRK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body konten">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="modal_ajukan_krk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajukan KRK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body konten">

                </div>
                <div class="modal-footer"> 
                </div>
            </div>
        </div>
    </div>


    <!-- JS -->
    <script src="<?= base_url() ?>_assets_front/js/leaflet.js"></script>
    <!-- <script src="<?= base_url() ?>_assets_front/js/leaflet-providers.js"></script> -->
    <script src="https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js" integrity="sha512-1tScwpjXwwnm6tTva0l0/ZgM3rYNbdyMj5q6RSQMbNX6EUMhYDE3pMRGZaT41zHEvLoWEK7qFEJmZDOoDMU7/Q==" crossorigin=""></script>
    <!-- <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE"></script> -->
    <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/select2/i18n/id.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/leaflet.measure.js"></script>
    <script src="<?= base_url(); ?>assets/js/codebase.js"></script>
    <?php include_once('index_js.php') ?>

</body>

</html>