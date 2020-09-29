<?php

set_time_limit(1800);
session_start();

function loadAgency(){   

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `agency` WHERE 1");

    echo '<br> Loading AGENCY..';
    // Agency
    $txt_file    = file_get_contents("D:\User\Downloads\actv_nav\agency.txt");
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
        
        $info[$row]['agency_id']             = $row_data[0];
        $info[$row]['agency_name']           = $row_data[1];
        $info[$row]['agency_url']            = $row_data[2];
        $info[$row]['agency_timezone']       = $row_data[3];
        $info[$row]['agency_lang']           = $row_data[4];
        $info[$row]['agency_phone']          = $row_data[5];
        $info[$row]['agency_fare_url']       = $row_data[6];
        
        /*/display data
        echo 'Row ' . $row . ' agency_id: ' . $info[$row]['agency_id'] . '<br />';
        echo 'Row ' . $row . ' agency_name: ' . $info[$row]['agency_name'] . '<br />';
        echo 'Row ' . $row . ' agency_url: ' . $info[$row]['agency_url'] . '<br />';
        echo 'Row ' . $row . ' agency_timezone: ' . $info[$row]['agency_timezone'] . '<br />';
        echo 'Row ' . $row . ' agency_lang: ' . $info[$row]['agency_lang'] . '<br />';
        echo 'Row ' . $row . ' agency_phone: ' . $info[$row]['agency_phone'] . '<br />';
        echo 'Row ' . $row . ' agency_fare_url: ' . $info[$row]['agency_fare_url'] . '<br />';
        echo '<br>'; */

        $result = $conn->prepare("INSERT INTO `agency`(`agency_id`, `agency_name`, `agency_url`, `agency_timezone`, `agency_lang`, `agency_phone`, `agency_fare_url`) VALUES (:agency_id,:agency_name,:agency_url,:agency_timezone,:agency_lang,:agency_phone,:agency_fare_url)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':agency_id', $info[$row]['agency_id']);
        $result->bindParam(':agency_name', $info[$row]['agency_name'] );
        $result->bindParam(':agency_url', $info[$row]['agency_url']);
        $result->bindParam(':agency_timezone', $info[$row]['agency_timezone']);
        $result->bindParam(':agency_lang', $info[$row]['agency_lang']);
        $result->bindParam(':agency_phone', $info[$row]['agency_phone']);
        $result->bindParam(':agency_fare_url', $info[$row]['agency_fare_url']);

        $result->execute();
    }

    echo '<br>-Agency OK <br><br>';
}

function loadCalendar(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `calendar` WHERE 1");

    echo '<br> Loading CALENDAR..';
    $txt_file    = file_get_contents("D:\User\Downloads\actv_nav\calendar.txt");
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['service_id']       = $row_data[0];
        $info[$row]['monday']           = $row_data[1];
        $info[$row]['tuesday']          = $row_data[2];
        $info[$row]['wednesday']        = $row_data[3];
        $info[$row]['thursday']         = $row_data[4];
        $info[$row]['friday']           = $row_data[5];
        $info[$row]['saturday']         = $row_data[6];
        $info[$row]['sunday']           = $row_data[7];
        $info[$row]['start_date']       = $row_data[8];
        $info[$row]['end_date']         = $row_data[9];
    
        /*/display data
        echo 'Row ' . $row . ' service_id: ' . $info[$row]['service_id'] . '<br />';
        echo 'Row ' . $row . ' monday: ' . $info[$row]['monday'] . '<br />';
        echo 'Row ' . $row . ' tuesday: ' . $info[$row]['tuesday'] . '<br />';
        echo 'Row ' . $row . ' wednesday: ' . $info[$row]['wednesday'] . '<br />';
        echo 'Row ' . $row . ' thursday: ' . $info[$row]['thursday'] . '<br />';
        echo 'Row ' . $row . ' friday: ' . $info[$row]['friday'] . '<br />';
        echo 'Row ' . $row . ' saturday: ' . $info[$row]['saturday'] . '<br />';
        echo 'Row ' . $row . ' sunday: ' . $info[$row]['sunday'] . '<br />';
        echo 'Row ' . $row . ' start_date: ' . $info[$row]['start_date'] . '<br />';
        echo 'Row ' . $row . ' end_date: ' . $info[$row]['end_date'] . '<br />';
        echo '<br>'; */

        $result = $conn->prepare("INSERT INTO `calendar`(`service_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `start_date`, `end_date`) VALUES (:service_id,:monday,:tuesday,:wednesday,:thursday,:friday,:saturday,:sunday,:start_date,:end_date)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':service_id', $info[$row]['service_id']);
        $result->bindParam(':monday', $info[$row]['monday'] );
        $result->bindParam(':tuesday', $info[$row]['tuesday']);
        $result->bindParam(':wednesday', $info[$row]['wednesday']);
        $result->bindParam(':thursday', $info[$row]['thursday']);
        $result->bindParam(':friday', $info[$row]['friday']);
        $result->bindParam(':saturday', $info[$row]['saturday']);
        $result->bindParam(':sunday', $info[$row]['sunday']);
        $result->bindParam(':start_date', $info[$row]['start_date']);
        $result->bindParam(':end_date', $info[$row]['end_date']);

        $result->execute();
    }

    echo '<br>-Calendar OK <br><br>';
}

