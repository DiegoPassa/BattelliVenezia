<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        /* HEAD */
        session_start();
        require "./pages/pageComponents/head.php";
    ?>
</head>

<body>
    
    <?php 
        /* NAVBAR */
        include "./pages/pageComponents/navbar.php";
        include "./pages/modalRegister.php";
        include "./pages/modalLogin.php";
    ?>

    <div class="container-fluid">
        <div class="row" style="">
            <div class="col-lg" style="font-size:25px; text-align:center;">
                <!-- <i class="fas fa-ad    "></i> -->
            </div>
            <div class="col-lg-9 py-4">
                <!-- start -->
                <div id="routes" class="my-auto">

                </div>
                <!-- <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-1 mb-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Card</h5>
                        </div>
                        </div>
                    </div>
                </div> -->

                <div id="map" style="width:100%;height:700px;" class="rounded"></div>
                <!-- end -->
            </div>
            <div class="col-lg" style="font-size:25px; text-align:center;">
                <!-- <i class="fas fa-ad    "></i> -->
            </div>
        </div>
    </div>
    </body>

<script>

    var map;

    $(document).ready(function() {

        mapboxgl.accessToken = 'pk.eyJ1IjoicGFzc2EwMSIsImEiOiJja2FyYzVnaGgxeHd4MnNtdjduZ2Z4bDl4In0.QaR3jD8k-cmy6DtB0vl13w';
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [12.327145, 45.438759],
            zoom: 12
        });

        $.ajax({
            type: "post",
            url: "./pages/getStopLocation.php",
            data: "",
            dataType: "json",
            success: function (response) {
                //a = response;
                JSON.stringify(response);
                console.log(response);
                for (var i = 0; i < response.length; i++) {
                    var marker = new mapboxgl.Marker()
                        .setLngLat(response[i])
                        .setPopup(new mapboxgl.Popup().setHTML(response[i][2]))
                        .addTo(map);                 
                }
            }                            
        });

        $.ajax({
            type: "post",
            url: "./pages/getRoutesInfo.php",
            data: "",
            dataType: "json",
            success: function (response) {
                for (var i = 0; i < response.length; i++) {
                    $("#routes").append('<h6 onclick="printShapeMap(\''+response[i].route_short_name+'\',\''+ response[i].route_color+'\');" class="d-inline-flex p-1 px-3 rounded" style="color: #'+ response[i].route_text_color +'; background-color:#'+ response[i].route_color +'">'+ response[i].route_short_name+'</h6> ');
                }              
            }                            
        });

    });
    function printShapeMap(routeId, routeColor){
        $.ajax({
            type: "post",
            url: "./pages/getShapeMap.php",
            data: {'routeId': routeId},
            dataType: "json",
            success: function (response) {
                console.log("aiuto");
                JSON.stringify(response);
                console.log(response);
                if (routeColor == '8FD2BF') {
                    routeColor = '07c08b'; //00ad7c
                }
                if (map.getLayer('route')){
                    map.removeLayer('route');
                }

                if (map.getSource('route')){
                    map.removeSource('route');
                }
                
                map.addSource('route', {
                    'type': 'geojson',
                    'data': {
                        'type': 'Feature',
                        'properties': {},
                        'geometry': {
                            'type': 'LineString',
                            'coordinates': response 
                        }
                    } 
                });
                map.addLayer({
                    'id': 'route',
                    'type': 'line',
                    'source': 'route',
                    'layout': {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    'paint': {
                        'line-color': 'red' , /* #8FD2BF 4.2 */
                        'line-width': 3
                    }
                });
            }
        });
    }
    </script>

</body>

</html>   