<?php
    /* session_start(); */
    include "./altro/connectionDB.php";

    $partenza = test_input($_POST['partenza']);
    // $partenza = '"Accademia ""B"""';
    // $partenza = "Arsenale";
    //$partenza = 'San Silvestro';
    $destinazione = test_input($_POST['destinazione']);
    //$destinazione = 'San Silvestro';
    // $destinazione = '"Riva de Biasio ""B"""';
    // $destinazione = "San Tomà";
    /* $customRadioInline = test_input($_POST['customRadioInline']); */
  
    $orario = test_input($_POST['orario']);
    // $orario = "17:00";
    // $orario = "7:00";
/*    
    $giorno = test_input($_POST['giorno']);
*/
    // echo $partenza . "\n" . $destinazione . "\n" ./*$customRadioInline . "\n" . */$orario/* . "\n" . $giorno*/;

    $arrayResult = array();

    $routes = array();
    $trips = array();
    $startSequence = array();
    $stopSequence = array();

    
    /*     $stmt = $conn->prepare("SELECT stop_times.arrival_time, stop_times.departure_time, stop_times.stop_sequence, stops.stop_name, routes.route_short_name, routes.route_color, routes.route_text_color FROM stop_times INNER JOIN stops ON stops.stop_id = stop_times.stop_id INNER JOIN routes ON routes.route_id = 137 WHERE trip_id = 14228");
    */    
    // $stmt = $conn->prepare("CALL `pathfinderV4`(:orario, :partenza, :destinazione);");
    $stmt = $conn->prepare("CALL `pathfinderV2_3`(:orario, :partenza, :destinazione);");
    $stmt->bindParam(':orario', $orario);
    $stmt->bindParam(':partenza', $partenza);
    $stmt->bindParam(':destinazione', $destinazione);
    
    $stmt->execute();
    
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    while($row = $stmt->fetch()){
        array_push($routes, $row['idRoute']);
        array_push($trips, $row['idTrip']);
        array_push($startSequence, $row['stopSequence_start']);
        array_push($stopSequence, $row['stopSequence_stop']);
    }
    $stmt->closeCursor();
    
    $count = $stmt->rowCount();
    
    for ($i=0; $i < $count; $i++) { 
        $result = array();
        $path = $conn->prepare("SELECT stop_times.arrival_time, stop_times.departure_time, stop_times.stop_sequence, routes.route_id , mainstops.mainStop_name, stops.stop_lat, stops.stop_lon, routes.route_short_name, routes.route_color, routes.route_text_color FROM stop_times INNER JOIN mainstops ON mainstops.stop_id = stop_times.stop_id INNER JOIN stops ON stops.stop_id = mainstops.stop_id INNER JOIN routes ON routes.route_id = :routeId WHERE trip_id = :tripId AND stop_times.stop_sequence >= :stopSequence_start AND stop_times.stop_sequence <= :stopSequence_stop");  //SELECT stop_times.arrival_time, stop_times.departure_time, stop_times.stop_sequence, stops.stop_name, routes.route_id ,routes.route_short_name, routes.route_color, routes.route_text_color FROM stop_times INNER JOIN stops ON stops.stop_id = stop_times.stop_id INNER JOIN routes ON routes.route_id = :routeId WHERE trip_id = :tripId
        // //SELECT stop_times.arrival_time, stop_times.departure_time, stop_times.stop_sequence, routes.route_id , mainstops.mainStop_name, routes.route_short_name, routes.route_color, routes.route_text_color FROM stop_times INNER JOIN mainstops ON mainstops.stop_id = stop_times.stop_id INNER JOIN routes ON routes.route_id = :routeId WHERE trip_id = :tripId AND stop_times.stop_sequence >= :stopSequence_start AND stop_times.stop_sequence <= :stopSequence_stop
        $path->bindParam(':routeId', $routes[$i]);
        $path->bindParam(':tripId', $trips[$i]);
        $path->bindParam(':stopSequence_start', $startSequence[$i]);
        $path->bindParam(':stopSequence_stop', $stopSequence[$i]);
        $path->execute();
        $path->setFetchMode(PDO::FETCH_ASSOC);
        while($rowPath = $path->fetch()){   
            array_push($result, $rowPath);
        }
        array_push($arrayResult, $result);
        unset($result);
    }

    echo json_encode($arrayResult);
   
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    /* echo $email . " " . $hashedPassword; */
    /* echo "test"; */
?>