function loadCalendar_Dates(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `calendar_dates` WHERE 1");

    echo '<br> Loading CALENDAR_DATES..';
    $txt_file    = file_get_contents("D:\User\Downloads\actv_nav\calendar_dates.txt");
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['service_id']       = $row_data[0];
        $info[$row]['date']             = $row_data[1];
        $info[$row]['exception_type']   = $row_data[2];
    
        /*/display data
        echo 'Row ' . $row . ' service_id: ' . $info[$row]['service_id'] . '<br />';
        echo 'Row ' . $row . ' date: ' . $info[$row]['date'] . '<br />';
        echo 'Row ' . $row . ' exception_type: ' . $info[$row]['exception_type'] . '<br />';
        echo '<br>';*/

        $result = $conn->prepare("INSERT INTO `calendar_dates`(`service_id`, `date`, `exception_type`) VALUES (:service_id,:date,:exception_type)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':service_id', $info[$row]['service_id']);
        $result->bindParam(':date', $info[$row]['date'] );
        $result->bindParam(':exception_type', $info[$row]['exception_type']);

        $result->execute();
    }

    echo '<br>-Calendar_Dates OK <br><br>';
}

function loadRoutes(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `routes` WHERE 1");

    echo '<br> Loading ROUTES..';
    $txt_file    = file_get_contents('D:\User\Downloads\actv_nav\routes.txt');
    
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['route_id']            = $row_data[0];
        $info[$row]['agency_id']           = $row_data[1];
        $info[$row]['route_short_name']    = $row_data[2];
        $info[$row]['route_long_name']     = $row_data[3];
        $info[$row]['route_desc']          = $row_data[4];
        $info[$row]['route_type']          = $row_data[5];
        $info[$row]['route_url']           = $row_data[6];
        $info[$row]['route_color']         = $row_data[7];
        $info[$row]['route_text_color']    = $row_data[8];
    
        /*/display data
        echo 'Row ' . $row . ' route_id: ' . $info[$row]['route_id'] . '<br />';
        echo 'Row ' . $row . ' agency_id: ' . $info[$row]['agency_id'] . '<br />';
        echo 'Row ' . $row . ' route_short_name: ' . $info[$row]['route_short_name'] . '<br />';
        echo 'Row ' . $row . ' route_long_name: ' . $info[$row]['route_long_name'] . '<br />';
        echo 'Row ' . $row . ' route_desc: ' . $info[$row]['route_desc'] . '<br />';
        echo 'Row ' . $row . ' route_type: ' . $info[$row]['route_type'] . '<br />';
        echo 'Row ' . $row . ' route_url: ' . $info[$row]['route_url'] . '<br />';
        echo 'Row ' . $row . ' route_color: ' . $info[$row]['route_color'] . '<br />';
        echo 'Row ' . $row . ' route_text_color: ' . $info[$row]['route_text_color'] . '<br />';
        echo '<br>'; */

        $result = $conn->prepare("INSERT INTO `routes`(`route_id`, `agency_id`, `route_short_name`, `route_long_name`, `route_desc`, `route_type`, `route_url`, `route_color`, `route_text_color`) VALUES (:route_id,:agency_id,:route_short_name,:route_long_name,:route_desc,:route_type,:route_url,:route_color,:route_text_color)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':route_id', $info[$row]['route_id']);
        $result->bindParam(':agency_id', $info[$row]['agency_id'] );
        $result->bindParam(':route_short_name', $info[$row]['route_short_name']);
        $result->bindParam(':route_long_name', $info[$row]['route_long_name']);
        $result->bindParam(':route_desc', $info[$row]['route_desc']);
        $result->bindParam(':route_type', $info[$row]['route_type']);
        $result->bindParam(':route_url', $info[$row]['route_url']);
        $result->bindParam(':route_color', $info[$row]['route_color']);
        $result->bindParam(':route_text_color', $info[$row]['route_text_color']);
        $result->execute();
    }
    echo '<br>-Routes OK <br><br>';
}

