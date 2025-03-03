<script src="<?=base_url()?>assets_front/js/leaflet.js"></script>
<script src="<?=base_url()?>assets_front/js/leaflet-esri.js"></script>
<script src="<?=base_url()?>assets_front/js/leaflet.draw.js"></script>
<script>
var map;
var active_basemap = 'osm';
var basemap = {};
var coords = '';
$(document).ready(function(){
    init_map();
})
function init_map()
{
    map = L.map('map',{
        attributionControl: false,
        zoomControl: false
    }).setView([-7.572553480903423, 110.82938075065613], 13);
    basemap = {
        osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map),
        google_roadmap: L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }),
        google_satellite: L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }),
        google_hybrid: L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }),
        google_terrain: L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
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

    L.control.layers(basemap).addTo(map);

    let el = L.featureGroup(); //editable layer
    map.addLayer(el);


    let draw_options = {
        position: 'topleft',
        draw: {
            
            rectangle: false,
            circle: false,
            circlemarker: false,
            polyline: false,
            marker: true,
            polygon: false
        },
        edit: {
            featureGroup: el
        }
    
    }

    let draw_options_edit = {
        position: 'topleft',
        draw: {
            rectangle: false,
            circle: false,
            circlemarker: false,
            polyline: false,
            marker: false,
            polygon: false
        },
        edit: {
            featureGroup: el
        }
    
    }

    let draw_control = new L.Control.Draw(draw_options);
    let draw_control_edit = new L.Control.Draw(draw_options_edit);

    if(el.getLayers().length > 0)
    {
        map.addControl(draw_control_edit);
    }
    else
    {
        map.addControl(draw_control);
    }

    map.on('draw:created',(e)=>{
        let l = e.layer;
        l.addTo(el);
        console.log('elc: ',el)
        // console.log('latlng: ',l.getLatLngs());
        // to_geojson_coordinates(el.getLayers()[0]._latlngs);
        to_geojson_coordinates(l);

        draw_control.remove(map);
        draw_control_edit.addTo(map);
    })

    map.on('draw:edited',(e)=>{
        let l = e.layers.getLayers()[0];
        to_geojson_coordinates(l);
        // console.log('latlng edit: ',l.getLatLngs());
        })

        map.on('draw:deleted',(e)=>{
        if(el.getLayers().length == 0)
        {
            draw_control_edit.remove(map);
            draw_control.addTo(map);
            $('#pilih_koordinat').val('').trigger('change');
        }
    
    })

    var pilih_koordinat = '';
    $('#pilih_koordinat').change(function(){
        let val = $(this).val();
        if(val>0)
        {
            $.ajax({
                url: '<?php echo base_url();?>opd/peta/get_koordinat',
                type: 'GET',
                dataType: 'JSON',
                data: {id: val, type: 'Point'}
            })
            .then(res=>{
                let x = [{
                    "type": res.data.tipe_koordinat,
                    "coordinates": JSON.parse(res.data.koordinat)
                }]
                pilih_koordinat = x;
                if(pilih_koordinat != '')
                {
                    let el_first = el._layers[Object.keys(el._layers)[0]];

                    if(typeof el_first != 'undefined')
                    {
                        el_first.remove(map);
                        el.removeLayer(el_first);
                    }
                    
                    let koordinat = L.geoJSON(pilih_koordinat);
                    let koord = koordinat._layers[[Object.keys(koordinat._layers)[0]]];
                    // koord.addTo(map);
                    koord.addTo(el);
                    map.flyToBounds(koord.getBounds());
                    draw_control.remove(map);
                    draw_control_edit.addTo(map);
                    coords = res.data.koordinat;
                }
                else
                {
                    coords = '';
                }
            })
        }
        else
        {
            let el_first = el._layers[Object.keys(el._layers)[0]];

            if(typeof el_first != 'undefined')
            {
                el_first.remove(map);
                el.removeLayer(el_first);
                draw_control_edit.remove(map);
                draw_control.addTo(map);
            }
        }
        
    })

    function to_geojson_coordinates(l){
        // console.log('togeojson: ',l.toGeoJSON());
        let geojson = l.toGeoJSON();
        let coordinates = JSON.stringify(geojson.geometry.coordinates);
        let type = geojson.geometry.type;
        // console.log(type,' | ',coordinates);
        coords = coordinates;
    }

}

</script>

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2r2rsIiyfZXaIvkSA-DmIaQ-c_SMdYzI&callback=initMap">
</script> -->
<!-- <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE&libraries=drawing"></script> -->

<?php require_once('tambah_data_js.php'); ?>