<style>
    #data_per_layer {
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
    #data_per_halaman_detail {
        width: 100%;
        height: 400px;
    }

    chart_box {
        min-height: 300px;
    }
</style>

<main id="content" class="content">
    <div class="container py-5">
        <h4 class="text-center mb-5">Informasi Statistik INTIP Kota Surakarta</h4>

        <div class="row">
            <div class="col-12 chart_box">
                <div>Total Data Per Layer</div>
                <div class="chart_item" id="data_per_layer"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 chart_box">
                <div>Layer Per OPD</div>
                <div class="chart_item" id="layer_per_opd"></div>
            </div>
            <div class="col-md-6 chart_box">
                <div>Data Per OPD</div>
                <div class="chart_item" id="data_per_opd"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 chart_box">
                <div>Layer Per Grup Layer</div>
                <div class="chart_item" id="layer_per_grup_layer"></div>
            </div>
            <div class="col-md-6 chart_box">
                <div>Data Per Grup Layer</div>
                <div class="chart_item" id="data_per_grup_layer"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 chart_box">
                <div>Layer Per Jenis Peta</div>
                <div class="chart_item" id="layer_per_jenis_peta"></div>
            </div>
            <div class="col-md-6 chart_box">
                <div>Data Per Jenis Peta</div>
                <div class="chart_item" id="data_per_jenis_peta"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 chart_box">
                <div>Layer Per Status</div>
                <div class="chart_item" id="data_per_status"></div>
            </div>
            <div class="col-md-6 chart_box">
                <div>Data Per Halaman Detail</div>
                <div class="chart_item" id="data_per_halaman_detail"></div>
            </div>
        </div>

    </div>
</main>