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

    var draw_mode = 'marker';

    var drawingManager = new g.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
        position: g.ControlPosition.TOP_CENTER,
        drawingModes: [draw_mode]
        },
        markerOptions: {

        }
    });

    drawingManager.setMap(map);

    g.event.addListener(drawingManager, 'markercomplete', function (e) {
        marker_push(e);
    });

    function marker_push(e){
        list.push(e);
        list[increment].name = 'coordinates';
        list[increment].id = increment+1;
        coords[list[increment].name] = [e.position.lng(),e.position.lat()];
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

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2r2rsIiyfZXaIvkSA-DmIaQ-c_SMdYzI&callback=initMap">
</script> -->
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE&libraries=drawing"></script>
<?php require_once('tambah_data_js.php'); ?>