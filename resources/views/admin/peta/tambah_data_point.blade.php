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
                    <h3 class="block-title">Tambah Data Layer <span>{{ $layer->nama_layer }}</span></h3>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center py-20">
                        <div class="col-xl-6">
                                
                            
    
                            <form method="post" id="tambah_data_peta">
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
                                <input type="hidden" name="tipe_layer" value="{{ $tipe_layer }}">
                                <?php foreach ($atribut as $item) { ?>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="<?= $item->slug; ?>"><?= $item->nama_atribut; ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="hidden" name="id_atribut_<?= $item->slug; ?>" value="<?= $item->id_atribut; ?>">
                                        <?php if($item->tipe_data != "File"){ ?>
                                            <input required type="text" class="form-control <?php if($item->tipe_data == "Angka"){echo "angka-saja";} ?>" id="<?= $item->slug; ?>" name="<?= $item->slug; ?>" placeholder="Masukkan <?= $item->nama_atribut; ?>">
                                        <?php }else{ ?>
                                            <input required type="file" id="<?= $atribut->slug; ?>" name="<?= $atribut->slug; ?>">
                                        <?php }?>
                                    </div>
                                </div>
                                <?php } ?>
    
                                <!-- Static input form -->
                                <hr>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="name" type="text" class="form-control">
                                        <div style="font-size: smaller">
                                            * Ditampilkan sebagai nama pencarian pada peta halaman depan
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="group">Group<span class="text-danger"></span></label>
                                    <div class="col-lg-8">
                                        <input name="group" type="text" class="form-control">
                                    </div>
                                </div> -->
    
                                <!-- Input Map Feature Styles | Polygon -->
                                @if(request()->segment(5) == 'polygon')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke">Stroke <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="js-colorpicker input-group">
                                            <input name="stroke" type="text" class="form-control" value="#FF0000">
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
                                        <input name="stroke_opacity" type="number" min="0" max="1" step="0.1" value="1" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_width">Stroke Width <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_width" type="number" min="0" value="1" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_dash">Stroke Dash <span class="text-danger"></span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_dash" type="text" class="form-control" placeholder="Contoh: 5,5"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="fill">Fill <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="js-colorpicker input-group">
                                            <input name="fill" type="text" class="form-control" value="#FF7070">
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
                                        <input name="fill_opacity" type="number" min="0" max="1" step="0.1" value="0.5" class="form-control">
                                    </div>
                                </div>
    
                                <!-- Input Map Feature Styles | Line / LineString -->
                                @elseif(request()->segment(5) == 'line')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke">Stroke <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="js-colorpicker input-group">
                                            <input name="stroke" type="text" class="form-control" value="#FF0000">
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
                                        <input name="stroke_opacity" type="number" min="0" max="1" step="0.1" value="1" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_width">Stroke Width <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_width" type="number" min="0" value="1" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_dash">Stroke Dash <span class="text-danger"></span></label>
                                    <div class="col-lg-8">
                                        <input name="stroke_dash" type="text" class="form-control" placeholder="Contoh: 5,5"> 
                                    </div>
                                </div>
    
                                <!-- Input Map Feature Styles | Point -->
                                @elseif(request()->segment(5) == 'point')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="stroke_width">Icon Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <select  id="icon_name" name="icon_name" class="form-control" style="width: 100%;">
                                            <option data-img="default" value="default">default</option>
                                            @foreach ($data_icon as $icon)
                                                <option data-img="{{ $icon->nama_icon }}" value="{{ $icon->nama_icon }}">{{ $icon->nama_icon }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
    
                                @endif
    
                                <input type="hidden" name="page_detail" value="0">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label class="css-control css-control-success css-checkbox">
                                            <input type="checkbox" name="page_detail" class="css-control-input" value="1">
                                            <span class="css-control-indicator"></span> Aktifkan Fitur Halaman Detail
                                        </label>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-alt-primary">Simpan Data <?= $layer->nama_layer; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </main>
    <!-- END Main Container -->
    

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
})
function init_map()
{
    map = L.map('map',{
        attributionControl: false,
        zoomControl: false
    }).setView([-6.868354, 109.131658], 13);
    basemap = {
        osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
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
        })
    };

    L.control.layers(basemap).addTo(map);
    let el = L.featureGroup();
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
        edit: { featureGroup: el }
    };

    let draw_control = new L.Control.Draw(draw_options);
    map.addControl(draw_control);

    map.on('draw:created', (e) => {
        let l = e.layer;
        l.addTo(el);
        to_geojson_coordinates(l);
    });

    function to_geojson_coordinates(l) {
        let geojson = l.toGeoJSON();
        let coordinates = JSON.stringify(geojson.geometry.coordinates);
        coords = coordinates;
    }

    // $('#pilih_koordinat').change(function(){
    //     let val = $(this).val();
    //     if(val) {
    //         $.ajax({
    //             url: '{{ url('admin/peta/get_koordinat') }}',
    //             type: 'GET',
    //             dataType: 'JSON',
    //             data: {id: val, type: 'Point'}
    //         })
    //         .then(res => {
    //             let x = [{
    //                 "type": res.data.tipe_koordinat,
    //                 "coordinates": JSON.parse(res.data.koordinat)
    //             }];
    //             let koordinat = L.geoJSON(x);
    //             let koord = koordinat.getLayers()[0];
    //             koord.addTo(el);
    //             map.flyToBounds(koord.getBounds());
    //             coords = res.data.koordinat;
    //         });
    //     }
    // });

    // $('#pilih_koordinat').on('change', function() {
    //     let selected = $(this).select2('data')[0]; // Ambil data yang dipilih

    //     if (selected) {
    //         let koordinatData = JSON.parse(selected.koordinat); // Pastikan data bisa di-parse
    //         let geoJSONData = {
    //             "type": selected.tipe_koordinat,
    //             "coordinates": koordinatData
    //         };

    //         let layer = L.geoJSON(geoJSONData);
    //         let koord = layer.getLayers()[0];
    //         koord.addTo(map); // Pastikan 'map' sudah didefinisikan
    //         map.flyToBounds(koord.getBounds());
    //     }
    // });

    $(document).ready(function(){
        let currentLayer = null; // Simpan layer sebelumnya

        $('#pilih_koordinat').on('change', function (e) {
            e.preventDefault();
            let selected = $(this).select2('data')[0]; // Ambil data yang dipilih

            if (selected) {
                try {
                    let koordinatData = JSON.parse(selected.koordinat); // Parse koordinat JSON
                    coords = JSON.stringify(koordinatData); // Simpan koordinat dalam variabel global

                    let geoJSONData = {
                        "type": selected.tipe_koordinat,
                        "coordinates": koordinatData
                    };

                    // Hapus layer lama jika ada
                    if (currentLayer) {
                        map.removeLayer(currentLayer);
                    }

                    let layer = L.geoJSON(geoJSONData);
                    let koord = layer.getLayers()[0];

                    if (koord) {
                        koord.addTo(map);
                        currentLayer = layer; // Simpan layer baru ke variabel global

                        if (koord.getBounds) {
                            map.flyToBounds(koord.getBounds());
                        } else if (koord.getLatLng) {
                            map.flyTo(koord.getLatLng(), 15); // Jika titik, zoom ke koordinat
                        }
                    }
                } catch (error) {
                    console.error("Error parsing koordinat:", error);
                    coords = ''; // Reset coords jika ada kesalahan parsing
                }
            }
        });
    });



}
</script>
<script>

    $(document).ready(function(){
        
        $('#icon_name').select2({
            templateResult: formatState,
            templateSelection: formatState
        });
        // $('#pilih_koordinat').select2();
        // $('#pilih_koordinat').select2({
        //     ajax: {
        //         url: '{{ route("admin.peta.ref_koordinat") }}',
        //         dataType: 'JSON',
        //         data: function(d){
        //             let q = {
        //                 search: d.term,
        //                 type: '{{ request()->segment(5) }}'
        //             }
        //             return q;
        //         },
        //         delay: 500
        //     }
        // });
        $('#pilih_koordinat').select2({
            ajax: {
                url: '{{ url('admin/peta/get_koordinat') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text,
                            tipe_koordinat: item.data.tipe_koordinat,
                            koordinat: item.data.koordinat
                        }))
                    };
                },
                cache: true
            }
        });


        $('#tambah_data_peta').on('submit', function(e) {
            e.preventDefault();
            console.log('Tombol submit ditekan');

            if (typeof coords === 'undefined' || coords == '') {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Koordinat lokasi tidak terdeteksi',
                    icon: 'error'
                });
                console.error('Error: Koordinat tidak terdeteksi.');
            } else {
                var coord = coords;
                var form_data = new FormData(this);
                form_data.append('coordinates', coord);

                $.ajax({
                    url: '{{ route("admin.peta.simpan_data_peta_point") }}',
                    type: "post",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        console.log('Response sukses:', response);
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data berhasil disimpan!',
                            type: 'success',
                            timer: 1500
                        });
                        window.location.replace("{{ url('admin/peta/kelola/'.request()->segment(4)) }}");
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response Text:', xhr.responseText);
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyimpan data.',
                            type: 'error'
                        });
                    }
                });

                return false;
            }
        });


    })

    function formatState (state) {
        var icon;
        if(state.text != 'Searching…')
        {
            icon = state.element.attributes['data-img'].value;
        }
        
        if (!state.id) { return state.text; }
        var $state = $(
            '<span><img class="select2_img" style="display: inline-block;" src="'+ '{{ asset("assets/uploads/marker_icon/") }}/' + icon + '.png" /> ' + state.text + '</span>'
        );
        return $state;
    }
    $('.angka-saja').keyup(function(e) {
        if (/\D/g.test(this.value))
        {
            this.value = this.value.replace(/\D/g, '');
        }
    });


</script>
