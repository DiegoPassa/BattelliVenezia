<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        /* HEAD */
        session_start();
        require "./pages/pageComponents/head.php";
    ?>
    <!-- <script src="./scripts/index.js"></script> -->
</head>

<body>
    
    <?php 
        /* NAVBAR */
        include "./pages/pageComponents/navbar.php";
    ?>
    
    <style>
    #map {
        height: 100%;
    }
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    </style>

    <div class="container-fluid">
        <div class="row" style="">
            <div class="col-lg" style="font-size:25px; text-align:center;">
                <!-- <i class="fas fa-ad    "></i> -->
            </div>
            <div class="col-lg-9 py-4">
                <div class="jumbotron mb-3">
                    <h1 class="display-3">Benvenuto<?php if(isset($_SESSION['user'])){ echo ", " . $_SESSION['userName'] ;} ?>!</h1> <!-- <i class="fas fa-compass"></i> -->
                    <p class="lead">Scegli un punto di partenza e una destinazione e scopri le prossime partenze. </p>
<!--                     <hr class="my-2">
                    <p>More info</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="./index.php" role="button" data-toggle="modal"
                            data-target="#loginModal">Accedi</a>
                        <a class="btn btn-primary btn-lg" href="./index.php" role="button" data-toggle="modal"
                            data-target="#registerModal">Registrati</a>
                    </p> -->
                </div>
                <div class="row">
                    <div class="col-xl-7 mb-2">
                        <div class="container-fluid rounded py-4 mb-3" style="background-color: teal; color:white"> <!-- #008B88 -->
                        <!-- ## FORM ## -->
                            <form id="searchPathForm" action="" method="post" class="mx-2">

                                <!-- Prima riga -->
                                <div class="form-row">

                                    <div class="form-group col-sm">
                                        <label for="">Seleziona punto di partenza</label>
                                        <select name="partenza" id="select1" class="form-control" onchange="setPoint(this.value, 0)">
                                            <option value="none" selected disabled hidden></option>
                                            <?php
                                                require './pages/altro/connectionDB.php';
                                                $result = $conn->query("SELECT DISTINCT mainStop_name, mainStop_id FROM `mainstops` ORDER BY `mainstops`.`mainStop_name` ASC");
                                                $result->setFetchMode(PDO::FETCH_ASSOC);  
                                                while ($row = $result->fetch()){
                                                    echo '<option value = "'. $row['mainStop_id'] . '">' . $row['mainStop_name'] . '</option>';
                                                }
                                                /* $result = $conn->query("SELECT DISTINCT stop_headsign FROM `stop_times` WHERE 1 ORDER BY `stop_times`.`stop_headsign` ASC");
                                                $result->setFetchMode(PDO::FETCH_ASSOC);  
                                                while ($row = $result->fetch()){
                                                    echo '<option value="'. $row['stop_headsign'] .'">' . $row['stop_headsign'] . '</option>';     
                                                } */
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm my-auto text-center">
                                        <button id="exchangeButton" type="button" class="btn btn-primary"><i
                                                class="fa fa-exchange rotate" aria-hidden="true"></i></button>
                                    </div>

                                    <div class="form-group col-sm">
                                        <label for="">Seleziona punto di arrivo</label>
                                        <select name="destinazione" id="select2" class="form-control" onchange="setPoint(this.value, 1)">
                                            <option value="none" selected disabled hidden></option>
                                            <?php
                                                require './pages/altro/connectionDB.php';
                                                $result = $conn->query("SELECT DISTINCT mainStop_name, mainStop_id FROM `mainstops` ORDER BY `mainstops`.`mainStop_name` ASC");
                                                $result->setFetchMode(PDO::FETCH_ASSOC);  
                                                while ($row = $result->fetch()){
                                                    echo '<option value="'. $row['mainStop_id'] .'">' . $row['mainStop_name'] . '</option>';     
                                                }
                                                /* $result = $conn->query("CALL `stops`();");
                                                $result->setFetchMode(PDO::FETCH_ASSOC);  
                                                while ($row = $result->fetch()){
                                                    echo '<option value="'. $row['stop_name'] .'">' . $row['stop_name'] . '</option>';     
                                                } */
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <!-- Seconda Riga -->
                                <div class="form-row">

                                    <!-- ORA -->
                                    <div class="form-group col-md-2">
                                        <label for="">Scegli ora</label>
                                        <input id="oraPartenza" type="text" name="orario" class="form-control" value="<?php echo date("H:i"); ?>" placeholder="">
                                    </div>

                                    <!-- PARTENZA/ARRIVO -->
                                    <div class="form-group col-md my-auto">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="customRadioInline"
                                                class="custom-control-input" checked="">
                                            <label class="custom-control-label" for="customRadioInline1">Partenza</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="customRadioInline"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline2">Arrivo</label>
                                        </div>
                                    </div>

                                    <!-- GIORNO -->
                                    <div class="form-group col-md-3">
                                        <label for="data">Scegli giorno</label>
                                        <input type="text" name="giorno" class="form-control" id="data">
                                    </div>

                                    <!-- SUBMIT -->
                                    <div class="form-group col-md-4 my-auto text-center">
                                        <button id="searchButton" type="submit" class="btn btn-primary"><div id="loading">Cerca <i class="fas fa-search"></div></i></button>
                                    </div>

                                </div>

                            </form>
                        </div>     

                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d358560.61748403544!2d12.107151113975991!3d45.40420075401476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477eb1daf1d63d89%3A0x7ba3c6f0bd92102f!2sVenezia%20VE!5e0!3m2!1sit!2sit!4v1589049194243!5m2!1sit!2sit" width="100%" height="450" frameborder="0" style="border:0px solid black;" allowfullscreen="" aria-hidden="false" tabindex="0" class="rounded"></iframe> -->
                        <div id="map" style="width:100%;height:450px;" class="rounded"></div>
                                                
                    </div>

                    <div class="col-xl mb-2" id="results">
                        <!-- border: solid yellowgreen 1px; background-color:yellow -->
                    </div>
                </div>
            </div>
            <div class="col-lg" style="font-size:25px; text-align:center;">
                <!-- <i class="fas fa-ad    "></i> -->
            </div>
        </div>
    </div>

    <?php
    include "./pages/modalRegister.php";
    include "./pages/modalLogin.php";
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> -->

    <!-- JQueryUI -->