function loadShapes(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `shapes` WHERE 1");

    echo '<br> Loading SHAPES..';
    $txt_file    = file_get_contents('D:\User\Downloads\actv_nav\shapes.txt');
    
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['shape_id']                  = $row_data[0];
        $info[$row]['shape_pt_lat']              = $row_data[1];
        $info[$row]['shape_pt_lon']              = $row_data[2];
        $info[$row]['shape_pt_sequence']         = $row_data[3];
        $info[$row]['shape_dist_traveled']       = $row_data[4];
    
    
        /*/display data
        echo 'Row ' . $row . ' shape_id: ' . $info[$row]['shape_id'] . '<br />';
        echo 'Row ' . $row . ' shape_pt_lat: ' . $info[$row]['shape_pt_lat'] . '<br />';
        echo 'Row ' . $row . ' shape_pt_lon: ' . $info[$row]['shape_pt_lon'] . '<br />';
        echo 'Row ' . $row . ' shape_pt_sequence: ' . $info[$row]['shape_pt_sequence'] . '<br />';
        echo 'Row ' . $row . ' shape_dist_traveled: ' . $info[$row]['shape_dist_traveled'] . '<br />';
        echo '<br>'; */

        $result = $conn->prepare("INSERT INTO `shapes`(`shape_id`, `shape_pt_lat`, `shape_pt_lon`, `shape_pt_sequence`, `shape_dist_traveled`) VALUES (:shape_id,:shape_pt_lat,:shape_pt_lon,:shape_pt_sequence,:shape_dist_traveled)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':shape_id', $info[$row]['shape_id']);
        $result->bindParam(':shape_pt_lat', $info[$row]['shape_pt_lat'] );
        $result->bindParam(':shape_pt_lon', $info[$row]['shape_pt_lon']);
        $result->bindParam(':shape_pt_sequence', $info[$row]['shape_pt_sequence']);
        $result->bindParam(':shape_dist_traveled', $info[$row]['shape_dist_traveled']);
        $result->execute();
    }
    echo '<br>-Shapes OK <br><br>';
}

function loadStop_Times(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `stop_times` WHERE 1");

    echo '<br> Loading STOP_TIMES..';
    $txt_file    = file_get_contents('D:\User\Downloads\actv_nav\stop_times.txt');
    
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['trip_id']            = $row_data[0];
        $info[$row]['arrival_time']           = $row_data[1];
        $info[$row]['departure_time']    = $row_data[2];
        $info[$row]['stop_id']     = $row_data[3];
        $info[$row]['stop_sequence']          = $row_data[4];
        $info[$row]['stop_headsign']          = $row_data[5];
        $info[$row]['pickup_type']           = $row_data[6];
        $info[$row]['drop_off_type']         = $row_data[7];
        $info[$row]['shape_dist_traveled']    = $row_data[8];
    
        /*/display data
        echo 'Row ' . $row . ' trip_id: ' . $info[$row]['trip_id'] . '<br />';
        echo 'Row ' . $row . ' arrival_time: ' . $info[$row]['arrival_time'] . '<br />';
        echo 'Row ' . $row . ' departure_time: ' . $info[$row]['departure_time'] . '<br />';
        echo 'Row ' . $row . ' stop_id: ' . $info[$row]['stop_id'] . '<br />';
        echo 'Row ' . $row . ' stop_sequence: ' . $info[$row]['stop_sequence'] . '<br />';
        echo 'Row ' . $row . ' stop_headsign: ' . $info[$row]['stop_headsign'] . '<br />';
        echo 'Row ' . $row . ' pickup_type: ' . $info[$row]['pickup_type'] . '<br />';
        echo 'Row ' . $row . ' drop_off_type: ' . $info[$row]['drop_off_type'] . '<br />';
        echo 'Row ' . $row . ' shape_dist_traveled: ' . $info[$row]['shape_dist_traveled'] . '<br />';
        echo '<br>';*/

        $result = $conn->prepare("INSERT INTO `stop_times`(`trip_id`, `arrival_time`, `departure_time`, `stop_id`, `stop_sequence`, `stop_headsign`, `pickup_type`, `drop_off_type`, `shape_dist_traveled`) VALUES (:trip_id,:arrival_time,:departure_time,:stop_id,:stop_sequence,:stop_headsign,:pickup_type,:drop_off_type,:shape_dist_traveled)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':trip_id', $info[$row]['trip_id']);
        $result->bindParam(':arrival_time', $info[$row]['arrival_time'] );
        $result->bindParam(':departure_time', $info[$row]['departure_time']);
        $result->bindParam(':stop_id', $info[$row]['stop_id']);
        $result->bindParam(':stop_sequence', $info[$row]['stop_sequence']);
        $result->bindParam(':stop_headsign', $info[$row]['stop_headsign']);
        $result->bindParam(':pickup_type', $info[$row]['pickup_type']);
        $result->bindParam(':drop_off_type', $info[$row]['drop_off_type']);
        $result->bindParam(':shape_dist_traveled', $info[$row]['shape_dist_traveled']);

        $result->execute();
    }

    echo '<br>-Stop_times OK <br><br>';
}

