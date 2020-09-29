<?php
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