<!--     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" /> -->

    <!-- Datapicker ITA -->
<!--     <script type="text/javascript" src="./scripts/datepicker-it.js"></script> -->

    <!-- Show password -->
<!--     <script src="scripts/bootstrap-show-password.js"></script> -->

    <!-- Tail Select -->
<!--     <script src="./scripts/tail.select-full.js"></script> -->
    <script>
        tail.select('#select1', {
            search: true,
            classNames: "col sel1",
            width: "auto",
            placeholder: "Partenza",
            animate: true
            /* hideSelected: true,
            searchMarked: false */
        });
        tail.select('#select2', {
            search: true,
            classNames: "col sel2",
            width: "auto",
            placeholder: "Destinazione",
            animate: true
        });


        /* Switch form */
    
        $("#exchangeButton").click(function(e) {
            e.preventDefault();

            $(".fa-exchange").toggleClass("down");

            //var s1 = $("#select1").text();

            var e1 = document.getElementById("select1");
            var dspText1 = e1.options[e1.selectedIndex].text;
            var e2 = document.getElementById("select2");
            var dspText2 = e2.options[e2.selectedIndex].text;

            var s1_val = $("#select1").val();
            //var s2 = $("#select2").text();
            var s2_val = $("#select2").val();
            //console.log("partenza = " + $("#select1").val() + " arrivo = " + $("#select2").val());
            if (s1_val != null && s2_val != null) {

                $("#select1").val(s2_val);
                $("#select2").val(s1_val);

                $(".sel1 .select-label .label-inner").html(dspText2);
                $(".sel2 .select-label .label-inner").html(dspText1);
            /*  $("#select1").html(s2);
                $("#select2").html(s1); */
            }
            /* console.log("partenza = " + $("#select1").val() + " arrivo = " + $("#select2").val()); */
            /* var s1 = $(".sel1 div.select-dropdown div.dropdown-inner ul.dropdown-optgroup li.selected");
            $(s1).removeClass("selected"); */
        });
    

        /* DATAPICKER */
    

        var map;

        var currentMarkersStart=[];
        var currentMarkersStop=[];

        $(document).ready(function() {


            mapboxgl.accessToken = 'pk.eyJ1IjoicGFzc2EwMSIsImEiOiJja2FyYzVnaGgxeHd4MnNtdjduZ2Z4bDl4In0.QaR3jD8k-cmy6DtB0vl13w';
            map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11', /* mapbox://styles/passa01/ckawzonbd05gk1iqssxb1692g */
                center: [12.327145, 45.438759],
                maxZoom: 16,
                minZoom: 9,
                zoom: 12
            });
            // Add zoom and rotation controls to the map.
            map.addControl(new mapboxgl.NavigationControl());

            $("#results").hide();

            $.datepicker.setDefaults(
                $.extend({
                        'dateFormat': 'dd-mm-yy'
                    },
                    $.datepicker.regional['it']
                )
            );
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            $('#data').datepicker({
                format: "mm/dd/yyyy",
                todayHighlight: true,
                startDate: today,
                endDate: end,
                autoclose: true
            });

            $('#data').datepicker('setDate', today);
        });

        function setPoint(stop, select){

            if (select == 0) {
                // remove markers 
                if (currentMarkersStart!==null) {
                    for (var i = currentMarkersStart.length - 1; i >= 0; i--) {
                    currentMarkersStart[i].remove();
                    }
                }            
            }else{
                if (currentMarkersStop!==null) {
                    for (var i = currentMarkersStop.length - 1; i >= 0; i--) {
                    currentMarkersStop[i].remove();
                    }
                }            
            }


            $.ajax({
                type: "post",
                url: "./pages/getPoint.php",
                data: {'stopID': stop},
                dataType: "json",
                success: function (response) {
                    JSON.stringify(response);
                    console.log(response);
                    for (var i = 0; i < response.length; i++) {     
                        var marker = new mapboxgl.Marker()
                            .setLngLat(response[i])
                            .addTo(map);
                            if (select == 0) {
                                currentMarkersStart.push(marker);                                            
                            }else{
                                currentMarkersStop.push(marker);                                            
                            }
                    }
                }
            });
        }

        function printShape(a, color, markerStart_lat, markerStart_lon, markerStop_lat, markerStop_lon, markerStart_name, markerStop_name) { /* , markerStart_name, markerStop_name */
            for (var i = currentMarkersStart.length - 1; i >= 0; i--) {
                currentMarkersStart[i].remove();
            }
            for (var i = currentMarkersStop.length - 1; i >= 0; i--) {
                currentMarkersStop[i].remove();
            }

            var marker = new mapboxgl.Marker()
                .setLngLat({lng: markerStart_lon, lat: markerStart_lat})
                .setPopup(new mapboxgl.Popup().setHTML('<div class="text-info">'+markerStart_name+'</div>')) // add popup
                .addTo(map);
                currentMarkersStart.push(marker);  

            var marker = new mapboxgl.Marker()
                .setLngLat({lng: markerStop_lon, lat: markerStop_lat})
                .setPopup(new mapboxgl.Popup().setHTML('<div class="text-info">'+markerStop_name+'</div>')) // add popup
                .addTo(map);
                currentMarkersStop.push(marker);     

            if (color == '8FD2BF') {
                color = '07c08b'; //00ad7c
            }

            if (map.getLayer('route')){
                map.removeLayer('route');
            }

            if (map.getSource('route')){
                map.removeSource('route');
            }

            $.ajax({
                type: "post",
                url: "./pages/getShape.php",
                data: {'route': a , 'markerStart_lon': markerStart_lon, 'markerStart_lat': markerStart_lat, 'markerStop_lon': markerStop_lon, 'markerStop_lat': markerStop_lat},
                dataType: "json",
                success: function (response) {
                    // "response" è un oggetto JSON e contiene tutte le cooridnate dei punti del percorso
                    JSON.stringify(response);

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
                            'line-color': '#' + color,
                            'line-width': 3
                        }
                    });
                    
                    var coordinates = response;

                    // Pass the first coordinates in the LineString to `lngLatBounds` &
                    // wrap each coordinate pair in `extend` to include them in the bounds
                    // result. A variation of this technique could be applied to zooming
                    // to the bounds of multiple Points or Polygon geomteries - it just
                    // requires wrapping all the coordinates with the extend method.
                    var bounds = coordinates.reduce(function(bounds, coord) {
                    return bounds.extend(coord);
                    }, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));
                    
                    map.fitBounds(bounds, {
                    padding: 30
                    });
                }                            
            });

            //map.on('load', function() {

            //});
        }

        function showHideFullPath(i) {
            $("#fullPath" + i).slideToggle();
            $("#arrow" + i).toggleClass("down");
        }

        $("#searchButton").click(function (e) {
            e.preventDefault();
            if ($("#select1").val() !== null && $("#select2").val() !== null) {
                $("#loading").html('Attendi <span class="spinner-border spinner-border-sm my-1" role="status" aria-hidden="true"></span> ');
                $('#searchButton').addClass('disabled');
                /* $("#results").slideUp(400, function(){
                    search();
                }); */
                $("#results").hide('slide', function(){
                    search();
                });

                function search(){
                    $.ajax({
                        type: "post",
                        url: "./pages/queryPath.php",
                        data: $('#searchPathForm').serialize(),
                        success: function (response) {
                            /* alert(response); */
                            console.log(response);
                            if (map.getLayer('route')){
                                map.removeLayer('route');
                            }

                            if (map.getSource('route')){
                                map.removeSource('route');
                            }
                            var results = "";
                            var length = "";
                            if (response.length == 0) {
                                $("#results").show('slide');
                                $("#results").html('<div class="alert alert-warning" role="alert"><strong>Attenzione:</strong> Nessun battello trovato! <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>');
                            }else{                       
                                for (var i = 0; i < response.length; i++) {
                                    if (response[i].length !== 0){

                                        length = response[i].length -1;
                                        
                                        var hour0 = $("#oraPartenza").val();
                                        hour0 += ':00';
                                        hour0 = getMinutes(hour0);
                                        var hour1 = getMinutes(response[i][0].departure_time);
                                        var hour2 = getMinutes(response[i][length].arrival_time);

                                        var nextHour = hour1 - hour0;
                                        var totHour = hour2 - hour1;

                                        /* alert(length); */
                                        /*  PRIMO */
                                        results += 
                                        '<div class="card text-left mb-1" style="background-color: #e9ecef;">' +
                                            '<!-- <img class="card-img-top" src="holder.js/100px180/" alt=""> -->' +
                                            '<div class="card-body">' +           /*  */  
                                                '<div class="d-flex justify-content-between">' +                       
                                                '<h6 class="card-title p-1 px-3 rounded" style="color: #'+response[i][0].route_text_color+'; background-color:#'+ response[i][0].route_color +'">'+ response[i][0].route_short_name + '</h6>' +
                                                '<h6 class="card-title p-1 px-3 rounded" onclick="printShape('+response[i][0].route_id+',\''+ response[i][0].route_color+'\',\''+ response[i][0].stop_lat+'\',\''+ response[i][0].stop_lon+'\',\''+ response[i][length].stop_lat+'\',\''+ response[i][length].stop_lon+'\',\''+ response[i][0].mainStop_name+'\',\''+ response[i][length].mainStop_name+'\');" style="cursor: pointer;border: 0.5px solid;">Vedi percorso</h6>' +
                                                '</div>' +
                                                '<div class="d-flex justify-content-between">' +
                                                    '<p class="card-text mb-1"> Partenza: <strong>' + response[i][0].departure_time.slice(0,-3)  + "</strong> da " + response[i][0].mainStop_name +'</p>' +
                                                    '<div>' +
                                                        '<i class="fas fa-hourglass-start"></i> -' + nextHour + 'min ' +
                                                        '<i class="fas fa-stopwatch" aria-hidden="true"></i> ' + totHour + 'min' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div style="display: none;" id="fullPath' + i + '">';
                                                for (var j = 1; j <= length-1; j++) {
                                                    results += '<p class="card-text mb-1">'+ response[i][j].departure_time.slice(0,-3)  + ' <i class="fas fa-long-arrow-alt-right"></i> ' + response[i][j].mainStop_name +'</p>';
                                                }
                                                results +=
                                                '</div>' + 
                                                '<p class="card-text mb-1"> Arrivo: <strong>' + response[i][length].arrival_time.slice(0,-3) + "</strong> a " +  response[i][length].mainStop_name +'</p>' +
                                            '</div>' +
                                            '<div class="card-footer d-flex justify-content-between">' +
                                                '<i class="fa fa-heart-o" aria-hidden="true"></i>';
                                                if (response[i].length > 2) {
                                                    results += '<i id="arrow' + i + '" class="fa fa-angle-down rotate" aria-hidden="true" onclick="showHideFullPath(' + i + ');" style="cursor: pointer;"></i>';
                                                }                                        
                                            results += '</div>' +
                                        '</div>';
                                    }/* else{
                                        results += '<div class="alert alert-danger" role="alert"><strong>Errore:</strong> Inserisci dei valori nei campi di partenza e destinazione <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>';
                                    } */
                                }
                                $("#results").html(results);
                                $.ajax({
                                    type: "post",
                                    url: "./pages/addSearch.php",
                                    data: "",
                                    dataType: "",
                                    success: function (response) {
                                        
                                    }
                                });
                            }
                            $("#loading").html('Cerca <i class="fas fa-search">');
                            $('#searchButton').removeClass('disabled');
                            $("#results").show('slide');
                            // $("#results").slideDown(600);
                        },
                        dataType:"json"
                    });
                    return false;
                }
            }else{
                $("#results").show('slide');
                $("#results").html('<div class="alert alert-danger" role="alert"><strong>Errore:</strong> Inserisci dei valori nei campi di partenza e destinazione <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>');
            }
        });

        function getMinutes(hours) {
            var hms = hours;   // your input string
            var a = hms.split(':'); // split it at the colons
            // Hours are worth 60 minutes.
            var minutes = (+a[0]) * 60 + (+a[1]);
            return minutes;
        }
    </script>
</body>

</html>