<style>
    #data_per_layer{
        width: 100%;
        height: 500px;
    }

    #layer_per_opd,
    #data_per_opd,
    #layer_per_grup_layer,
    #data_per_grup_layer,
    #layer_per_jenis_peta,
    #data_per_jenis_peta,
    #data_per_status,
    #data_per_halaman_detail
    {
        width: 100%;
        height: 400px;
    }

    .icon-box {
        background-color: #556EE6;
        border-radius: 100%;
        width: 48px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .icon-box i {
        /* display: block; */
        font-size: 20px;
    }

    .icon-box .line {
        width: 8px;
        height: 64px;
        transform: rotate(45deg);
        background-color: rgba(255, 255, 255, 0.1);
        position: absolute;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row gutters-tiny invisible" data-toggle="appear">
            <!-- Row #1 -->
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-flex icon-box">
                            <div class="line"></div>
                            <i class="fa fa-users text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?=$chart['user']?>">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">User</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-flex icon-box">
                            <div class="line"></div>
                            <i class="fa fa-institution text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="<?=$chart['opd']?>">0</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">OPD</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-flex icon-box">
                            <div class="line"></div>
                            <i class="si si-layers text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?=$chart['layer']?>">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Layer</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-flex icon-box">
                            <div class="line"></div>
                            <i class="fa fa-database text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?=$chart['data_layer']?>">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Data Layer</div>
                    </div>
                </a>
            </div>
            <!-- END Row #1 -->
        </div>

        <div class="col-lg-12">
            <!-- Bars Chart -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Total Data Per Layer</h3>
                </div>
                <div class="block-content block-content-full text-center">
                    <!-- Bars Chart Container -->
                    <div id="data_per_layer"></div>
                </div>
            </div>
            <!-- END Bars Chart -->
        </div>

        <div class="row gutters-tiny invisible" data-toggle="appear">
            <!-- Row #2 -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Layer Per Bidang
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="layer_per_opd"></div>
                            <div id="layer_per_opd_legend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Data Per Bidang
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="data_per_opd"></div>
                            <div id="data_per_opd_legend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Row #2 -->
        </div>

        <div class="row gutters-tiny invisible" data-toggle="appear">
            <!-- Row #3 -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Layer Per Grup Layer
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="layer_per_grup_layer"></div>
                            <div id="layer_per_grup_layer_legend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Data Per Grup Layer
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="data_per_grup_layer"></div>
                            <div id="data_per_grup_layer_legend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Row #3 -->
        </div>

        <div class="row gutters-tiny invisible" data-toggle="appear">
            <!-- Row #4 -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Layer Per Jenis Peta
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="layer_per_jenis_peta"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Data Per Jenis Peta
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="data_per_jenis_peta"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Row #4 -->
        </div>

        <div class="row gutters-tiny invisible" data-toggle="appear">
            <!-- Row #5 -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Layer Per Status
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="data_per_status"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Data Per Halaman Detail
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <div id="data_per_halaman_detail"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Row #5 -->
        </div>

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Page JS Plugins -->
<script src="assets/js/plugins/amcharts4/charts.js"></script>
<script src="assets/js/plugins/amcharts4/themes/material.js"></script>
<script src="assets/js/plugins/amcharts4/themes/animated.js"></script>
<script src="assets/js/plugins/amcharts4/core.js"></script>