function loadStops(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `stops` WHERE 1");

    echo '<br> Loading STOPS..';
    $txt_file    = file_get_contents('D:\User\Downloads\actv_nav\stops.txt');
    
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['stop_id']                = $row_data[0];
        $info[$row]['stop_code']              = $row_data[1];
        $info[$row]['stop_name']              = $row_data[2];
        $info[$row]['stop_desc']              = $row_data[3];
        $info[$row]['stop_lat']               = $row_data[4];
        $info[$row]['stop_lon']               = $row_data[5];
        $info[$row]['zone_id']                = $row_data[6];
        $info[$row]['stop_url']               = $row_data[7];
        $info[$row]['location_type']          = $row_data[8];
        $info[$row]['parent_station']         = $row_data[9];
        $info[$row]['stop_timezone']          = $row_data[10];
        $info[$row]['wheelchair_boarding']    = $row_data[11];
    
        /*/display data
        echo 'Row ' . $row . ' stop_id: ' . $info[$row]['stop_id'] . '<br />';
        echo 'Row ' . $row . ' stop_code: ' . $info[$row]['stop_code'] . '<br />';
        echo 'Row ' . $row . ' stop_name: ' . $info[$row]['stop_name'] . '<br />';
        echo 'Row ' . $row . ' stop_desc: ' . $info[$row]['stop_desc'] . '<br />';
        echo 'Row ' . $row . ' stop_lat: ' . $info[$row]['stop_lat'] . '<br />';
        echo 'Row ' . $row . ' stop_lon: ' . $info[$row]['stop_lon'] . '<br />';
        echo 'Row ' . $row . ' zone_id: ' . $info[$row]['zone_id'] . '<br />';
        echo 'Row ' . $row . ' stop_url: ' . $info[$row]['stop_url'] . '<br />';
        echo 'Row ' . $row . ' location_type: ' . $info[$row]['location_type'] . '<br />';
        echo 'Row ' . $row . ' parent_station: ' . $info[$row]['parent_station'] . '<br />';
        echo 'Row ' . $row . ' stop_timezone: ' . $info[$row]['stop_timezone'] . '<br />';
        echo 'Row ' . $row . ' wheelchair_boarding: ' . $info[$row]['wheelchair_boarding'] . '<br />';
        echo '<br>'; */

        $result = $conn->prepare("INSERT INTO `stops`(`stop_id`, `stop_code`, `stop_name`, `stop_desc`, `stop_lat`, `stop_lon`, `zone_id`, `stop_url`, `location_type`, `parent_station`, `stop_timezone`, `wheelchair_boarding`) VALUES (:stop_id,:stop_code,:stop_name,:stop_desc,:stop_lat,:stop_lon,:zone_id,:stop_url,:location_type,:parent_station,:stop_timezone,:wheelchair_boarding)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':stop_id', $info[$row]['stop_id']);
        $result->bindParam(':stop_code', $info[$row]['stop_code'] );
        $result->bindParam(':stop_name', $info[$row]['stop_name']);
        $result->bindParam(':stop_desc', $info[$row]['stop_desc']);
        $result->bindParam(':stop_lat', $info[$row]['stop_lat']);
        $result->bindParam(':stop_lon', $info[$row]['stop_lon']);
        $result->bindParam(':zone_id', $info[$row]['zone_id']);
        $result->bindParam(':stop_url', $info[$row]['stop_url']);
        $result->bindParam(':location_type', $info[$row]['location_type']);
        $result->bindParam(':parent_station', $info[$row]['parent_station']);
        $result->bindParam(':stop_timezone', $info[$row]['stop_timezone']);
        $result->bindParam(':wheelchair_boarding', $info[$row]['wheelchair_boarding']);

        $result->execute();
    }
    echo '<br>-Stops OK <br><br>';
}

