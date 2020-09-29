<?php
    include_once "./altro/connectionDB.php";

    $result = array();
    $a = array();

    $stmt = $conn->prepare('SELECT stop_lat, stop_lon FROM `stops` INNER JOIN mainstops ON mainstops.mainStop_id = :stopID WHERE stops.stop_id = mainstops.stop_id ORDER BY `stop_name` ASC');
    $stmt->bindParam(':stopID', $_POST['stopID']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        array_push($result,$row['stop_lon'],$row['stop_lat']);
        array_push($a, $result);
        $result = [];
    }
    
    echo json_encode($a);