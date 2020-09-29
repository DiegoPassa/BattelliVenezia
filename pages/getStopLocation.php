<?php
    include_once "./altro/connectionDB.php";

    $result = array();
    $a = array();

    $stmt = $conn->prepare('SELECT stop_lat, stop_lon, mainstops.mainStop_name FROM `stops` INNER join mainstops ON mainstops.stop_id = stops.stop_id ORDER BY `stop_name` ASC');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        array_push($result,$row['stop_lon'],$row['stop_lat'],$row['mainStop_name']);
        array_push($a, $result);
        $result = [];
    }
    
    echo json_encode($a);