<script>

var map;
var myCenter = {lat: -7.99921, lng: 110.61475};
var list = [];
var increment = 0;
var coords = [];

function initMap() {
    var g = google.maps;
    map = new g.Map(document.getElementById('map'), {
        zoom: 11,
        center: myCenter
    });

    var draw_mode = 'polyline';

    var drawingManager = new g.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
        position: g.ControlPosition.TOP_CENTER,
        drawingModes: [draw_mode]
        },
        polylineOptions: {
            editable: false,
            dragable: false,
            strokeWidth: 1,
            strokeColor: '#42a5f5'
        }
    });

    drawingManager.setMap(map);

    g.event.addListener(drawingManager, 'polylinecomplete', function (e) {
        polyline_push(e);
        g.event.addListener(e.getPath(), 'set_at', function(f){
            var path = e.getPath();
            var coord = [];
            path.g.map((x,i,a)=>{
                var latlng = [x.lng(),x.lat()];
                coord.push(latlng) ;
            })
            coords[list[0].name] = coord;
            console.log(coords,list)
        });
        g.event.addListener(e.getPath(), 'insert_at',function(f){
            var path = e.getPath();
            var coord = [];
            path.g.map((x,i,a)=>{
                var latlng = [x.lng(),x.lat()];
                coord.push(latlng) ;
            })
            coords[list[0].name] = coord;
            console.log(coords,list)
        });
        g.event.addListener(e.getPath(), 'remove_at', function(f){
            var path = e.getPath();
            var coord = [];
            path.g.map((x,i,a)=>{
                var latlng = [x.lng(),x.lat()];
                coord.push(latlng) ;
            })
            coords[list[0].name] = coord;
            console.log(coords,list)
        });
    });

    function polyline_push(e){
        list.push(e);
        list[increment].name = 'coordinates';
        list[increment].id = increment+1;

        var path = list[increment].getPath()
        var coord = [];
        path.g.map((x,i,a)=>{
            var latlng = [x.lng(),x.lat()];
            coord.push(latlng) ;
        })
        coords[list[increment].name] = coord;
        increment++;
        console.log(coords,list)
        drawingManager.setMap(null);
    }

    $('#btn_hapus').on('click',this, function(){
        list[0].setMap(null);
        drawingManager.setMap(map);
        coords = []
        list = [];
        increment = 0;
        console.log(coords,list)
    })


}


$(document).ready(function(){
    initMap();
})

</script>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2r2rsIiyfZXaIvkSA-DmIaQ-c_SMdYzI&callback=initMap&libraries=drawing">
</script> -->
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE&libraries=drawing"></script>

<?php require_once('tambah_data_js.php'); ?>