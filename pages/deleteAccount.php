<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
    }else{
        include "./altro/connectionDB.php";
        $stmt = $conn->prepare("DELETE FROM `users` WHERE email = :email");
        $stmt->bindParam(':email', $_SESSION['user']); 
        $stmt->execute();
        session_destroy();
        header("location: ./../index.php");
    }

?>