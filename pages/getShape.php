<?php
    include_once "./altro/connectionDB.php";

    $routeID = $_POST['route'];

    $result = array();
    $a = array();


    $shape = $conn->prepare('SELECT DISTINCT shape_id FROM `trips` WHERE route_id = :routeID');
    $shape->bindParam(':routeID', $routeID);
    $shape->execute();
    $shape->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $shape->fetch()){
        $shapeID = $row['shape_id'];
    }

    $stmt = $conn->prepare('SELECT shape_pt_lat, shape_pt_lon FROM `shapes` WHERE `shape_id` = :shapeID AND shapes.shape_pt_sequence >= (SELECT shape_pt_sequence FROM `shapes` WHERE shapes.shape_id = :shapeID AND shapes.shape_pt_lat = :markerStart_lat AND shapes.shape_pt_lon = :markerStart_lon LIMIT 1) AND shapes.shape_pt_sequence <= (SELECT shape_pt_sequence FROM `shapes` WHERE `shape_id` = :shapeID AND shapes.shape_pt_lat = :markerStop_lat AND shapes.shape_pt_lon = :markerStop_lon AND shape_pt_sequence > 0 LIMIT 1);'); 
    //SELECT shape_pt_lat, shape_pt_lon FROM `shapes` WHERE `shape_id` = :shapeID
    $stmt->bindParam(':shapeID', $shapeID);

    $stmt->bindParam(':markerStart_lat', $_POST['markerStart_lat']);
    $stmt->bindParam(':markerStart_lon', $_POST['markerStart_lon']);

    $stmt->bindParam(':markerStop_lat', $_POST['markerStop_lat']);
    $stmt->bindParam(':markerStop_lon', $_POST['markerStop_lon']);
    $stmt->execute();
    
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $numItems = $stmt->rowCount();
    $i = 0;
    
    while($row = $stmt->fetch()){
        $shape_pt_lon = (float)$row['shape_pt_lon'];
        $shape_pt_lat = (float)$row['shape_pt_lat'];
        array_push($result, $shape_pt_lon, $shape_pt_lat);
        array_push($a, $result);
        $result = [];
    }
    
    echo json_encode($a);