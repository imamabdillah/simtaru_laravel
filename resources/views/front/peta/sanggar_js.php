<script>
var map;
var basemap = {};
var active_basemap = 'osm';
var zoom = 13;
var layers = {};
var search_marker = '';

$(document).ready(function(){
    $('.bar_loader').hide();
    init_map();
    map.on('click',function(e){
        $('input[name="cari_lat"]').val(e.latlng.lat);
        $('input[name="cari_lng"]').val(e.latlng.lng);
        $('input[name="m_cari_lat"]').val(e.latlng.lat);
        $('input[name="m_cari_lng"]').val(e.latlng.lng);
        search_marker != '' ? map.removeLayer(search_marker) : '';
    })
    $('#btn_map_menu').click(function(){
        $('.btn_map').fadeToggle();
        $('.side_option').hide('fade');
    });

    $('#btn_map_home').click(function(){
        window.location.replace('<?=base_url()?>');
    })

    $('#btn_map_info').click(function(){

        if($('#side_info').hasClass('active_option'))
        {
            $('.side_option').removeClass('active_option');
            $('#side_info').hide('slide');
        }
        else
        {
            $('.side_option').removeClass('active_option');
            $('#side_info').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });

    $('#btn_map_layers').click(function(){

        if($('#side_layers').hasClass('active_option'))
        {
            $('.side_option').removeClass('active_option');
            $('#side_layers').hide('slide');
        }
        else
        {
            $('.side_option').removeClass('active_option');
            $('#side_layers').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });

    $('#btn_map_base').click(function(){
        if($('#side_base').hasClass('active_option'))
        {
            $('.side_option').removeClass('active_option');
            $('#side_base').hide('slide');
        }
        else
        {
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

    
    $('#side_base input[type="radio"][name="base_map"]').change(function(){
        map.removeLayer(basemap[active_basemap]);
        active_basemap = $(this).val();
        basemap[active_basemap].addTo(map);
    })

    $('#btn_map_search').click(function(e){
        if($('#side_layers.large_screen input[type="checkbox"]:checked').length > 0)
        {
            $('#layer_search').html('<option value="all_layer" selected>-- Tampilkan Semua Layer --</option>');
            $('#feature_search').attr('placeholder','Cari semua...');
        }
        else
        {
            $('#layer_search').html('<option value="all_layer" selected>-- Tidak Ada Layer Aktif --</option>');
            $('#feature_search').attr('placeholder','Tidak ada data untuk dicari...');
        }
        $('#feature_name').html('');

        $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i){
            $('#layer_search').append('<option value="'+$(this).attr('name')+'">'+$(this).attr('data-name')+'</option>');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
            $('#feature_name').append(nl);
            layers[$(this).attr('name')].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#feature_name').append(fn)
            })
        })  
    })

    $('#layer_search').change(function(e){
        $('#feature_name').html('');
        $('#feature_search').val('');
        if($(this).val() == 'all_layer')
        {
            $('#feature_search').attr('placeholder','Cari semua...');
            $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#feature_name').append(nl);
                layers[$(this).attr('name')].eachLayer(l=>{
                    let fn  = '';
                        fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                        fn += '<i class="si si-pointer"></i> ';
                        fn += l.feature.properties.name;
                        fn += '</div>';
                    $('#feature_name').append(fn)
                })
            })  
        }
        else
        {
            $('#feature_search').attr('placeholder','Cari '+$('#layer_search option[value="'+$(this).val()+'"]')[0].text+'...');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#layer_search option[value="'+$(this).val()+'"]')[0].text+'</div>';
            $('#feature_name').append(nl);
            layers[$(this).val()].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).val()+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#feature_name').append(fn)
            })
        }
    })

    $('#feature_search').keyup(function(){
        $('#feature_name').html('');
        let cari = new RegExp($(this).val(), 'i');
        if($('#layer_search').val() == 'all_layer')
        {
            $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#feature_name').append(nl);
                layers[$(this).attr('name')].eachLayer(l=>{
                    
                    if(l.feature.properties.name !== null)
                    {
                        if(l.feature.properties.name.match(cari))
                        {
                            let fn  = '';
                                fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                            $('#feature_name').append(fn);
                        }
                    }
                })
            })  
        }
        else
        {
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#layer_search option[value="'+$('#layer_search').val()+'"]')[0].text+'</div>';
            $('#feature_name').append(nl);
            layers[$('#layer_search').val()].eachLayer(l=>{
                
                if(l.feature.properties.name !== null)
                {
                    if(l.feature.properties.name.match(cari))
                    {
                        let fn  = '';
                            fn += '<div class="feature_name" data-name="'+$('#layer_search').val()+'" data-id="'+l._leaflet_id+'">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                        $('#feature_name').append(fn);
                    }
                }
                
            })
        }
    })
    
    $('#feature_name').on('click','.feature_name',function(e){
        console.log('clicked: ',
            layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]
        )
        
        let l = layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')];
        
        // map.flyTo()
        
        if(l.feature.geometry.type == 'Point')
        {
            // console.log(l.feature.geometry.type)
            // console.log('latlng: ',l._latlng.toBounds());
            // let bounds = l._latlng.toBounds();
            // let center = bounds.getCenter();
            // console.log('center: ',center);
            let center = l._latlng;

            map.flyTo(center,18);
        }
        else if(l.feature.geometry.type == 'LineString')
        {
            // console.log(l.feature.geometry.type)
            // let bounds = layers[$(this).attr('data-name')].getBounds();
            // let center = bounds.getCenter();
            let center = l._latlngs[(l._latlngs.length/2)];
            map.flyTo(center,15);
        }
        else if(l.feature.geometry.type == 'Polygon')
        {
            let center = l._latlngs[0][0];
            map.flyTo(center,15);
        }

    })

    $('#layer_search').select2();
    $('.search_layer').select2();
    $('.box_search').hide();
    $('.btn_search').click(function(e){
        console.log($(this));
        $('#box_search_'+$(this).attr('data-slug')).slideToggle();
    });

    // Mobile version

    $('#mobile_tabs a[href="#mobile_search"]').click(function(e){
        console.log('arf: ',$('#mobile_layers #side_layers input[type="checkbox"]:checked').length)
        if($('#mobile_layers #side_layers input[type="checkbox"]:checked').length > 0)
        {
            $('#m_layer_search').html('<option value="all_layer" selected>-- Tampilkan Semua Layer --</option>');
            $('#m_feature_search').attr('placeholder','Cari semua...');
        }
        else
        {
            $('#m_layer_search').html('<option value="all_layer" selected>-- Tidak Ada Layer Aktif --</option>');
            $('#m_feature_search').attr('placeholder','Tidak ada data untuk dicari...');
        }
        $('#m_feature_name').html('');

        $('#mobile_layers #side_layers input[type="checkbox"]:checked').each(function(i){

            $('#m_layer_search').append('<option value="'+$(this).attr('name')+'">'+$(this).attr('data-name')+'</option>');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
            $('#m_feature_name').append(nl);
            layers[$(this).attr('name')].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#m_feature_name').append(fn)
            })
        })  
    })

    $('#m_layer_search').change(function(e){
        $('#m_feature_name').html('');
        $('#m_feature_search').val('');
        if($(this).val() == 'all_layer')
        {
            $('#m_feature_search').attr('placeholder','Cari semua...');
            $('#side_layers input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#m_feature_name').append(nl);
                layers[$(this).attr('name')].eachLayer(l=>{
                    let fn  = '';
                        fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                        fn += '<i class="si si-pointer"></i> ';
                        fn += l.feature.properties.name;
                        fn += '</div>';
                    $('#m_feature_name').append(fn)
                })
            })  
        }
        else
        {
            $('#m_feature_search').attr('placeholder','Cari '+$('#m_layer_search option[value="'+$(this).val()+'"]')[0].text+'...');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#m_layer_search option[value="'+$(this).val()+'"]')[0].text+'</div>';
            $('#m_feature_name').append(nl);
            layers[$(this).val()].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).val()+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#m_feature_name').append(fn)
            })
        }
    })

    $('#m_feature_search').keyup(function(){
        $('#m_feature_name').html('');
        let cari = new RegExp($(this).val(), 'i');
        if($('#m_layer_search').val() == 'all_layer')
        {
            $('#side_layers input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#m_feature_name').append(nl);
                layers[$(this).attr('name')].eachLayer(l=>{
                    
                    if(l.feature.properties.name !== null)
                    {
                        if(l.feature.properties.name.match(cari))
                        {
                            let fn  = '';
                                fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                            $('#m_feature_name').append(fn);
                        }
                    }
                })
            })  
        }
        else
        {
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#m_layer_search option[value="'+$('#m_layer_search').val()+'"]')[0].text+'</div>';
            $('#m_feature_name').append(nl);
            layers[$('#m_layer_search').val()].eachLayer(l=>{
                
                if(l.feature.properties.name !== null)
                {
                    if(l.feature.properties.name.match(cari))
                    {
                        let fn  = '';
                            fn += '<div class="feature_name" data-name="'+$('#m_layer_search').val()+'" data-id="'+l._leaflet_id+'">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                        $('#m_feature_name').append(fn);
                    }
                }
                
            })
        }
    })
    
    $('#m_feature_name').on('click','.feature_name',function(e){
        console.log('clicked: ',
            layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]
        )
        
        let l = layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')];
        
        // map.flyTo()
        
        if(l.feature.geometry.type == 'Point')
        {
            // console.log(l.feature.geometry.type)
            // console.log('latlng: ',l._latlng.toBounds());
            // let bounds = l._latlng.toBounds();
            // let center = bounds.getCenter();
            // console.log('center: ',center);
            let center = l._latlng;

            map.flyTo(center,19);
        }
        else if(l.feature.geometry.type == 'LineString')
        {
            // console.log(l.feature.geometry.type)
            // let bounds = layers[$(this).attr('data-name')].getBounds();
            // let center = bounds.getCenter();
            let center = l._latlngs[(l._latlngs.length/2)];
            map.flyTo(center,15);
        }
        else if(l.feature.geometry.type == 'Polygon')
        {
            let center = l._latlngs[0][0];
            map.flyTo(center,15);
        }

    })

    $('#m_layer_search').select2();
    $('.search_layer').select2();
    $('.box_search').hide();
    $('.btn_search').click(function(e){
        console.log($(this));
        $('#m_box_search_'+$(this).attr('data-slug')).slideToggle();
    });
    
    if($(window).width() <= 575)
    {
        $('#mobile_layers #side_layers input[type="checkbox"]').trigger('click');
        setTimeout(()=>{
            $('#mobile_tabs a[href="#mobile_search"]').trigger('click');
        },2000)
    }
    else
    {
        $('#side_layers.large_screen input[type="checkbox"]').trigger('click');
    }
    

})

