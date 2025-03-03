<script>
$(document).ready(function(){
    init_map_osm();
    $('#map_detail').slimScroll({
        color: '#ff0000',
        height: '500px'
    });
})

var osm_layers = {};
function init_map_osm(){
    var id = <?=$this->uri->segment(3)?>;
    osm_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    osm_map = L.map('map',{
        attributionControl: false,
        zoomControl: false
    }).setView([-7.568517689092,110.82824680176], 13);
    L.tileLayer(
    osm_url,
    {
        // attribution: 'Made with Love'
    }
    )
    .addTo(osm_map);

    var geojson_url = "<?=base_url()?>peta/get_informasi_detail/"+id;

    $.getJSON(geojson_url , function(data){
        osm_layers[id] = new L.geoJSON(data,{});
        osm_layers[id].addTo(osm_map);
        // console.log(osm_layers[id])
        osm_layers[id].eachLayer(l=>{
            console.log(l);
            if(l.feature.geometry.type == 'Point')
            {
                osm_map.flyTo(l._latlng,18)
            }

            let o = l.feature.properties;
            let content = '<table class="table table-striped">';
            console.log('o',o);
            Object.keys(o).map((v,i,a)=>{
                if(!['id_layer','id_opd','id_collection','stroke','stroke_opacity','stroke_width','fill','fill_opacity','icon_name','page_detail'].includes(v))
                {
                    if(v == 'nama_layer')
                    {
                        content += '<tr><td colspan=2 style="font-size:larger; font-weight:bold;margin-bottom:5px;">Informasi '+o[v]+'</td></tr>';
                    }
                    else
                    {
                        content += '<tr><td>'+v+'</td><td>'+o[v]+'</td></tr>';
                    }
                }
            })
            content += '</table>';
            $('#map_detail').html(content);
        })
        
    })
}

</script>