function loadTrips(){

    require 'connectionDB.php';

    $result = $conn->query("DELETE FROM `trips` WHERE 1");

    echo '<br> Loading TRIPS..';
    $txt_file    = file_get_contents('D:\User\Downloads\actv_nav\trips.txt');
    
    //"D:\User\Downloads\actv_nav\agency.txt"
    // C:\Users\passarella\Desktop\actv_nav\agency.txt"
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
    
    foreach($rows as $row => $data){
        
        //get row data
        $row_data = explode(',', $data);
    
        $info[$row]['route_id']                = $row_data[0];
        $info[$row]['service_id']              = $row_data[1];
        $info[$row]['trip_id']                 = $row_data[2];
        $info[$row]['trip_headsign']           = $row_data[3];
        $info[$row]['trip_short_name']         = $row_data[4];
        $info[$row]['direction_id']            = $row_data[5];
        $info[$row]['block_id']                = $row_data[6];
        $info[$row]['shape_id']                = $row_data[7];
        $info[$row]['wheelchair_accessible']   = $row_data[8];
    
        /*/display data
        echo 'Row ' . $row . ' route_id: ' . $info[$row]['route_id'] . '<br />';
        echo 'Row ' . $row . ' service_id: ' . $info[$row]['service_id'] . '<br />';
        echo 'Row ' . $row . ' trip_id: ' . $info[$row]['trip_id'] . '<br />';
        echo 'Row ' . $row . ' trip_headsign: ' . $info[$row]['trip_headsign'] . '<br />';
        echo 'Row ' . $row . ' trip_short_name: ' . $info[$row]['trip_short_name'] . '<br />';
        echo 'Row ' . $row . ' direction_id: ' . $info[$row]['direction_id'] . '<br />';
        echo 'Row ' . $row . ' block_id: ' . $info[$row]['block_id'] . '<br />';
        echo 'Row ' . $row . ' shape_id: ' . $info[$row]['shape_id'] . '<br />';
        echo 'Row ' . $row . ' wheelchair_accessible: ' . $info[$row]['wheelchair_accessible'] . '<br />';
        echo '<br>';*/

        $result = $conn->prepare("INSERT INTO `trips`(`route_id`, `service_id`, `trip_id`, `trip_headsign`, `trip_short_name`, `direction_id`, `block_id`, `shape_id`, `wheelchair_accessible`) VALUES (:route_id,:service_id,:trip_id,:trip_headsign,:trip_short_name,:direction_id,:block_id,:shape_id,:wheelchair_accessible)");
        //$result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->bindParam(':route_id', $info[$row]['route_id']);
        $result->bindParam(':service_id', $info[$row]['service_id'] );
        $result->bindParam(':trip_id', $info[$row]['trip_id']);
        $result->bindParam(':trip_headsign', $info[$row]['trip_headsign']);
        $result->bindParam(':trip_short_name', $info[$row]['trip_short_name']);
        $result->bindParam(':direction_id', $info[$row]['direction_id']);
        $result->bindParam(':block_id', $info[$row]['block_id']);
        $result->bindParam(':shape_id', $info[$row]['shape_id']);
        $result->bindParam(':wheelchair_accessible', $info[$row]['wheelchair_accessible']);

        $result->execute();
    }

    echo '<br>-Trips OK <br><br>';
}

loadAgency();
loadCalendar();
loadCalendar_Dates();
loadRoutes();
loadShapes();
loadStops();
loadTrips();
loadStop_Times();

echo '<br>DATABASE UPDATED!';

?>