function init_map(){
map = L.map('map',{
    attributionControl: false,
    zoomControl: false
}).setView([-7.568517689092,110.82824680176], zoom);

basemap = {
    osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }),
    google_roadmap: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }),
    google_satellite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }),
    google_hybrid: L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }),
    google_terrain: L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }),
    esri_world_imagery: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',{
        maxZoom: 17
    }),
    esri_world_street_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'),
    esri_world_topo_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'),
    citra_satelit: L.esri.imageMapLayer({
        url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/CITRASATELIT/JawaBaliNusra_2015_ImgServ1/ImageServer',
        attribution : 'Badan Informasi Geospasial'
      }),
    peta_rbi: L.esri.dynamicMapLayer({
        url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/IGD/RupabumiIndonesia/MapServer',
        attribution : 'Badan Informasi Geospasial'
      }),
    peta_rbi_opensource: L.tileLayer.wms('http://palapa.big.go.id:8080/geoserver/gwc/service/wms',{
        maxZoom : 20,
        layers : "basemap_rbi:basemap",
        format : "image/png",
        attribution : 'Badan Informasi Geospasial'
      })
    
}

basemap[active_basemap].addTo(map);

var osm_popup = L.popup();
// $($('#side_layers.large_screen input[type="checkbox"]').get().reverse()).each(function(i){
$('#side_layers.large_screen input[type="checkbox"]').each(function(i){
    var cb = $(this);
    // console.log($(this).attr('name'));

    var geojson_url = '';

    if($(this).hasClass('default_layers'))
    {
        // console.log('default layers');
        geojson_url = '<?=base_url()?>assets_front/geojson/'+$(this).attr('name')+'.json';
    }
    else if($(this).hasClass('dynamic_layers'))
    {
        // console.log('dynamic layers')
        geojson_url = '<?=base_url()?>peta/get_geojson/'+$(this).attr('id_layer');
    }

 
        // get_map(cb,geojson_url);
    
    

})

}

