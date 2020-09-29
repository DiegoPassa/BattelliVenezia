<?php
    session_start();
    include "./altro/connectionDB.php";
    if (isset($_SESSION['user'])) {

        $user = array();

        $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = :email");

        $stmt->bindParam(':email', $_SESSION['user']);
    
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        while($row = $stmt->fetch()){
            array_push($user, $row);
        }

        echo json_encode($user);

    }
?>