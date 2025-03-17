@extends('layouts.wrapper')
<style>
    #map{
        height: 500px;
    }
    
    .select2_img{
        width: 25px ;
        height: 25px ;
        margin-right: 10px;
    }
    
    .select2-container .select2-selection--single{
        height: 34px;
        border-color: #dddddd;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 34px;
        color: #777777;
        margin-left: 7px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 34px;
    }
    </style>
    <link rel="stylesheet" href="{{ asset('assets_front/css/leaflet.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets_front/css/leaflet.draw.css') }}"/>
    <!-- Main Container -->
    @section('contents')
    <main id="main-container">
        <div class="content">
            <div class="block block-themed" style="background: transparent;">
                <div class="block-header bg-primary-dark">
                    {{ ucfirst(request()->segment(5)) }} Layer {{ $layer->nama_layer }}
                </div>
                <div class="block-content" id="map"></div>
            </div>
            <div class="block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit Data Layer <span>{{ $layer->nama_layer }}</span></h3>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center py-20">
                        <div class="col-xl-6">
                            <form method="POST" id="edit_data_peta" 
                            action="{{ route('admin.peta.update_data_layer', ['id_collection' => $collection->id_collection]) }}"
                            enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="pilih_koordinat">Pilih Koordinat</label>
                                    <div class="col-lg-8">
                                        <select name="pilih_koordinat" id="pilih_koordinat" class="" style="width:100%;"></select>
                                        <div style="font-size: smaller">
                                            * Koordinat yang tersimpan dari menu referensi koordinat
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                
                                <input type="hidden" name="id_layer" value="{{ $id_layer }}">
                                <input type="hidden" name="tipe_layer" value="LineString">
                                <input type="hidden" name="id_collection" value="{{ $collection->id_collection }}">
                                @foreach ($atribut as $item)
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="{{ $item->slug }}">
                                        {{ $item->nama_atribut }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="hidden" name="id_atribut_{{ $item->slug }}" value="{{ $item->id_atribut }}">
                            
                                        @if ($item->tipe_data != "File")
                                            <input 
                                                required 
                                                type="text" 
                                                class="form-control {{ $item->tipe_data == 'Angka' ? 'angka-saja' : '' }}" 
                                                id="{{ $item->slug }}" 
                                                name="{{ $item->slug }}" 
                                                placeholder="Masukkan {{ $item->nama_atribut }}" 
                                                value="{{ $nilai_atribut[$item->id_atribut] ?? '' }}">
                                        @else
                                            <input 
                                                required 
                                                type="file" 
                                                id="{{ $item->slug }}" 
                                                name="{{ $item->slug }}">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            
    
                                <!-- Static input form -->
                                <hr>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="name" type="text" class="form-control" value="{{ $collection->name }}">
                                        <div style="font-size: smaller">
                                            * Ditampilkan sebagai nama pencarian pada peta halaman depan
                                        </div>
                                    </div>
                                    
                                </div>
    
                                <!-- Input Map Feature Styles | Polygon -->
                                @if(request()->segment(5) == 'polygon')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke">Stroke <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="js-colorpicker input-group">
                                            <input name="stroke" type="text" class="form-control" value="{{ isset($collection->stroke) ? $collection->stroke : '#FF0000' }}">
                                            <div class="input-group-append input-group-addon">
                                                <div class="input-group-text">
                                                    <i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_opacity">Stroke Opacity <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_opacity" type="number" min="0" max="1" step="0.1" class="form-control" value="{{ isset($collection->stroke_opacity) ? $collection->stroke_opacity : 1 }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_width">Stroke Width <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_width" type="number" min="0" class="form-control" value="{{ isset($collection->stroke_width) ? $collection->stroke_width : 1 }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_dash">Stroke Dash <span class="text-danger"></span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_dash" type="text" class="form-control" value="{{ isset($collection->stroke_dash) ? $collection->stroke_dash : '' }}" placeholder="Contoh: 5,5"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="fill">Fill <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="js-colorpicker input-group">
                                            <input name="fill" type="text" class="form-control" value="{{ isset($collection->fill) ? $collection->fill : '#FF7070' }}">
                                            <div class="input-group-append input-group-addon">
                                                <div class="input-group-text">
                                                    <i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="fill_opacity">Fill Opacity <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="fill_opacity" type="number" min="0" max="1" step="0.1" class="form-control" value="{{ isset($collection->fill_opacity) ? $collection->fill_opacity : 1 }}">
                                    </div>
                                </div>
    
                                <!-- Input Map Feature Styles | Line / LineString -->
                                @elseif(request()->segment(5) == 'LineString')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke">Stroke <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="js-colorpicker input-group">
                                            <input name="stroke" type="text" class="form-control" value="{{ isset($collection->stroke) ? $collection->stroke : '#FF0000' }}">
                                            <div class="input-group-append input-group-addon">
                                                <div class="input-group-text">
                                                    <i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_opacity">Stroke Opacity <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_opacity" type="number" min="0" max="1" class="form-control" value="{{ isset($collection->stroke_opacity) ? $collection->stroke_opacity : 1 }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_width">Stroke Width <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_width" type="number" min="0" class="form-control" value="{{ isset($collection->stroke_width) ? $collection->stroke_width : 1 }}">
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_dash">Stroke Dash <span class="text-danger"></span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_dash" type="text" class="form-control" value="{{ isset($collection->stroke_dash) ? $collection->stroke_dash : '' }}" placeholder="Contoh: 5,5"> 
                                    </div>
                                </div>
    
                                <!-- Input Map Feature Styles | Point -->
                                @elseif(request()->segment(5) == 'Point')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_width">Icon Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <select  id="icon_name" name="icon_name" class="form-control" style="width: 100%;">
                                            <option data-img="default" value="default">default</option>
                                            @foreach ($data_icon as $icon)
                                                <?php if($icon->nama_icon == $collection->icon_name):?>
                                                    <option data-img="{{ $icon->nama_icon }}" value="{{ $icon->nama_icon }}" selected>{{ $icon->nama_icon }}</option>
                                                <?php else:?>
                                                    <option data-img="{{ $icon->nama_icon }}" value="{{ $icon->nama_icon }}">{{ $icon->nama_icon }}</option>
                                                <?php endif;?>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
    
                                @endif
    
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label class="css-control css-control-success css-checkbox">
                                            <input type="checkbox" name="page_detail" class="css-control-input" {{ $collection->page_detail ? 'checked' : '' }}>
                                            <span class="css-control-indicator"></span> Aktifkan Fitur Halaman Detail
                                        </label>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-alt-primary">Simpan Data {{ $layer->nama_layer }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </main>
@endsection



<!-- jQuery harus di-load lebih awal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets_front/js/leaflet.js') }}"></script>
<script src="{{ asset('assets_front/js/leaflet-esri.js') }}"></script>
<script src="{{ asset('assets_front/js/leaflet.draw.js') }}"></script>

<script>
var map;
var active_basemap = 'osm';
var basemap = {};
var coords = '';

$(document).ready(function(){
    init_map();
});

function init_map()
{
    map = L.map('map',{
        attributionControl: false,
        zoomControl: false
    }).setView([-6.868354, 109.131658], 13);
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
            polyline: true,
            marker: false,
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

    var geojson_url = '{{ url("admin/peta/edit_data_peta_geojson") }}/{{ request()->segment(6) }}';
    $.getJSON(geojson_url, function(data){
        L.geoJSON(data,{
            onEachFeature: function(f,l){
                el.addLayer(l)
            }
        });
    })
    .then(v=>{
        // console.log('bound: ', el);
        el.eachLayer(l=>{
            console.log(l);
            to_geojson_coordinates(l);
            map.setView(l.getCenter(),17);

        })
        if(el.getLayers().length > 0)
        {
            map.addControl(draw_control_edit);
        }
        else
        {
            map.addControl(draw_control);
        }
    })


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
        coords = '';
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
                url: '{{ url("admin/peta/get_koordinat") }}',
                type: 'GET',
                dataType: 'JSON',
                data: {id: val, type: 'LineString'}
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

<script>
    $(document).ready(function(){
        $('#icon_name').select2({
            templateResult: formatState,
            templateSelection: formatState
        });
    
        $('#pilih_koordinat').select2({
            ajax: {
                url: '{{ url("admin/peta/ref_koordinat") }}',
                dataType: 'json',
                delay: 500,
                data: function(params){
                    return {
                        search: params.term,
                        type: '{{ request()->segment(5) }}'
                    };
                }
            }
        });

        $('#edit_data_peta').submit(function(e){
        e.preventDefault();
        
        if(typeof coords === 'undefined' || coords === '') {
            Swal.fire({
                title: 'Gagal!',
                text: 'Koordinat lokasi tidak terdeteksi',
                icon: 'error'
            });
        } else {
            var form_data = new FormData(this);
            form_data.append('coordinates', coords);
    
            // Ambil id_collection dari segmen URL
            let id_collection = window.location.pathname.split('/')[6];
            form_data.append('_method', 'PUT');
 

            $.ajax({
                url: '{{ url("admin/peta/update_data_peta") }}/' + id_collection, // Gunakan id_collection di URL
                type: 'POST', // Laravel butuh POST untuk FormData, tapi kita tambahkan _method: PUT
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF Token jika diperlukan
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil diperbarui!',
                        icon: 'success',
                        timer: 1500
                    }).then(() => {
                        window.location.replace("{{ url('admin/peta/kelola/' . request()->segment(4)) }}");
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal memperbarui data!',
                        icon: 'error'
                    });
                    console.error(xhr.responseText);
                }
            });

        }
    });

    });
    
    function formatState(state) {
        if (!state.id) { return state.text; }
        var icon = state.element ? state.element.getAttribute('data-img') : '';
        var $state = $(`<span><img class="select2_img" style="display: inline-block;" src="{{ url('assets/uploads/marker_icon') }}/${icon}.png" /> ${state.text}</span>`);
        return $state;
    }
    
    $('.angka-saja').on('keyup', function(){
        this.value = this.value.replace(/\D/g, '');
    });
    
</script>
    