$('#btn_map_zoom_in').click(function(){
    zoom++
    map.setZoom(zoom);
    
})

$('#btn_map_zoom_out').click(function(){
    zoom--
    map.setZoom(zoom);
    
})

$('#btn_map_search').click(function(){
    
    if($('#side_search').hasClass('active_option'))
    {
        $('.side_option').removeClass('active_option');
        $('#side_search').hide('slide');
    }
    else
    {
        $('.side_option').removeClass('active_option');
        $('#side_search').addClass('active_option');
        $('.side_option').hide('slide');
        $('.side_option.active_option').show('slide');
    }

})

$('#side_layers input[type="checkbox"]').change(function(){

    if($(this).is(':checked'))
    {
        $('span[data-name="'+$(this).attr('name')+'"]').show()
        let geojson_url = '<?=base_url()?>peta/get_geojson/'+$(this).attr('id_layer');
        if(typeof layers[$(this).attr('name')] == 'undefined')
        {
            get_map($(this),geojson_url);
        }
        else
        {
            layers[$(this).attr('name')].addTo(map);
            $('.bar_loader').hide();
        }

        $(this).attr('checked','checked');
    }
    else
    {
        map.removeLayer(layers[$(this).attr('name')]);     
        $(this).removeAttr('checked');
    }

})

