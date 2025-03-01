<style>
body {
    padding: 0;
    margin: 0;
}
</style>

    <div id="map" style="height:100vh;width:80vw;float:left"></div>
    <div style="height:100vh;width:17vw;padding:0 0 0 20px;background:#fdfdfd;float:right;color:grey">
        <h1>Poligon List</h1>
        <div id="list"></div>
        <div><button id="btn_simpan">Simpan</button></div>
    </div>

<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE&libraries=drawing"></script>
<script src="<?=base_url(); ?>assets/js/core/jquery.min.js"></script>
<script>
$(document).ready(function(){
    init_map(); 
})
var map;
function init_map(){
    const g = google.maps;

    map = new g.Map(document.getElementById('map'),{
        zoom: 11,
        center: {lat: -7.99921, lng: 110.61475},
        // disableDefaultUI: true,
        // scrollwheel: false
    })

    var draw_mode = 'polygon';

    var drawingManager = new g.drawing.DrawingManager({
    drawingControl: true,
    drawingControlOptions: {
      position: g.ControlPosition.TOP_CENTER,
      drawingModes: [draw_mode]
    },
    polygonOptions: {
        editable: false,
        dragable: true
    }
  });
    drawingManager.setMap(map);
    var list = [];
    var increment = 0;
    var coords = [];

    
    g.event.addListener(drawingManager, 'polygoncomplete', function (e) {
        polygon_push(e);
    });


    $('#list').on('click','.polygon_item',function(){
        var i = ($(this).attr('data-id')-1);
        var x = list[i];
        x.setEditable(!x.getEditable());
        x.getEditable() ? edit_now(x) : g.event.clearInstanceListeners(x.getPath());
    })

    $('#list').on('click','.hapus_polygon',function(){
        var i = ($(this).attr('data-id')-1);
        var x = list[i];
        x.setMap(null);
        delete coords[x.name];
        delete list[i];
        console.log(list);
        console.log(coords);
        $(this).parent().hide();
    })

    $('#btn_simpan').click(function(){
        console.log(coords);
    })

    function edit_now(x){
        // g.event.addListener(x, 'dragend', function(e){
             //console.log(x)
        // });
        //var coords = [];
        g.event.addListener(x.getPath(), 'set_at', function(e){
            var path = x.getPath();
            var coord = [];
            path.j.map((x,i,a)=>{
                var latlng = [x.lat(),x.lng()];
                coord.push(latlng) ;
            })
            coords[x.name] = coord;
            //console.log(coords);
        });
        g.event.addListener(x.getPath(), 'insert_at',function(e){
            var path = x.getPath();
            var coord = [];
            path.j.map((x,i,a)=>{
                var latlng = [x.lat(),x.lng()];
                coord.push(latlng) ;
            })
            coords[x.name] = coord;
            //console.log(coords);
        });
        g.event.addListener(x.getPath(), 'remove_at', function(e){
            var path = x.getPath();
            var coord = [];
            path.j.map((x,i,a)=>{
                var latlng = [x.lat(),x.lng()];
                coord.push(latlng) ;
            })
            coords[x.name] = coord;
            //console.log(coords);
        });

        
    }

    function polygon_push(e){
        list.push(e);
        list[increment].name = 'polygon'+(increment+1);
        list[increment].id = increment+1;
        var btn = '<div><div id="'+list[increment].name+'" class="polygon_item" data-id="'+list[increment].id+'">'+list[increment].name+' </div> <button id="hapus_'+list[increment].name+'" class="hapus_polygon" data-id="'+list[increment].id+'">Hapus</button></div>';
        $('#list').append(btn);

        var path = list[increment].getPath()
        var coord = [];
        path.j.map((x,i,a)=>{
            var latlng = [x.lat(),x.lng()];
            coord.push(latlng) ;
        })
        coords[list[increment].name] = coord;

        increment++;

    }

}


</script>