<script>
    // Data Per Layer
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/data_per_layer',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            am4core.ready(function() {
                am4core.useTheme(am4themes_material);
                am4core.useTheme(am4themes_animated);
                var chart = am4core.create('data_per_layer', am4charts.XYChart);
                chart.data = res.data;

                var category_axis = chart.xAxes.push(new am4charts.CategoryAxis());
                category_axis.dataFields.category = 'nama_layer';
                category_axis.renderer.grid.template.location = 0;
                category_axis.renderer.minGridDistance = 30;
                category_axis.renderer.labels.template.horizontalCenter = 'left';
                category_axis.renderer.labels.template.rotation = 45;
                // console.log(category_axis);

                var value_axis = chart.yAxes.push(new am4charts.ValueAxis());
                value_axis.logarithmic = true;
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = 'total';
                series.dataFields.categoryX = 'nama_layer';
                series.name = 'Layer';
                series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
                series.columns.template.fillOpacity = .8;

                chart.scrollbarX = new am4core.Scrollbar();
                chart.scrollbarX.parent = chart.topAxesContainer;
            })
        })

    // Layer Per OPD
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/layer_per_opd',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    let chart_container = am4core.create('layer_per_opd', am4core.Container);
                    let legend_container = am4core.create('layer_per_opd_legend', am4core.Container);
                    chart_container.width = am4core.percent(100);
                    chart_container.height = am4core.percent(100);
                    chart_container.layout = 'vertical';
                    legend_container.width = am4core.percent(100);
                    legend_container.height = am4core.percent(100);
                    legend_container.layout = 'vertical';

                    // var chart = am4core.create('layer_per_opd', am4charts.PieChart);
                    var chart = new am4charts.PieChart;

                    chart.parent = chart_container;


                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'nama_opd';

                    chart.innerRadius = am4core.percent(0);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    // pie_series.alignLabels = false;
                    // pie_series.labels.template.bent = true;
                    // pie_series.labels.template.radius = 3;
                    // pie_series.labels.template.padding(0,0,0,0);

                    // pie_series.ticks.template.disabled = true;

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;

                    chart.legend.parent = legend_container;

                    chart.events.on("datavalidated", resizeLegend);
                    chart.events.on("maxsizechanged", resizeLegend);

                    chart.legend.events.on("datavalidated", resizeLegend);
                    chart.legend.events.on("maxsizechanged", resizeLegend);

                    function resizeLegend(ev) {
                        document.getElementById("layer_per_opd_legend").style.height = chart.legend.contentHeight + "px";
                    }
                })
            } else {
                $('#layer_per_opd').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Data Per OPD
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/data_per_opd',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    let chart_container = am4core.create('data_per_opd', am4core.Container);
                    let legend_container = am4core.create('data_per_opd_legend', am4core.Container);
                    chart_container.width = am4core.percent(100);
                    chart_container.height = am4core.percent(100);
                    chart_container.layout = 'vertical';
                    legend_container.width = am4core.percent(100);
                    legend_container.height = am4core.percent(100);
                    legend_container.layout = 'vertical';
                    // var chart = am4core.create('data_per_opd', am4charts.PieChart);

                    var chart = new am4charts.PieChart;

                    chart.parent = chart_container;

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'nama_opd';

                    chart.innerRadius = am4core.percent(0);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;

                    chart.legend.parent = legend_container;

                    chart.events.on("datavalidated", resizeLegend);
                    chart.events.on("maxsizechanged", resizeLegend);

                    chart.legend.events.on("datavalidated", resizeLegend);
                    chart.legend.events.on("maxsizechanged", resizeLegend);

                    function resizeLegend(ev) {
                        document.getElementById("data_per_opd_legend").style.height = chart.legend.contentHeight + "px";
                    }
                })
            } else {
                $('#data_per_opd').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Layer Per Grup Layer
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/layer_per_grup_layer',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    let chart_container = am4core.create('layer_per_grup_layer', am4core.Container);
                    let legend_container = am4core.create('layer_per_grup_layer_legend', am4core.Container);
                    chart_container.width = am4core.percent(100);
                    chart_container.height = am4core.percent(100);
                    chart_container.layout = 'vertical';
                    legend_container.width = am4core.percent(100);
                    legend_container.height = am4core.percent(100);
                    legend_container.layout = 'vertical';


                    // var chart = am4core.create('layer_per_grup_layer', am4charts.PieChart);

                    var chart = new am4charts.PieChart;

                    chart.parent = chart_container;

                    // chart.width = am4core.percent(100);
                    // chart.height = am4core.percent(100);

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'nama_grup_layer';

                    chart.innerRadius = am4core.percent(30);
                    // chart.innerRadius = 100;

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;
                    chart.data = res.data;

                    chart.legend = new am4charts.Legend();

                    chart.legend.parent = legend_container;

                    chart.events.on("datavalidated", resizeLegend);
                    chart.events.on("maxsizechanged", resizeLegend);

                    chart.legend.events.on("datavalidated", resizeLegend);
                    chart.legend.events.on("maxsizechanged", resizeLegend);

                    function resizeLegend(ev) {
                        document.getElementById("layer_per_grup_layer_legend").style.height = chart.legend.contentHeight + "px";
                    }

                })
            } else {
                $('#layer_per_grup_layer').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Data Per Grup Layer
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/data_per_grup_layer',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    let chart_container = am4core.create('data_per_grup_layer', am4core.Container);
                    let legend_container = am4core.create('data_per_grup_layer_legend', am4core.Container);
                    chart_container.width = am4core.percent(100);
                    chart_container.height = am4core.percent(100);
                    chart_container.layout = 'vertical';
                    legend_container.width = am4core.percent(100);
                    legend_container.height = am4core.percent(100);
                    legend_container.layout = 'vertical';

                    // var chart = am4core.create('data_per_grup_layer', am4charts.PieChart);

                    var chart = new am4charts.PieChart;

                    chart.parent = chart_container;

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'nama_grup_layer';

                    chart.innerRadius = am4core.percent(30);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;

                    chart.legend.parent = legend_container;

                    chart.events.on("datavalidated", resizeLegend);
                    chart.events.on("maxsizechanged", resizeLegend);

                    chart.legend.events.on("datavalidated", resizeLegend);
                    chart.legend.events.on("maxsizechanged", resizeLegend);

                    function resizeLegend(ev) {
                        document.getElementById("data_per_grup_layer_legend").style.height = chart.legend.contentHeight + "px";
                    }
                })
            } else {
                $('#data_per_grup_layer').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Layer Per Jenis Peta
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/layer_per_jenis_peta',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    var chart = am4core.create('layer_per_jenis_peta', am4charts.PieChart);

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'nama_jenis_peta';

                    chart.innerRadius = am4core.percent(0);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;
                })
            } else {
                $('#layer_per_jenis_peta').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Data Per Jenis Peta
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/data_per_jenis_peta',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    var chart = am4core.create('data_per_jenis_peta', am4charts.PieChart);

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'nama_jenis_peta';

                    chart.innerRadius = am4core.percent(0);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;
                })
            } else {
                $('#data_per_jenis_peta').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Data Per Status
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/data_per_status',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    var chart = am4core.create('data_per_status', am4charts.PieChart);

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'status';

                    chart.innerRadius = am4core.percent(30);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;
                })
            } else {
                $('#data_per_status').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })

    // Data Per Halaman Detail
    $.ajax({
            url: '<?= base_url() ?>admin/beranda/data_per_halaman_detail',
            type: 'GET',
            dataType: 'JSON'
        })
        .then(res => {
            if (res.data.length > 0) {
                am4core.ready(function() {
                    am4core.useTheme(am4themes_material);
                    am4core.useTheme(am4themes_animated);
                    var chart = am4core.create('data_per_halaman_detail', am4charts.PieChart);

                    var pie_series = chart.series.push(new am4charts.PieSeries());
                    pie_series.dataFields.value = 'total';
                    pie_series.dataFields.category = 'halaman_detail';

                    chart.innerRadius = am4core.percent(30);

                    pie_series.slices.template.stroke = am4core.color("#fff");
                    pie_series.slices.template.strokeWidth = 2;
                    pie_series.slices.template.strokeOpacity = 1;
                    pie_series.slices.template
                        .cursorOverStyle = [{
                            "property": "cursor",
                            "value": "pointer"
                        }];

                    pie_series.labels.template.disabled = true;

                    var shadow = pie_series.slices.template.filters.push(new am4core.DropShadowFilter);
                    shadow.opacity = 0;

                    var hover_state = pie_series.slices.template.states.getKey("hover");

                    var hover_shadow = hover_state.filters.push(new am4core.DropShadowFilter);
                    hover_shadow.opacity = 0.7;
                    hover_shadow.blur = 5;

                    chart.legend = new am4charts.Legend();

                    chart.data = res.data;
                })
            } else {
                $('#data_per_halaman_detail').html('<div style="margin-left:20px;font-size:smaller">Tidak ada data untuk ditampilkan.</div>');
            }
        })
</script>