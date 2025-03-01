<script src="<?= base_url() ?>assets_front/js/leaflet-simple-map-screenshoter.js"></script>
<script>
    var map;
    var basemap = {};
    var active_basemap = 'osm';
    var zoom = 13;
    var layers = {};
    var search_marker = '';
    const xconfig = [];
    const xdata = [];
    const xalias = [];

    $(document).ready(function() {
        $('.bar_loader').hide();
        $('[data-toggle="collapse"]').click(function(e) {
            let id = $(this).attr('data-id');
            let device = $(this).attr('data-device');
            let from_api = $(this).attr('data-from-api');
            if (typeof id != 'undefined' && id.length > 0) {
                let tag = device == 'large-screen' ? '#cl_' : '#mcl_';
                from_api == 'false' ? $(tag + id).toggle() : '';
            }
        })
        init_map();
        map.on('click', function(e) {
            $('input[name="cari_lat"]').val(e.latlng.lat);
            $('input[name="cari_lng"]').val(e.latlng.lng);
            $('input[name="m_cari_lat"]').val(e.latlng.lat);
            $('input[name="m_cari_lng"]').val(e.latlng.lng);
            search_marker != '' ? map.removeLayer(search_marker) : '';
        })
        $('#btn_map_menu').click(function() {
            $('.btn_map').fadeToggle();
            $('.side_option').hide('fade');
        });

        // $('#btn_map_home').click(function(){
        //     window.location.replace('<?= base_url() ?>');
        // })

        $('#btn_map_info').click(function() {

            if ($('#side_info').hasClass('active_option')) {
                $('.side_option').removeClass('active_option');
                $('#side_info').hide('slide');
            } else {
                $('.side_option').removeClass('active_option');
                $('#side_info').addClass('active_option');
                $('.side_option').hide('slide');
                $('.side_option.active_option').show('slide');
            }

        });

        $('#btn_map_layers').click(function() {

            if ($('#side_layers').hasClass('active_option')) {
                $('.side_option').removeClass('active_option');
                $('#side_layers').hide('slide');
            } else {
                $('.side_option').removeClass('active_option');
                $('#side_layers').addClass('active_option');
                $('.side_option').hide('slide');
                $('.side_option.active_option').show('slide');
            }

        });

        $('#btn_map_base').click(function() {
            if ($('#side_base').hasClass('active_option')) {
                $('.side_option').removeClass('active_option');
                $('#side_base').hide('slide');
            } else {
                $('.side_option').removeClass('active_option');
                $('#side_base').addClass('active_option');
                $('.side_option').hide('slide');
                $('.side_option.active_option').show('slide');
            }

        });

        $('.side_option_content').slimScroll({
            color: '#ff0000',
            height: '60vh'
        });


        $('#side_base input[type="radio"][name="base_map"]').change(function() {
            map.removeLayer(basemap[active_basemap]);
            active_basemap = $(this).val();
            basemap[active_basemap].addTo(map);
        })

        $('#btn_map_search').click(function(e) {
            if ($('#side_layers.large_screen input[type="checkbox"]:checked').length > 0) {
                // $('#kecamatan_search').val('').trigger('change');
                $('#layer_search').html('<option value="all_layer" selected>-- Tampilkan Semua Layer --</option>');
                $('#feature_search').attr('placeholder', 'Cari semua...');
            } else {
                // $('#kecamatan_search').val('').trigger('change');
                $('#layer_search').html('<option value="all_layer" selected>-- Tidak Ada Layer Aktif --</option>');
                $('#feature_search').attr('placeholder', 'Tidak ada data untuk dicari...');
            }
            $('#feature_name').html('');

            $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i) {
                $('#layer_search').append('<option value="' + $(this).attr('name') + '">' + $(this).attr('data-name') + '</option>');
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $(this).attr('data-name') + '</div>';
                $('#feature_name').append(nl);
                layers[$(this).attr('name')].eachLayer(l => {
                    let fn = '';
                    fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                    $('#feature_name').append(fn)
                })
            })
        })

        $('#layer_search').change(function(e) {
            $('#feature_name').html('');
            $('#feature_search').val('');
            if ($(this).val() == 'all_layer') {
                $('#feature_search').attr('placeholder', 'Cari semua...');
                $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i) {
                    let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $(this).attr('data-name') + '</div>';
                    $('#feature_name').append(nl);
                    layers[$(this).attr('name')].eachLayer(l => {
                        let fn = '';
                        fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                        fn += '<i class="si si-pointer"></i> ';
                        fn += l.feature.properties.name;
                        fn += '</div>';
                        $('#feature_name').append(fn)
                    })
                })
            } else {
                $('#feature_search').attr('placeholder', 'Cari ' + $('#layer_search option[value="' + $(this).val() + '"]')[0].text + '...');
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $('#layer_search option[value="' + $(this).val() + '"]')[0].text + '</div>';
                $('#feature_name').append(nl);
                layers[$(this).val()].eachLayer(l => {
                    let fn = '';
                    fn += '<div class="feature_name" data-name="' + $(this).val() + '" data-id="' + l._leaflet_id + '">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                    $('#feature_name').append(fn)
                })
            }
        })

        function generate_search() {
            $('#feature_name').html('');
            let cari = new RegExp($('#feature_search').val(), 'i');
            let cari_kec = new RegExp($('#kecamatan_search').val(), 'i');
            let cari_kel = new RegExp($('#kelurahan_search').val(), 'i');
            if ($('#layer_search').val() == 'all_layer') {
                $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i) {
                    let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $(this).attr('data-name') + '</div>';
                    $('#feature_name').append(nl);
                    layers[$(this).attr('name')].eachLayer(l => {
                        l.addTo(map);
                        if (
                            typeof l.feature.properties.name !== 'undefined' &&
                            typeof l.feature.properties.Kecamatan !== 'undefined' &&
                            typeof l.feature.properties.Kelurahan !== 'undefined' &&
                            l.feature.properties.name !== null &&
                            l.feature.properties.Kecamatan !== null &&
                            l.feature.properties.Kelurahan !== null
                        ) {
                            if (
                                l.feature.properties.name.match(cari) &&
                                l.feature.properties.Kecamatan.match(cari_kec) &&
                                l.feature.properties.Kelurahan.match(cari_kel)
                            ) {
                                let fn = '';
                                fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                                $('#feature_name').append(fn);
                            } else {
                                l.remove(map);
                            }
                        } else if (
                            typeof l.feature.properties.name !== 'undefined' &&
                            typeof l.feature.properties.Kecamatan !== 'undefined' &&
                            (typeof l.feature.properties.Kelurahan == 'undefined' || l.feature.properties.Kelurahan == '' || l.feature.properties.Kelurahan == null) &&
                            l.feature.properties.name !== null &&
                            l.feature.properties.Kecamatan !== null &&
                            $('#kelurahan_search').val() == ''
                        ) {
                            if (
                                l.feature.properties.name.match(cari) &&
                                l.feature.properties.Kecamatan.match(cari_kec)
                            ) {
                                let fn = '';
                                fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                                $('#feature_name').append(fn);
                            } else {
                                l.remove(map);
                            }
                        } else if (
                            typeof l.feature.properties.name !== 'undefined' &&
                            typeof l.feature.properties.Kelurahan !== 'undefined' &&
                            (typeof l.feature.properties.Kecamatan == 'undefined' || l.feature.properties.Kecamatan == '' || l.feature.properties.Kecamatan == null) &&
                            l.feature.properties.name !== null &&
                            l.feature.properties.Kelurahan !== null &&
                            $('#kecamatan_search').val() == ''
                        ) {
                            if (
                                l.feature.properties.name.match(cari) &&
                                l.feature.properties.Kelurahan.match(cari_kel)
                            ) {
                                let fn = '';
                                fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                                $('#feature_name').append(fn);
                            } else {
                                l.remove(map);
                            }
                        } else if (
                            typeof l.feature.properties.name !== 'undefined' &&
                            l.feature.properties.name !== null &&
                            $('#kecamatan_search').val() == '' &&
                            $('#kelurahan_search').val() == ''
                        ) {
                            if (
                                l.feature.properties.name.match(cari)
                            ) {
                                let fn = '';
                                fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                                $('#feature_name').append(fn);
                            } else {
                                l.remove(map);
                            }
                        } else {
                            l.remove(map);
                        }
                    })
                })
            } else {
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $('#layer_search option[value="' + $('#layer_search').val() + '"]')[0].text + '</div>';
                $('#feature_name').append(nl);
                layers[$('#layer_search').val()].eachLayer(l => {
                    l.addTo(map);
                    if (
                        typeof l.feature.properties.name !== 'undefined' &&
                        typeof l.feature.properties.Kecamatan !== 'undefined' &&
                        typeof l.feature.properties.Kelurahan !== 'undefined' &&
                        l.feature.properties.name !== null &&
                        l.feature.properties.Kecamatan !== null &&
                        l.feature.properties.Kelurahan !== null
                    ) {
                        if (
                            l.feature.properties.name.match(cari) &&
                            l.feature.properties.Kecamatan.match(cari_kec) &&
                            l.feature.properties.Kelurahan.match(cari_kel)
                        ) {
                            let fn = '';
                            fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                            $('#feature_name').append(fn);
                        } else {
                            l.remove(map);
                        }
                    } else if (
                        typeof l.feature.properties.name !== 'undefined' &&
                        typeof l.feature.properties.Kecamatan !== 'undefined' &&
                        (typeof l.feature.properties.Kelurahan == 'undefined' || l.feature.properties.Kelurahan == '' || l.feature.properties.Kelurahan == null) &&
                        l.feature.properties.name !== null &&
                        l.feature.properties.Kecamatan !== null &&
                        $('#kelurahan_search').val() == ''
                    ) {
                        if (
                            l.feature.properties.name.match(cari) &&
                            l.feature.properties.Kecamatan.match(cari_kec)
                        ) {
                            let fn = '';
                            fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                            $('#feature_name').append(fn);
                        } else {
                            l.remove(map);
                        }
                    } else if (
                        typeof l.feature.properties.name !== 'undefined' &&
                        typeof l.feature.properties.Kelurahan !== 'undefined' &&
                        (typeof l.feature.properties.Kecamatan == 'undefined' || l.feature.properties.Kecamatan == '' || l.feature.properties.Kecamatan == null) &&
                        l.feature.properties.name !== null &&
                        l.feature.properties.Kelurahan !== null &&
                        $('#kecamatan_search').val() == ''
                    ) {
                        if (
                            l.feature.properties.name.match(cari) &&
                            l.feature.properties.Kelurahan.match(cari_kel)
                        ) {
                            let fn = '';
                            fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                            $('#feature_name').append(fn);
                        } else {
                            l.remove(map);
                        }
                    } else if (
                        typeof l.feature.properties.name !== 'undefined' &&
                        l.feature.properties.name !== null &&
                        $('#kecamatan_search').val() == '' &&
                        $('#kelurahan_search').val() == ''
                    ) {
                        if (
                            l.feature.properties.name.match(cari)
                        ) {
                            let fn = '';
                            fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                            $('#feature_name').append(fn);
                        } else {
                            l.remove(map);
                        }
                    } else {
                        l.remove(map);
                    }

                })
            }
        }

        $('#kecamatan_search').change(function() {
            generate_search();
        })

        $('#kelurahan_search').change(function() {
            generate_search();
        })

        $('#feature_search').keyup(function() {
            generate_search();
        })


        var highlight = {
            color: '#ff0000',
            fillColor: '#ff7777',
            weight: 3,
            opacity: 1
        }

        var last_clicked = false;
        var last_options = false;

        $('#feature_name').on('click', '.feature_name', function(e) {
            // console.log('clicked: ',
            //     layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]
            // )

            let l = layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')];

            // map.flyTo()

            if (l.feature.geometry.type == 'Point') {
                // console.log(l.feature.geometry.type)
                // console.log('latlng: ',l._latlng.toBounds());
                // let bounds = l._latlng.toBounds();
                // let center = bounds.getCenter();
                // console.log('center: ',center);
                let center = l._latlng;

                map.flyTo(center, 18);
            } else if (l.feature.geometry.type == 'LineString') {
                // console.log(l.feature.geometry.type)
                // let bounds = layers[$(this).attr('data-name')].getBounds();
                // let center = bounds.getCenter();
                let center = l._latlngs[(l._latlngs.length / 2)];
                // console.log(layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')].options);

                if (last_clicked != false) {
                    // console.log('last',last_clicked);

                    last_clicked.setStyle({
                        color: last_clicked.feature.properties.stroke,
                        fillColor: last_clicked.feature.properties.fill,
                        weight: last_clicked.feature.properties.stroke_width,
                        opacity: last_clicked.feature.properties.stroke_opacity
                    });
                }

                // setTimeout(function(){
                last_clicked = l;
                l.setStyle(highlight);
                map.flyTo(center, 17);
                // },100)



            } else if (l.feature.geometry.type == 'Polygon') {
                let center = l._latlngs[0][0];
                if (last_clicked != false) {
                    // console.log('last',last_clicked);

                    last_clicked.setStyle({
                        color: last_clicked.feature.properties.stroke,
                        fillColor: last_clicked.feature.properties.fill,
                        weight: last_clicked.feature.properties.stroke_width,
                        opacity: last_clicked.feature.properties.stroke_opacity
                    });
                }
                last_clicked = l;
                l.setStyle(highlight);
                map.flyTo(center, 17);
            }

        })

        $('#kecamatan_search, #kelurahan_search, #layer_search').select2();
        $('.search_layer').select2();
        $('.box_search').hide();
        $('.btn_search').click(function(e) {
            // console.log($(this));
            $('#box_search_' + $(this).attr('data-slug')).slideToggle();
        });

        // Mobile version

        $('#mobile_tabs a[href="#mobile_search"]').click(function(e) {
            // console.log('arf: ', $('#mobile_layers #side_layers input[type="checkbox"]:checked').length)
            if ($('#mobile_layers #side_layers input[type="checkbox"]:checked').length > 0) {
                $('#m_layer_search').html('<option value="all_layer" selected>-- Tampilkan Semua Layer --</option>');
                $('#m_feature_search').attr('placeholder', 'Cari semua...');
            } else {
                $('#m_layer_search').html('<option value="all_layer" selected>-- Tidak Ada Layer Aktif --</option>');
                $('#m_feature_search').attr('placeholder', 'Tidak ada data untuk dicari...');
            }
            $('#m_feature_name').html('');

            $('#mobile_layers #side_layers input[type="checkbox"]:checked').each(function(i) {

                $('#m_layer_search').append('<option value="' + $(this).attr('name') + '">' + $(this).attr('data-name') + '</option>');
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $(this).attr('data-name') + '</div>';
                $('#m_feature_name').append(nl);
                layers[$(this).attr('name')].eachLayer(l => {
                    let fn = '';
                    fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                    $('#m_feature_name').append(fn)
                })
            })
        })

        $('#m_layer_search').change(function(e) {
            $('#m_feature_name').html('');
            $('#m_feature_search').val('');
            if ($(this).val() == 'all_layer') {
                $('#m_feature_search').attr('placeholder', 'Cari semua...');
                $('#side_layers input[type="checkbox"]:checked').each(function(i) {
                    let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $(this).attr('data-name') + '</div>';
                    $('#m_feature_name').append(nl);
                    layers[$(this).attr('name')].eachLayer(l => {
                        let fn = '';
                        fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                        fn += '<i class="si si-pointer"></i> ';
                        fn += l.feature.properties.name;
                        fn += '</div>';
                        $('#m_feature_name').append(fn)
                    })
                })
            } else {
                $('#m_feature_search').attr('placeholder', 'Cari ' + $('#m_layer_search option[value="' + $(this).val() + '"]')[0].text + '...');
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $('#m_layer_search option[value="' + $(this).val() + '"]')[0].text + '</div>';
                $('#m_feature_name').append(nl);
                layers[$(this).val()].eachLayer(l => {
                    let fn = '';
                    fn += '<div class="feature_name" data-name="' + $(this).val() + '" data-id="' + l._leaflet_id + '">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                    $('#m_feature_name').append(fn)
                })
            }
        })

        $('#m_feature_search').keyup(function() {
            $('#m_feature_name').html('');
            let cari = new RegExp($(this).val(), 'i');
            if ($('#m_layer_search').val() == 'all_layer') {
                $('#side_layers input[type="checkbox"]:checked').each(function(i) {
                    let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $(this).attr('data-name') + '</div>';
                    $('#m_feature_name').append(nl);
                    layers[$(this).attr('name')].eachLayer(l => {

                        if (l.feature.properties.name !== null) {
                            if (l.feature.properties.name.match(cari)) {
                                let fn = '';
                                fn += '<div class="feature_name" data-name="' + $(this).attr('name') + '" data-id="' + l._leaflet_id + '">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                                $('#m_feature_name').append(fn);
                            }
                        }
                    })
                })
            } else {
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">' + $('#m_layer_search option[value="' + $('#m_layer_search').val() + '"]')[0].text + '</div>';
                $('#m_feature_name').append(nl);
                layers[$('#m_layer_search').val()].eachLayer(l => {

                    if (l.feature.properties.name !== null) {
                        if (l.feature.properties.name.match(cari)) {
                            let fn = '';
                            fn += '<div class="feature_name" data-name="' + $('#m_layer_search').val() + '" data-id="' + l._leaflet_id + '">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                            $('#m_feature_name').append(fn);
                        }
                    }

                })
            }
        })


        $('#m_feature_name').on('click', '.feature_name', function(e) {
            // console.log('clicked: ',
            //     map.layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]
            // )

            let l = layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')];

            // map.flyTo()

            if (l.feature.geometry.type == 'Point') {
                // console.log(l.feature.geometry.type)
                // console.log('latlng: ',l._latlng.toBounds());
                // let bounds = l._latlng.toBounds();
                // let center = bounds.getCenter();
                // console.log('center: ',center);
                let center = l._latlng;

                map.flyTo(center, 19);
            } else if (l.feature.geometry.type == 'LineString') {
                // console.log(l.feature.geometry.type)
                // let bounds = layers[$(this).attr('data-name')].getBounds();
                // let center = bounds.getCenter();
                let center = l._latlngs[(l._latlngs.length / 2)];
                // console.log('hello: ',map.layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]);
                // map.layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')].setStyle(highlight);
                map.flyTo(center, 18);
            } else if (l.feature.geometry.type == 'Polygon') {
                let center = l._latlngs[0][0];
                map.flyTo(center, 15);
            }

        })

        $('#m_layer_search').select2();
        $('.search_layer').select2();
        $('.box_search').hide();
        $('.btn_search').click(function(e) {
            // console.log($(this));
            $('#m_box_search_' + $(this).attr('data-slug')).slideToggle();
        });

        get_kecamatan('kecamatan_search');

        $('#kecamatan_search').change(function() {
            get_kelurahan($('#kecamatan_search').val(), 'kelurahan_search');
        })

        // Load extend Layer
        let has_clicked = {};
        let xgroup_peta = (res, data, append_to) => {
            let xgroup_name = '';
            if (data.layer) {
                xgroup_name += '<div style="margin-left:' + ((data.level - 0) * 10 + 20) + 'px">';
                xgroup_name += '<label class="css-control css-control-danger css-checkbox">';
                xgroup_name += '<input type="checkbox" class="css-control-input dynamic_layers cb_layer api_layer" name="' + res.prefix + '_' + data.id + '" id_layer="' + res.prefix + '_' + data.id + '" data-name="' + res.prefix + '_' + data.id + '" data-id="' + data.id + '">';
                xgroup_name += '<span class="css-control-indicator"></span> ' + data.name;
                xgroup_name += '</label></div>';
                xgroup_name += '<span style="display:none" class="bar_loader" data-name="<?= $lv['slug'] ?>"><svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 -25 100 100" preserveAspectRatio="xMidYMid" class="lds-facebook"><rect ng-attr-x="{{config.x1}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c1}}" x="17.5" y="30" width="15" height="40" fill="#ff0000"><animate attributeName="y" calcMode="spline" values="18;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate><animate attributeName="height" calcMode="spline" values="64;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s" repeatCount="indefinite"></animate></rect><rect ng-attr-x="{{config.x2}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c2}}" x="42.5" y="30" width="15" height="40" fill="#ff6f6f"><animate attributeName="y" calcMode="spline" values="20.999999999999996;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate><animate attributeName="height" calcMode="spline" values="58.00000000000001;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s" repeatCount="indefinite"></animate></rect><rect ng-attr-x="{{config.x3}}" ng-attr-y="{{config.y}}" ng-attr-width="{{config.width}}" ng-attr-height="{{config.height}}" ng-attr-fill="{{config.c3}}" x="67.5" y="30" width="15" height="40" fill="#ffd8d8"><animate attributeName="y" calcMode="spline" values="24;30;30" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate><animate attributeName="height" calcMode="spline" values="52;40;40" keyTimes="0;0.5;1" dur="1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="0s" repeatCount="indefinite"></animate></rect></svg></span>';

            } else {
                let l = () => {
                    xgroup_name = '';
                    xgroup_name += '<div style="font-size: normal; margin-left:' + ((data.level - 0) * 10) + 'px" data-toggle="collapse" data-target="#gl_' + res.prefix + '_' + data.id + '" data-id="' + data.id + '" data-from-api="true" data-device="large-screen"><i class="si si-pointer"></i> ' + data.name + ' <span id="cl_' + res.prefix + '_' + data.id + '" class="count_layer badge badge-pill badge-success">' + data.children + '</span></div>';
                    xgroup_name += '<div id="gl_' + res.prefix + '_' + data.id + '" class="collapse"></div>';
                    return xgroup_name;
                }

                let m = () => {
                    xgroup_name = '';
                    xgroup_name += '<div style="font-size: normal; margin-left:' + ((data.level - 0) * 10) + 'px" data-toggle="collapse" data-target="#mgl_' + res.prefix + '_' + data.id + '" data-id="' + data.id + '" data-from-api="true" data-device="mobile"><i class="si si-pointer"></i> ' + data.name + ' <span id="mcl_' + res.prefix + '_' + data.id + '" class="count_layer badge badge-pill badge-success">' + data.children + '</span></div>';
                    xgroup_name += '<div id="mgl_' + res.prefix + '_' + data.id + '" class="collapse"></div>';
                    return xgroup_name;
                }

                xgroup_name = screen_768_less(m, l);

            }
            let append_to_parent = $('#side_layers .layer_group_content');
            append_to_parent.find(append_to).append(xgroup_name);
        }

        $.ajax({
                url: '<?= base_urL() ?>api/extend_layers',
                type: 'GET',
                dataType: 'JSON'
            })
            .then(res => {
                Object.keys(res).map(v => {
                    v = res[v];
                    has_clicked[v.prefix] = [];
                    $.ajax({
                            url: v.url + v.default_param,
                            type: 'GET',
                            dataType: 'JSON'
                        })
                        .then(res => {
                            console.log('mapped', res);
                            let xjenis_peta = '<div id="' + res.prefix + '" class="jp" style="font-size: large"><b>' + res.jenis_peta + '</b></div>';
                            xjenis_peta += '<div id="' + res.prefix + '_list"></div>'
                            $('#side_layers .layer_group_content').append(xjenis_peta);
                            let append_to = '#' + res.prefix + '_list';

                            res.data.map(v => {
                                xgroup_peta(res, v, append_to);
                            })
                            // Extend layer on click
                            $('#side_layers .layer_group_content').children($('#' + res.prefix + '_list')).on('click', 'div[data-toggle="collapse"]', function() {
                                // console.log('clicked', has_clicked);
                                if (!has_clicked[v.prefix].includes($(this).attr('data-target'))) {
                                    has_clicked[v.prefix].push($(this).attr('data-target'));
                                    $.ajax({
                                            url: v.url + $(this).attr('data-id'),
                                            type: 'GET',
                                            dataType: 'JSON'
                                        })
                                        .then(ress => {
                                            let append_to = $(this).attr('data-target');
                                            ress.data.map(v => {
                                                xgroup_peta(ress, v, append_to);
                                            })
                                            return ress;
                                        })
                                        .then(ress => {
                                            $('.cb_layer.api_layer').change(function() {
                                                if ($(this).is(':checked')) {
                                                    $('span[data-name="' + $(this).attr('name') + '"]').show()
                                                    // let geojson_url = '<?= base_url() ?>peta/get_geojson/' + $(this).attr('id_layer');
                                                    let url = '<?= base_url() ?>peta/get_geojson/';
                                                    let prefix = ress.prefix;
                                                    let id = $(this).attr('data-id');
                                                    if (typeof layers[$(this).attr('name')] == 'undefined') {
                                                        get_map($(this), url, prefix, id);
                                                    } else {
                                                        layers[$(this).attr('name')].addTo(map);
                                                        $('.bar_loader').hide();
                                                    }

                                                    $(this).attr('checked', 'checked');
                                                } else {
                                                    map.removeLayer(layers[$(this).attr('name')]);
                                                    $(this).removeAttr('checked');
                                                }

                                            })
                                        })
                                }
                                let id = $(this).attr('data-id');
                                let device = $(this).attr('data-device');
                                let from_api = $(this).attr('data-from-api');
                                if (typeof id != 'undefined' && id.length > 0) {
                                    let tag = device == 'large-screen' ? '#cl_' : '#mcl_';
                                    let tag_parent = $('#side_layers .layer_group_content');
                                    from_api == 'true' ? tag_parent.find(tag + res.prefix + '_' + id).toggle() : '';
                                    $($(this).attr('data-target') + '.collapse').collapse('toggle');
                                    // console.log('arf:', tag + res.prefix + '_' + id, res);
                                }
                            })
                        })


                })
            })

    })

    function init_map() {
        map = L.map('map', {
            attributionControl: false,
            zoomControl: false
        }).setView([-7.568517689092, 110.82824680176], zoom);

        basemap = {
            osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
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
            esri_gray_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 17
            }),
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

        basemap[active_basemap].addTo(map);
        L.control.scale().addTo(map);
        L.simpleMapScreenshoter({
            screenName: 'intip_solo',
            hideElementsWithSelectors: ['.leaflet-control-zoom', '.leaflet-control-simpleMapScreenshoter', '.leaflet-control-layers'],
            position: 'bottomleft',
            caption: screenshot_caption
        }).addTo(map)

        function screenshot_caption() {
            let now = new Date(Date.now()).toLocaleDateString("id-ID")
            let checked_box = $('#side_layers input[type="checkbox"][checked="checked"]');
            let caption = `[${now}] Sistem Informasi PU Terpadu: `;
            if (checked_box.length > 0) {
                checked_box.map(v => {
                    caption += `${checked_box[v].dataset.name} | `
                })
            }
            return caption
        }

        // var osm_popup = L.popup();
        // $($('#side_layers.large_screen input[type="checkbox"]').get().reverse()).each(function(i){
        // $('#side_layers.large_screen input[type="checkbox"]').each(function(i) {
        //     var cb = $(this);
        //     // console.log($(this).attr('name'));

        //     var geojson_url = '';

        //     if ($(this).hasClass('default_layers')) {
        //         // console.log('default layers');
        //         geojson_url = '<?= base_url() ?>assets_front/geojson/' + $(this).attr('name') + '.json';
        //     } else if ($(this).hasClass('dynamic_layers')) {
        //         // console.log('dynamic layers')
        //         geojson_url = '<?= base_url() ?>peta/get_geojson/' + $(this).attr('id_layer');
        //     }
        //     // get_map(cb,geojson_url);
        // })

    }

    $('#btn_map_zoom_in').click(function() {
        zoom++
        map.setZoom(zoom);

    })

    $('#btn_map_zoom_out').click(function() {
        zoom--
        map.setZoom(zoom);

    })

    $('#btn_map_search').click(function() {

        if ($('#side_search').hasClass('active_option')) {
            $('.side_option').removeClass('active_option');
            $('#side_search').hide('slide');
        } else {
            $('.side_option').removeClass('active_option');
            $('#side_search').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    })

    $('#side_layers input[type="checkbox"]').change(function() {

        if ($(this).is(':checked')) {
            $('span[data-name="' + $(this).attr('name') + '"]').show()
            // let geojson_url = '<?= base_url() ?>peta/get_geojson/' + $(this).attr('id_layer');
            let url = '<?= base_url() ?>peta/get_geojson/';
            let prefix = 'db';
            let id = $(this).attr('id_layer');
            if (typeof layers[$(this).attr('name')] == 'undefined') {
                get_map($(this), url, prefix, id);
            } else {
                layers[$(this).attr('name')].addTo(map);
                $('.bar_loader').hide();
            }

            $(this).attr('checked', 'checked');
        } else {
            map.removeLayer(layers[$(this).attr('name')]);
            $(this).removeAttr('checked');
        }

    })

    $('#cari_latlng').click(function() {
        if (
            $('input[name="cari_lat"]').val() != null &&
            $('input[name="cari_lat"]').val() != '' &&
            $('input[name="cari_lat"]').val() != 0 &&
            $('input[name="cari_lat"]').val() != '0' &&
            $('input[name="cari_lng"]').val() != null &&
            $('input[name="cari_lng"]').val() != '' &&
            $('input[name="cari_lng"]').val() != 0 &&
            $('input[name="cari_lng"]').val() != '0'
        ) {
            search_marker != '' ? map.removeLayer(search_marker) : '';
            var lat = $('input[name="cari_lat"]').val();
            var lng = $('input[name="cari_lng"]').val()
            // console.log('lat: ', lat, 'lng: ', lng);
            map.flyTo([lat, lng], 16);
            search_marker = L.marker([lat, lng]).addTo(map);
            // setTimeout(() => {
            // map.removeLayer(search_marker);
            // }, 5000);

        } else {
            alert('Harap masukkan latitude & longitude');
        }


    })

    $('#m_cari_latlng').click(function() {
        if (
            $('input[name="m_cari_lat"]').val() != null &&
            $('input[name="m_cari_lat"]').val() != '' &&
            $('input[name="m_cari_lat"]').val() != 0 &&
            $('input[name="m_cari_lat"]').val() != '0' &&
            $('input[name="m_cari_lng"]').val() != null &&
            $('input[name="m_cari_lng"]').val() != '' &&
            $('input[name="m_cari_lng"]').val() != 0 &&
            $('input[name="m_cari_lng"]').val() != '0'
        ) {
            search_marker != '' ? map.removeLayer(search_marker) : '';
            var lat = $('input[name="m_cari_lat"]').val();
            var lng = $('input[name="m_cari_lng"]').val()
            // console.log('lat: ', lat, 'lng: ', lng);
            map.flyTo([lat, lng], 16);
            search_marker = L.marker([lat, lng]).addTo(map);
            // setTimeout(() => {
            // map.removeLayer(search_marker);
            // }, 5000);
        } else {
            alert('Harap masukkan latitude & longitude');
        }


    })

    function get_map(cb, geo_url, geo_prefix, geo_id) {

        function osm_style(f) {

            var fill_color = (typeof f.properties['fill'] != 'undefined') ? f.properties['fill'] : '#19bff0';
            var fill_opacity = (typeof f.properties['fill_opacity'] != 'undefined') ? f.properties['fill_opacity'] : 0.3;
            var stroke_color = (typeof f.properties['stroke'] != 'undefined') ? f.properties['stroke'] : '#19bff0';
            var stroke_opacity = (typeof f.properties['stroke_opacity'] != 'undefined') ? f.properties['stroke_opacity'] : 0.7;
            var stroke_weight = (typeof f.properties['stroke_width'] != 'undefined') ? f.properties['stroke_width'] : 2;
            var stroke_dash= (typeof f.properties['stroke_dash'] != 'undefined') ? f.properties['stroke_dash'] : '';

            switch (cb.attr('name')) {
                case 'batas_kabupaten':
                    fill_opacity = 0;
                    break;
                case 'batas_kecamatan':
                    fill_opacity = 0;
                    break;
                case 'batas_desa':
                    fill_opacity = 0;
                    break;
                default:

            }

            return {
                fillColor: fill_color,
                fillOpacity: fill_opacity,
                color: stroke_color,
                opacity: stroke_opacity,
                weight: stroke_weight,
                dashArray: stroke_dash
            }
        }

        function marker_icon(icon) {
            var icon = L.icon({
                iconUrl: '<?= base_url() ?>assets/uploads/marker_icon/' + icon + '.png',
                iconSize: [30, 30],
                popupAnchor: [0, -15]
            })
        }

        let osm_popup = L.popup();

        function osm_info(e) {
            // console.log(e)
            osm_popup
                // .setLatLng(e.latlng)
                .setLatLng({
                    lat: e.latlng.lat + 0.0002,
                    lng: e.latlng.lng
                })
            // .openOn(map);

            if (cb.hasClass('default_layers')) {
                osm_popup.setContent(e.layer.feature.properties.description);
                $('#info_content').html(e.layer.feature.properties.description);
                $('#mobile_info #info_content').html(e.layer.feature.properties.description);
            } else if (cb.hasClass('dynamic_layers')) {
                let o = e.layer.feature.properties;
                let content = '<table class="table table-striped">';


                generate_infografis(o);

                // console.log('o', o);
                Object.keys(o).map((v, i, a) => {
                    if (!['id_layer', 'id_opd', 'id_collection', 'stroke', 'stroke_opacity', 'stroke_width', 'stroke_dash', 'fill', 'fill_opacity', 'icon_name', 'page_detail', 'name', 'group'].includes(v)) {
                        if (v == 'nama_layer') {
                            content += '<tr><td colspan="3" style="font-size:larger; font-weight:bold;margin-bottom:5px;">';
                            content += '<div>' + o[v] + '</div>';
                            if (o.page_detail == 1) {

                                content += '<div style="margin: 1px; text-align:left;">';
                                content += '<a href="<?= base_url() ?>peta/informasi-detail/' + o.id_collection + '" class="btn btn-sm btn-rounded btn-outline-danger" target="_blank" title="Informasi Selengkapnya"><i class="si si-action-redo"></i></a>';

                            }
                            if (xdata[cb.attr('name')].length > 0) {
                                content += '<button class="btn btn-sm btn-rounded btn-outline-info btn_infografis" title="Infografis" style="margin-left: 5px;"><i class="si si-grid"></i></button>';
                                content += '</div>';
                            }

                            content += '</td><tr>';


                            // content += '<tr><td colspan="3" style="font-size:larger; font-weight:bold;margin-bottom:5px;">'+o[v]+'</td><tr>';
                            //bottons

                        } else {
                            content += '<tr><td>' + v + '</td><td>:</td><td>' + o[v] + '</td></tr>';
                        }

                    }

                })
                content += '</table>';
                
                // osm_popup.setContent(content);
                $('#info_content').html(content);
                $('#mobile_info #info_content').html(content);

            }

            $('.btn_infografis').click(function(e) {
                e.preventDefault();
                $('#modal_infografis').modal('show');
            })

            if (!$('#side_info').hasClass('active_option')) {
                $('#btn_map_info').trigger('click');
            }
if (xdata[cb.attr('name')].length > 0 && xconfig[cb.attr('name')].autoopen_infografis) {
                $('#modal_infografis').modal('show');
            } else {
                // console.log('xdata length: ', xdata.length, '| xconfig: ', xconfig[cb.attr('name')])
            }



            async function generate_infografis(d) {
                $('#modal_infografis_content').html('');
                // console.log(d);
                // let x = '';
                let ukuran = {
                    penuh: 12,
                    setengah: screen_768_less(12, 6)
                }

                let generate_canvas = xdata[cb.attr('name')].map((v, i, a) => {
                    return new Promise((res) => {
                        let x = '';
                        x += '<div class="kontainer_grup col-' + ukuran[v.ukuran_grup] + '">';
                        x += '<div class="judul_grup">' + v.judul_grup + '</div>';
                        x += '<div class="sub_judul_grup">' + v.sub_judul_grup + '</div>';
                        x += generate_group_data(cb.attr('name'), d, v.tipe_grup, i);
                        x += '</div>'
                        $('#modal_infografis_content').append(x);
                        res(i);
                    })
                })

                // Object.keys(d).map(v => {
                //     x += '<div>' + v + ': ' + d[v] + '</div>';
                // })

                Promise.all(generate_canvas)
                    .then((res) => {
                        res.map(v => {
                            let x = xdata[cb.attr('name')][v];
                            if (x.tipe_grup.substring(x.tipe_grup.length - 5, x.tipe_grup.length) == 'chart') {
                                // console.log('run generate chart: ',x.tipe_grup);
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
                            // tooltips: {
                            //     callback: {
                            //         label: function(x) {
                            //             console.log(x);
                            //             return x.yLabel;
                            //         }
                            //     }
                            // },
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
                            // tooltips: {
                            //     callback: {
                            //         label: function(x) {
                            //             console.log(x);
                            //             return x.yLabel;
                            //         }
                            //     }
                            // },
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
                            },
                            // tooltips: {
                            //     callback: {
                            //         label: function(x) {
                            //             console.log(x);
                            //             return x.yLabel;
                            //         }
                            //     }
                            // },
                            // scales: {
                            //     yAxes: [{
                            //         ticks: {
                            //             beginAtZero: true
                            //         }
                            //     }]
                            // }
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
                            },
                            // tooltips: {
                            //     callback: {
                            //         label: function(x) {
                            //             console.log(x);
                            //             return x.yLabel;
                            //         }
                            //     }
                            // },
                            // scales: {
                            //     yAxes: [{
                            //         ticks: {
                            //             beginAtZero: true
                            //         }
                            //     }]
                            // }
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
                            },
                            // tooltips: {
                            //     enabled: true,
                            //     callback: {
                            //         label: function(x) {
                            //             // console.log('aaabbb',x);
                            //             return x.xLabel;
                            //         }
                            //     }
                            // },
                            // scales: {
                            //     yAxes: [{
                            //         ticks: {
                            //             beginAtZero: true
                            //         }
                            //     }]
                            // }
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
                    let a = xdata[cb.attr('name')][i]['item_grup']['item_sort'];
                    let x = [];
                    a.map(v => {
                        x.push(get_random_color());
                    })

                    return x;
                }

                function get_chart_label(d, i) {
                    let x = xdata[cb.attr('name')][i]['judul_grup'];
                    return x;
                }

                function get_chart_labels(d, i) {
                    let a = xdata[cb.attr('name')][i]['item_grup']['item_sort'];
                    let b = xalias[cb.attr('name')];
                    let x = [];
                    a.map(v => {
                        let n = b[v]['alias_atribut_layer'] != null ? b[v]['alias_atribut_layer'].trim() != '' ? b[v]['alias_atribut_layer'] : b[v]['nama_atribut_layer'] : b[v]['nama_atribut_layer'];
                        x.push(n);
                    })
                    return x;
                }

                function get_chart_dataset_single(d, i) {
                    let a = xdata[cb.attr('name')][i]['item_grup']['item_sort'];
                    let b = xalias[cb.attr('name')];
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
                    let a = xdata[cb.attr('name')][i]['item_grup']['item_sort'];
                    let b = xalias[cb.attr('name')];
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
                    let a = xdata[cb.attr('name')][i]['item_grup']['item_sort'];
                    let b = xalias[cb.attr('name')];
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

            $('#mobile_tabs a[href="#mobile_info"]').trigger('click');
        }

        let geojson_url = geo_url + geo_prefix + '/' + geo_id;
        $.getJSON(geojson_url, function(data) {
            // console.log(data);
            // console.log('xconfig: ', data.xconfig);
            // console.log('xdata: ', data.xdata);
            // console.log('xalias: ', data.xalias);

            xconfig[cb.attr('name')] = data.xconfig;
            xdata[cb.attr('name')] = data.xdata;
            xalias[cb.attr('name')] = data.xalias;
            if (data.features.length > 0) {
                // console.log(geojson_url)
                // console.log(cb.attr('name'));

                layers[cb.attr('name')] = new L.geoJSON(data, {
                    style: osm_style,
                    pointToLayer: function(f, latlng) {
                        // console.log(f.properties.icon_name )
                        var icon_name = f.properties.icon_name != null && f.properties.icon_name != '' ? f.properties.icon_name : 'default';
                        var icon = L.icon({
                            iconUrl: '<?= base_url() ?>assets/uploads/marker_icon/' + icon_name + '.png',
                            iconSize: ['auto', 30],
                            popupAnchor: [0, -15]
                        })

                        return L.marker(latlng, {
                            icon: icon
                        });
                    }
                });

                if (cb.is(':checked')) {
                    // console.log(layers[cb.attr('name')])
                    layers[cb.attr('name')].addTo(map);
                }

                layers[cb.attr('name')].on('click', osm_info);
                // console.log(cb.attr('name'), ': ', layers[cb.attr('name')])
                $('.bar_loader').hide();
            }

        })
    }

    function get_kecamatan(id_select) {
        $.ajax({
                url: '<?= base_url() ?>peta/get_kecamatan',
                type: 'GET',
                dataType: 'JSON'
            })
            .then(res => {
                html = '<option value="">-- Semua Kecamatan --</option>';
                res.data.map(v => {
                    html += '<option value="' + v.nama + '">' + v.nama + '</option>';
                })
                $('#' + id_select).html(html);
            })
    }

    function get_kelurahan(nama_kec, id_select) {
        $.ajax({
                url: '<?= base_url() ?>peta/get_kelurahan',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    nama_kec: nama_kec
                }
            })
            .then(res => {
                html = '<option value="">-- Semua Kelurahan --</option>';
                res.data.map(v => {
                    html += '<option value="' + v.nama + '">' + v.nama + '</option>';
                })
                $('#' + id_select).html(html);
            })
    }

    function screen_768_less(a, b) {
        return window.screen.width <= 768 ? a : b;
    }
</script>