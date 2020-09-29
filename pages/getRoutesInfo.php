<?php
    include_once "./altro/connectionDB.php";

    $result = array();

    $stmt = $conn->prepare('SELECT DISTINCT route_short_name, route_color, route_text_color FROM `routes` ORDER BY `route_short_name` ASC');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        array_push($result,$row);
    }
    
    echo json_encode($result);