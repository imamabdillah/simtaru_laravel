(function () {
    const config = {};
    config.script = {};
    config.ready = {
        jquery: false,
        bootstrap: false,
        chartjs: false,
        leaflet: false,
        esri: false
    };
    config.style = {};
    config.base_url = 'https://appt.demoo.id/intip_solo/';
    config.regex = /^https\:\/\/appt\.demoo\.id\/intip_solo\/widget\/intip_map_widget\.js/g;
    // config.base_url = 'http://localhost/intip_2019/';
    // config.regex = /^http\:\/\/localhost\/intip_2019\/widget\/intip_map_widget\.js/g;

    config.auth = () => {
        const scripts = document.getElementsByTagName('script');
        for (let i = 0; i < scripts.length; i++) {
            if (scripts[i].src.match(config.regex)) {
                let split = scripts[i].src.split('?');
                config.script.src = scripts[i].src;
                config.script.access_token = split[1].split('=')[1];
            }
        }
        fetch(config.base_url + 'get_api/map_auth', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                href: window.location.href,
                access_token: config.script.access_token
            })
        })
            .then(res => {
                res.json()
                    .then(r => {
                        if (r.status == 'success') {
                            config.layers = r.layers;
                            console.log(config.layers);
                            config.init();
                        } else {
                            alert(r.message);
                        }
                    })

            })
    }

    config.init = async () => {
        const container = document.getElementById('intip_map_widget');
        let regex = /^intip-/g;
        config.jquery = {};
        config.bootstrap = {};
        config.chartjs = {};
        config.leaflet = {};
        config.esri = {};
        config.head = document.querySelector('head');
        config.script.dom = document.querySelector('script[src="' + config.script.src + '"]');

        Object.keys(container.attributes).map(v => {
            // config not style
            if (container.attributes[v].name.match(regex)) {
                let key = container.attributes[v].name.slice(6);
                let value = container.attributes[v].value
                switch (key) {
                    case 'jquery':
                        if (value) {
                            let jquery = document.createElement('script');
                            jquery.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js';
                            config.jquery.js = jquery;
                        } else {
                            config.jquery = null;
                        }
                        break;
                    case 'bootstrap':
                        if (value) {
                            let bootstrap_js = document.createElement('script');
                            bootstrap_js.src = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js';
                            let bootstrap_css = document.createElement('link');
                            bootstrap_css.rel = 'stylesheet';
                            bootstrap_css.href = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'

                            config.bootstrap.js = bootstrap_js;
                            config.bootstrap.css = bootstrap_css;

                        } else {
                            config.bootstrap = null;
                        }
                    case 'chartjs':
                        if (value) {
                            let chartjs_js = document.createElement('script');
                            chartjs_js.src = 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js';

                            let chartjs_css = document.createElement('link');
                            chartjs_css.rel = 'stylesheet';
                            chartjs_css.href = 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css';

                            config.chartjs.js = chartjs_js;
                            config.chartjs.css = chartjs_css;

                        } else {
                            config.chartjs = null;
                        }
                        break;
                    case 'leaflet':
                        if (value) {
                            let leaflet_js = document.createElement('script');
                            leaflet_js.src = config.base_url + 'assets_front/js/leaflet.js';

                            let leaflet_css = document.createElement('link');
                            leaflet_css.rel = 'stylesheet';
                            leaflet_css.href = config.base_url + 'assets_front/css/leaflet.css';

                            config.leaflet.js = leaflet_js;
                            config.leaflet.css = leaflet_css;

                        } else {
                            config.leaflet = null;
                        }
                        break;
                    case 'esri':
                        if (value) {
                            let esri_js = document.createElement('script');
                            esri_js.src = 'https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js';

                            config.esri.js = esri_js;

                        } else {
                            config.esri = null;
                        }
                        break;
                    default:
                        container.style[key] = value;
                        config.style[key] = value;
                }

            }
        })



        let load_jquery = async () => {
            if (config.jquery != null) {
                config.script.dom.before(config.jquery.js);
                config.jquery.js.onload = new Promise(async (r) => {
                    await load_scripts();
                    r(true);
                })

                return Promise.all([config.jquery.js.onload])
                    .then(res => {
                        return true;
                    })
            } else {
                config.ready.jquery = true;
                return await load_scripts();
            }
        }

        let load_scripts = async () => {

            config.ready.bootstrap = new Promise(res => {
                if (config.bootstrap != null) {
                    config.script.dom.before(config.bootstrap.js);
                    config.head.append(config.bootstrap.css);
                    config.bootstrap.js.onload = () => res(true);
                } else {
                    res(true);
                }
            })

            config.ready.chartjs = new Promise(res => {
                if (config.chartjs != null) {
                    config.script.dom.before(config.chartjs.js);
                    config.head.append(config.chartjs.css);
                    config.chartjs.js.onload = () => res(true);

                } else {
                    res(true);
                }
            })

            config.ready.leaflet = new Promise(res => {
                if (config.leaflet != null) {
                    config.script.dom.before(config.leaflet.js);
                    config.head.append(config.leaflet.css);
                    config.leaflet.js.onload = () => {
                        if (config.esri != null) {
                            config.script.dom.before(config.esri.js);
                            config.esri.js.onload = () => res(true);
                        } else {
                            res(true);
                        }
                    }
                } else {
                    if (config.esri != null) {
                        config.script.dom.before(config.esri.js);
                        config.esri.js.onload = () => res(true);

                    } else {
                        res(true);
                    }

                }
            })

            config.ready.intip_css = new Promise(res => {
                let intip_css = document.createElement('link');
                intip_css.rel = 'stylesheet';
                intip_css.href = config.base_url + 'widget/intip_map_widget.css';
                config.head.append(intip_css);
            })

            await Promise.all([config.ready.bootstrap, config.ready.chartjs, config.ready.leaflet])
                .then(res => {
                    // console.info('you good to go!')
                })
            return true;
        }

        let wait_jquery = await load_jquery();
        if (wait_jquery) {
            await config.create();
            config.map_init();
        } else {
            console.warn('Terjadi Kesalahan!');
        }
    }

    config.create = async () => {
        const container = $('#intip_map_widget');

        await fetch(config.base_url + 'widget/intip_map_modal.html', {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'text'
            }
        })
            .then(res => {
                return res.text();
            })
            .then(res => {
                $('body').append(res);
            })

        await fetch(config.base_url + 'widget/intip_map_sidebar.html', {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'text'
            }
        })
            .then(res => {
                return res.text();
            })
            .then(res => {
                container.append(res);
                $('#map').css({
                    height: config.style.height
                })
                return res;
            })
            .then(res => {
                let l = '';
                let loader = '<svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 -25 100 100" preserveAspectRatio="xMidYMid" class="lds-facebook"><rect ng-attr-x="{{config.x1}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c1}}" x="17.5" y="30" width="15" height="40" fill="#ff0000"><animate attributeName="y" calcMode="spline" values="18;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate><animate attributeName="height" calcMode="spline" values="64;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate></rect><rect ng-attr-x="{{config.x2}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c2}}" x="42.5" y="30" width="15" height="40" fill="#ff6f6f"><animate attributeName="y" calcMode="spline" values="20.999999999999996;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate><animate attributeName="height" calcMode="spline" values="58.00000000000001;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate></rect><rect ng-attr-x="{{config.x3}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c3}}" x="67.5" y="30" width="15" height="40" fill="#ffd8d8"><animate attributeName="y" calcMode="spline" values="24;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate><animate attributeName="height" calcMode="spline" values="52;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate></rect></svg>';

                if (config.layers.length > 0) {
                    config.layers.map(v => {
                        l += '<div class="intip_layer">';
                        l += '<label>';
                        l += '<input type="checkbox" class="intip_checkbox" layer-id="' + v.id_layer + '" />';
                        l += '<span class="intip_nama_layer">' + v.nama_layer + '</span>';
                        l += '</label>';
                        l += '<span class="intip_checkbox_loader" id="checkbox_loader_' + v.id_layer + '">' + loader + '</span>';
                        l += '</div>';
                    })
                } else {
                    l += '<div>Tidak ada layer</div>';
                }
                $('#intip_layers').html(l);
            })
            .then(() => {
                $('#intip_layers').on('change', '.intip_checkbox', (e) => {
                    console.log(layers)
                    let target_id = e.target.attributes['layer-id'].value;
                    let target_url = config.base_url + 'peta/get_geojson/db/' + target_id;

                    if ($(e.target).is(':checked')) {
                        console.log('checked')
                        if (typeof layers[target_id] == 'undefined') {
                            $('#checkbox_loader_' + target_id).show();
                            $.getJSON(target_url, (d) => {
                                render_layer(d, target_id);
                            })
                        } else {
                            layers[target_id].addTo(map)
                        }
                    } else {
                        console.log('not checked')
                        layers[target_id].remove(map);
                    }

                })
            })
    }


    let map;
    let layers = {};
    let xdata = {};
    let xconfig = {};
    let xalias = {};

    config.map_init = async () => {
        await map_init()
    }

    let map_init = async () => {
        map = L.map('map', {
            attributionControl: false,
            zoomControl: true
        }).setView([-7.568517689092, 110.82824680176], 13);
        basemap = {
            osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map),
            google_roadmap: L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_satellite: L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_hybrid: L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_terrain: L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            esri_world_imagery: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 17
            }),
            esri_world_street_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'),
            esri_world_topo_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'),
            citra_satelit: L.esri.imageMapLayer({
                url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/CITRASATELIT/JawaBaliNusra_2015_ImgServ1/ImageServer',
                attribution: 'Badan Informasi Geospasial'
            }),
            peta_rbi: L.esri.dynamicMapLayer({
                url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/IGD/RupabumiIndonesia/MapServer',
                attribution: 'Badan Informasi Geospasial'
            }),
            peta_rbi_opensource: L.tileLayer.wms('http://palapa.big.go.id:8080/geoserver/gwc/service/wms', {
                maxZoom: 20,
                layers: "basemap_rbi:basemap",
                format: "image/png",
                attribution: 'Badan Informasi Geospasial'
            })

        }
        L.control.layers(basemap).addTo(map);
    }

    let layer_style = (f) => {

        let fill_color = (typeof f.properties['fill'] != 'undefined' && f.properties['fill'] != null) ? f.properties['fill'] : '#19bff0';
        let fill_opacity = (typeof f.properties['fill_opacity'] != 'undefined' && f.properties['fill_opacity'] != null) ? f.properties['fill_opacity'] : 0.3;
        let stroke_color = (typeof f.properties['stroke'] != 'undefined' && f.properties['stroke'] != null) ? f.properties['stroke'] : '#19bff0';
        let stroke_opacity = (typeof f.properties['stroke_opacity'] != 'undefined' && f.properties['stroke_opacity'] != null) ? f.properties['stroke_opacity'] : 0.7;
        let stroke_weight = (typeof f.properties['stroke_width'] != 'undefined' && f.properties['stroke_width'] != null) ? f.properties['stroke_width'] : 2;

        return {
            fillColor: fill_color,
            fillOpacity: fill_opacity,
            color: stroke_color,
            opacity: stroke_opacity,
            weight: stroke_weight
        }
    }

    let marker_icon = (i) => {
        return L.icon({
            iconUrl: config.base_url + 'assets/uploads/marker_icon/' + i + '.png',
            iconSize: ['auto', 30],
            popupAnchor: [0, -15]
        })
    }

    let layer_info = (e, t) => {

        let o = e.layer.feature.properties;
        let content = '<table class="table table-striped">';

        generate_infografis(o,t);

        Object.keys(o).map((v, i, a) => {
            if (!['id_layer', 'id_opd', 'id_collection', 'stroke', 'stroke_opacity', 'stroke_width', 'fill', 'fill_opacity', 'icon_name', 'page_detail', 'name', 'group'].includes(v)) {

                if (v == 'nama_layer') {
                    content += '<tr><td colspan="3" style="font-size:larger; font-weight:bold;margin-bottom:5px;">';
                    content += '<div>' + o[v] + '</div>';
                    if (o.page_detail == 1) {

                        content += '<div style="margin: 1px; text-align:left;">';
                        content += '<a href="' + config.base_url + 'peta/informasi-detail/' + o.id_collection + '" class="btn btn-sm btn-rounded btn-outline-danger" target="_blank" title="Informasi Selengkapnya">Selengkapnya</a>';

                    }
                    if (xdata[t].length > 0) {
                        content += '<button class="btn btn-sm btn-rounded btn-outline-info btn_infografis" title="Infografis" style="margin-left: 5px;">Infografis</button>';
                        content += '</div>';
                    }

                    content += '</td><tr>';


                } else {
                    content += '<tr><td>' + v + '</td><td>:</td><td>' + o[v] + '</td></tr>';
                }

            }

        })
        content += '</table>';

        $('#intip_data').html(content);

        $('.btn_infografis').click(function (e) {
            e.preventDefault();
            $('#intip_modal_infografis').modal('show');
        })

        if (!$('#intip_data_tab').hasClass('active')) {
            $('#intip_data_tab').trigger('click');
        }

        if (xdata[t].length > 0 && xconfig[t].autoopen_infografis) {
            $('#intip_modal_infografis').modal('show');
        }

    }

    let generate_infografis = async (d,t) => {
        $('#intip_modal_infografis_content').html('');

        let ukuran = {
            penuh: 12,
            setengah: screen_768_less(12, 6)
        }

        let generate_canvas = xdata[t].map((v, i, a) => {
            return new Promise((res) => {
                let x = '';
                x += '<div class="kontainer_grup col-' + ukuran[v.ukuran_grup] + '">';
                x += '<div class="judul_grup">' + v.judul_grup + '</div>';
                x += '<div class="sub_judul_grup">' + v.sub_judul_grup + '</div>';
                x += generate_group_data(t, d, v.tipe_grup, i);
                x += '</div>'
                $('#intip_modal_infografis_content').append(x);
                res(i);
            })
        })

        Promise.all(generate_canvas)
            .then((res) => {
                res.map(v => {
                    let x = xdata[t][v];
                    if (x.tipe_grup.substring(x.tipe_grup.length - 5, x.tipe_grup.length) == 'chart') {
                        generate_chart[x.tipe_grup](d, v);
                    }

                })
            })

        //generate chart

        const chart_dataset = {};

        function vertical_bar_chart(d, i) {
            var ctx = document.getElementById('group_' + i);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: get_chart_labels(d, i),
                    datasets: true ? get_chart_dataset_single(d, i) : get_chart_dataset_multi(d, i)
                },
                options: {
                    legend: {
                        display: screen_768_less(false, true)
                    },
                    scales: {
                        yAxes: [{
                            display: screen_768_less(false, true),
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            display: screen_768_less(false, true),
                            ticks: {
                                minRotation: 0,
                                maxRotation: 90
                            }
                        }]
                    }
                }
            });
        }

        function horizontal_bar_chart(d, i) {
            var ctx = document.getElementById('group_' + i);
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: get_chart_labels(d, i),
                    datasets: true ? get_chart_dataset_single(d, i) : get_chart_dataset_multi(d, i)
                },
                options: {
                    legend: {
                        display: screen_768_less(false, true)
                    },
                    scales: {
                        yAxes: [{
                            display: screen_768_less(false, true),
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            display: screen_768_less(false, true)
                        }]
                    }
                }
            });
        }

        function pie_chart(d, i) {
            var ctx = document.getElementById('group_' + i);
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: get_chart_labels(d, i),
                    datasets: true ? get_chart_dataset_single(d, i) : get_chart_dataset_multi(d, i)
                },
                options: {
                    legend: {
                        display: screen_768_less(false, true)
                    }
                }
            });
        }

        function doughnut_chart(d, i) {
            var ctx = document.getElementById('group_' + i);
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: get_chart_labels(d, i),
                    datasets: true ? get_chart_dataset_single(d, i) : get_chart_dataset_multi(d, i)
                },
                options: {
                    legend: {
                        display: screen_768_less(false, true)
                    }
                }
            });
        }

        function radar_chart(d, i) {
            var ctx = document.getElementById('group_' + i);
            var myChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: get_chart_labels(d, i),
                    datasets: true ? get_chart_dataset_single(d, i) : get_chart_dataset_multi(d, i)
                },
                options: {
                    legend: {
                        display: screen_768_less(false, true)
                    }
                }
            });
        }

        const generate_chart = {
            vertical_bar_chart: vertical_bar_chart,
            horizontal_bar_chart: horizontal_bar_chart,
            pie_chart: pie_chart,
            doughnut_chart: doughnut_chart,
            radar_chart: radar_chart
        };

        function get_random_color() {
            // var letters = '0123456789ABCDEF'.split('');
            var letters = '89ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 8)];
            }
            return color;
        }

        function get_chart_colors(d, i) {
            let a = xdata[t][i]['item_grup']['item_sort'];
            let x = [];
            a.map(v => {
                x.push(get_random_color());
            })

            return x;
        }

        function get_chart_label(d, i) {
            let x = xdata[t][i]['judul_grup'];
            return x;
        }

        function get_chart_labels(d, i) {
            let a = xdata[t][i]['item_grup']['item_sort'];
            let b = xalias[t];
            let x = [];
            a.map(v => {
                let n = b[v]['alias_atribut_layer'] != null ? b[v]['alias_atribut_layer'].trim() != '' ? b[v]['alias_atribut_layer'] : b[v]['nama_atribut_layer'] : b[v]['nama_atribut_layer'];
                x.push(n);
            })
            return x;
        }

        function get_chart_dataset_single(d, i) {
            let a = xdata[t][i]['item_grup']['item_sort'];
            let b = xalias[t];
            let c = get_chart_colors(d, i);
            let x = [];
            let n = {}
            n['label'] = true ? '' : get_chart_labels(d, i);
            n['data'] = get_chart_data(d, i);
            n['backgroundColor'] = c;
            n['borderColor'] = c;
            n['borderWidth'] = 1;
            x.push(n);
            return x;
        }

        function get_chart_dataset_multi(d, i) {
            let a = xdata[t][i]['item_grup']['item_sort'];
            let b = xalias[t];
            let x = [];
            a.map(v => {
                let n = {}
                n['label'] = b[v]['alias_atribut_layer'] != null || b[v]['alias_atribut_layer'].trim() == '' ? b[v]['alias_atribut_layer'] : b[v]['nama_atribut_layer'];
                n['data'] = parseFloat(d[b[v]['nama_atribut_layer']].replace(',', '.').replace(' ', ''));
                n['backgroundColor'] = get_random_color();
                n['borderColor'] = get_random_color();
                n['borderWidth'] = 1;

                x.push(n);
            })
            return x;
        }

        function get_chart_data(d, i) {
            let a = xdata[t][i]['item_grup']['item_sort'];
            let b = xalias[t];
            let x = [];
            a.map(v => {
                // console.log(d, b[v]['nama_atribut_layer'])
                let n = parseFloat(d[b[v]['nama_atribut_layer']].replace(',', '.').replace(' ', ''));
                x.push(n);
            })
            return x;
        }

        function generate_group_data(cn, fp, gt, i) {
            // cn: combobox name
            // fp: feature properties
            // gt: group type
            // i: index group
            // return x: div html

            let x;
            // console.log('gt', gt)
            switch (gt) {

                // Tipe Table
                case 'table':
                    x = generate_data_table(cn, fp, i);
                    break;
                // Tipe Table
                case 'vertical_bar_chart':
                case 'horizontal_bar_chart':
                case 'pie_chart':
                case 'doughnut_chart':
                case 'radar_chart':
                    x = generate_data_chart(cn, fp, i);
                    break;
                default:
                    x = '<div class="data_grup"></div>';

            }

            return x;

        }

        function generate_data_table(cn, fp, i) {
            // console.log('table_testxx: ', xdata[cn][i]['judul_grup']);
            let sort = xdata[cn][i]['item_grup']['item_sort'];
            let x = '<div class="data_grup">';
            x += '<table id="group_' + i + '" class="table table-sm">';
            sort.map(v => {
                x += '<tr>';
                x += '<td>' + (xalias[cn][v]['alias_atribut_layer'] != null ? (xalias[cn][v]['alias_atribut_layer'].trim() != '' ? xalias[cn][v]['alias_atribut_layer'] : xalias[cn][v]['nama_atribut_layer']) : xalias[cn][v]['nama_atribut_layer']) + '</td>';
                x += '<td>: ' + fp[xalias[cn][v]['nama_atribut_layer']] + '</td>';
                x += '</tr>';
            })
            x += '</table>';
            x += '</div>';
            return x;
        }

        function generate_data_chart(cn, fp, i) {
            // console.log('chart_testxx: ', xdata[cn][i]['judul_grup']);
            let sort = xdata[cn][i]['item_grup']['item_sort'];
            let x = '<div class="data_grup">';
            x += '<canvas class="col-12" id="group_' + i + '" style="min-height:300"></canvas>';
            x += '</div>';
            return x;
        }

    }

    let screen_768_less = (a, b) => {
        return window.screen.width <= 768 ? a : b;
    }

    let render_layer = (d, t) => {
        xconfig[t] = d.xconfig;
        xdata[t] = d.xdata;
        xalias[t] = d.xalias
        if (d.features.length > 0) {

            layers[t] = new L.geoJSON(d, {
                style: layer_style,
                pointToLayer: function (f, latlng) {
                    let icon_name = f.properties.icon_name != null && f.properties.icon_name != '' ? f.properties.icon_name : 'default';
                    return L.marker(latlng, {
                        icon: marker_icon(icon_name)
                    });
                }
            });

            layers[t].addTo(map);

            layers[t].on('click', (f) => {
                layer_info(f, t)
            });
            $('#checkbox_loader_' + t).hide();
        }
    }


    config.auth();


})()