$('#cari_latlng').click(function(){
    if
    (
        $('input[name="cari_lat"]').val() != null &&
        $('input[name="cari_lat"]').val() != '' &&
        $('input[name="cari_lat"]').val() != 0 &&
        $('input[name="cari_lat"]').val() != '0' &&
        $('input[name="cari_lng"]').val() != null &&
        $('input[name="cari_lng"]').val() != '' &&
        $('input[name="cari_lng"]').val() != 0 &&
        $('input[name="cari_lng"]').val() != '0' 
    )
    {
        search_marker != '' ? map.removeLayer(search_marker) : '';
        var lat = $('input[name="cari_lat"]').val();
        var lng = $('input[name="cari_lng"]').val()
        console.log('lat: ',lat,'lng: ',lng);
        map.flyTo([lat,lng],16);
        search_marker = L.marker([lat,lng]).addTo(map);
        // setTimeout(() => {
            // map.removeLayer(search_marker);
        // }, 5000);
        
    }
    else
    {
        alert('Harap masukkan latitude & longitude');
    }

    
})

$('#m_cari_latlng').click(function(){
    if
    (
        $('input[name="m_cari_lat"]').val() != null &&
        $('input[name="m_cari_lat"]').val() != '' &&
        $('input[name="m_cari_lat"]').val() != 0 &&
        $('input[name="m_cari_lat"]').val() != '0' &&
        $('input[name="m_cari_lng"]').val() != null &&
        $('input[name="m_cari_lng"]').val() != '' &&
        $('input[name="m_cari_lng"]').val() != 0 &&
        $('input[name="m_cari_lng"]').val() != '0' 
    )
    {
        search_marker != '' ? map.removeLayer(search_marker) : '';
        var lat = $('input[name="m_cari_lat"]').val();
        var lng = $('input[name="m_cari_lng"]').val()
        console.log('lat: ',lat,'lng: ',lng);
        map.flyTo([lat,lng],16);
        search_marker = L.marker([lat,lng]).addTo(map);
        // setTimeout(() => {
            // map.removeLayer(search_marker);
        // }, 5000);
    }
    else
    {
        alert('Harap masukkan latitude & longitude');
    }

    
})

