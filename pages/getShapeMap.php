<?php
    include_once "./altro/connectionDB.php";

    $result = array();

    $stmt = $conn->prepare('SELECT shapes.shape_pt_lon, shapes.shape_pt_lat FROM shapes INNER JOIN trips ON shapes.shape_id = trips.shape_id INNER JOIN routes ON routes.route_short_name = :routeId');
    $stmt->bindParam(':routeId', $_POST['routeId']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        array_push($result,$row);
    }
    
    echo json_encode($result);