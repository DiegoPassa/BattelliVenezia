<?php
    session_start();
    include "./altro/connectionDB.php";
    if (isset($_SESSION['user'])) {
        $stmt = $conn->prepare("UPDATE users SET totalSearch = totalSearch + 1 WHERE email = :email");

        $stmt->bindParam(':email', $_SESSION['user']);
    
        $stmt->execute();
    }
?>