function get_map(cb,geojson_url){
    function osm_style(f){

    var fill_color = (typeof f.properties['fill'] != 'undefined') ?  f.properties['fill'] : '#19bff0';
    var fill_opacity = (typeof f.properties['fill_opacity'] != 'undefined') ?  f.properties['fill_opacity'] : 0.3;
    var stroke_color = (typeof f.properties['stroke'] != 'undefined') ?  f.properties['stroke'] : '#19bff0';
    var stroke_opacity = (typeof f.properties['stroke_opacity'] != 'undefined') ?  f.properties['stroke_opacity'] : 0.7;
    var stroke_weight = (typeof f.properties['stroke_width'] != 'undefined') ?  f.properties['stroke_width'] : 2;

    switch(cb.attr('name')){
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
        weight: stroke_weight
    }
    }
    let osm_popup = L.popup();
    function osm_info(e){
    // console.log(e)
    osm_popup
    // .setLatLng(e.latlng)
    .setLatLng({
        lat: e.latlng.lat + 0.0002,
        lng: e.latlng.lng
    })
    // .openOn(map);

    if(cb.hasClass('default_layers'))
    {    
        osm_popup.setContent(e.layer.feature.properties.description);
        $('#info_content').html(e.layer.feature.properties.description);
        $('#mobile_info #info_content').html(e.layer.feature.properties.description);
    }
    else if(cb.hasClass('dynamic_layers'))
    {
        let o = e.layer.feature.properties;
        let content = '';
        console.log('o',o);
        Object.keys(o).map((v,i,a)=>{
            if(!['id_layer','id_opd','id_collection','stroke','stroke_opacity','stroke_width','fill','fill_opacity','icon_name','page_detail', 'name', 'group'].includes(v))
            {
                if(v == 'nama_layer')
                {
                    content += '<div style="font-size:larger; font-weight:bold;margin-bottom:5px;">'+o[v]+'</div>';
                }
                else
                {
                    content += '<div>'+v+': '+o[v]+'</div>';
                }
                
            }
            
        })
        console.log('halaman: ',o)
        if(o.page_detail == 1)
        {
            content += '<div style="margin: 10px; text-align:center;"><a href="<?=base_url()?>peta/informasi-detail/'+o.id_collection+'" class="btn btn-sm btn-rounded btn-outline-danger" target="_blank">Lihat Selengkapnya</a></div>';
        }
        // osm_popup.setContent(content);
        $('#info_content').html(content);
        $('#mobile_info #info_content').html(content);

    }

    if(!$('#side_info').hasClass('active_option'))
    {
        $('#btn_map_info').trigger('click');
    }

    $('#mobile_tabs a[href="#mobile_info"]').trigger('click');
    }


    $.getJSON(geojson_url , function(data){
        // console.log(data);
        if(data.features.length > 0){
            // console.log(geojson_url)
            // console.log(cb.attr('name'));
            layers[cb.attr('name')] = new L.geoJSON(data,{
                style: osm_style
            });
        
            if(cb.is(':checked')){
                // console.log(layers[cb.attr('name')])
                layers[cb.attr('name')].addTo(map);
            }   

            layers[cb.attr('name')].on('click',osm_info);
            console.log(cb.attr('name'),': ', layers[cb.attr('name')])
            $('.bar_loader').hide();
        }

    })
}

</script>