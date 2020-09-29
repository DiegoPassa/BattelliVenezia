<?php

function loadAgency(){
    echo 'AGENCY <br>';
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
        
        //display data
        echo 'Row ' . $row . ' agency_id: ' . $info[$row]['agency_id'] . '<br />';
        echo 'Row ' . $row . ' agency_name: ' . $info[$row]['agency_name'] . '<br />';
        echo 'Row ' . $row . ' agency_url: ' . $info[$row]['agency_url'] . '<br />';
        echo 'Row ' . $row . ' agency_timezone: ' . $info[$row]['agency_timezone'] . '<br />';
        echo 'Row ' . $row . ' agency_lang: ' . $info[$row]['agency_lang'] . '<br />';
        echo 'Row ' . $row . ' agency_phone: ' . $info[$row]['agency_phone'] . '<br />';
        echo 'Row ' . $row . ' agency_fare_url: ' . $info[$row]['agency_fare_url'] . '<br />';
        echo '<br>';
    }
}

function loadCalendar(){
    echo 'CALENDAR <br>';
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
    
        //display data
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
        echo '<br>';
    }
}

function loadCalendar_Dates(){
    echo 'CALENDAR_DATES <br>';
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
    
        //display data
        echo 'Row ' . $row . ' service_id: ' . $info[$row]['service_id'] . '<br />';
        echo 'Row ' . $row . ' date: ' . $info[$row]['date'] . '<br />';
        echo 'Row ' . $row . ' exception_type: ' . $info[$row]['exception_type'] . '<br />';
        echo '<br>';
    }
}

function loadRoutes(){
    echo 'ROUTES <br>';
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
    
        //display data
        echo 'Row ' . $row . ' route_id: ' . $info[$row]['route_id'] . '<br />';
        echo 'Row ' . $row . ' agency_id: ' . $info[$row]['agency_id'] . '<br />';
        echo 'Row ' . $row . ' route_short_name: ' . $info[$row]['route_short_name'] . '<br />';
        echo 'Row ' . $row . ' route_long_name: ' . $info[$row]['route_long_name'] . '<br />';
        echo 'Row ' . $row . ' route_desc: ' . $info[$row]['route_desc'] . '<br />';
        echo 'Row ' . $row . ' route_type: ' . $info[$row]['route_type'] . '<br />';
        echo 'Row ' . $row . ' route_url: ' . $info[$row]['route_url'] . '<br />';
        echo 'Row ' . $row . ' route_color: ' . $info[$row]['route_color'] . '<br />';
        echo 'Row ' . $row . ' route_text_color: ' . $info[$row]['route_text_color'] . '<br />';
        echo '<br>';
    }
}

function loadShapes(){
    echo 'SHAPES <br>';
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
    
    
        //display data
        echo 'Row ' . $row . ' shape_id: ' . $info[$row]['shape_id'] . '<br />';
        echo 'Row ' . $row . ' shape_pt_lat: ' . $info[$row]['shape_pt_lat'] . '<br />';
        echo 'Row ' . $row . ' shape_pt_lon: ' . $info[$row]['shape_pt_lon'] . '<br />';
        echo 'Row ' . $row . ' shape_pt_sequence: ' . $info[$row]['shape_pt_sequence'] . '<br />';
        echo 'Row ' . $row . ' shape_dist_traveled: ' . $info[$row]['shape_dist_traveled'] . '<br />';
        echo '<br>';
    }
}

function loadStop_Times(){
    echo 'STOP_TIMES <br>';
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
    
        //display data
        echo 'Row ' . $row . ' trip_id: ' . $info[$row]['trip_id'] . '<br />';
        echo 'Row ' . $row . ' arrival_time: ' . $info[$row]['arrival_time'] . '<br />';
        echo 'Row ' . $row . ' departure_time: ' . $info[$row]['departure_time'] . '<br />';
        echo 'Row ' . $row . ' stop_id: ' . $info[$row]['stop_id'] . '<br />';
        echo 'Row ' . $row . ' stop_sequence: ' . $info[$row]['stop_sequence'] . '<br />';
        echo 'Row ' . $row . ' stop_headsign: ' . $info[$row]['stop_headsign'] . '<br />';
        echo 'Row ' . $row . ' pickup_type: ' . $info[$row]['pickup_type'] . '<br />';
        echo 'Row ' . $row . ' drop_off_type: ' . $info[$row]['drop_off_type'] . '<br />';
        echo 'Row ' . $row . ' shape_dist_traveled: ' . $info[$row]['shape_dist_traveled'] . '<br />';
        echo '<br>';
    }
}

function loadStops(){
    echo 'STOPS<br>';
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
    
        //display data
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
        echo '<br>';
    }
}

function loadTrips(){
    echo 'TRIPS<br>';
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
    
        //display data
        echo 'Row ' . $row . ' route_id: ' . $info[$row]['route_id'] . '<br />';
        echo 'Row ' . $row . ' service_id: ' . $info[$row]['service_id'] . '<br />';
        echo 'Row ' . $row . ' trip_id: ' . $info[$row]['trip_id'] . '<br />';
        echo 'Row ' . $row . ' trip_headsign: ' . $info[$row]['trip_headsign'] . '<br />';
        echo 'Row ' . $row . ' trip_short_name: ' . $info[$row]['trip_short_name'] . '<br />';
        echo 'Row ' . $row . ' direction_id: ' . $info[$row]['direction_id'] . '<br />';
        echo 'Row ' . $row . ' block_id: ' . $info[$row]['block_id'] . '<br />';
        echo 'Row ' . $row . ' shape_id: ' . $info[$row]['shape_id'] . '<br />';
        echo 'Row ' . $row . ' wheelchair_accessible: ' . $info[$row]['wheelchair_accessible'] . '<br />';
        echo '<br>';
    }
}


loadAgency();
loadCalendar();
loadCalendar_Dates();
loadRoutes();
loadShapes();
loadStop_Times();
loadStops();
loadTrips();


?>