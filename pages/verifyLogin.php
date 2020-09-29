<?php
    session_start();
    include "./altro/connectionDB.php";

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    if ($email == "" && $password == "") {
        echo "Compila i campi";
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");

    $stmt->bindParam(':email', $email);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        if (password_verify($password, $row['password'])){
            $_SESSION['user'] = $email;
            $_SESSION['userName'] = $row['name'];
            /* $_SESSION['userlastName'] = $row['lastName'];
            $_SESSION['userDoB'] = $row['dateOfBirth'];
            $_SESSION['userRegisterDate'] = $row['registerDate'];
            $_SESSION['totalSearch'] = $row['totalSearch']; */
            echo "login";
        }else{
            echo "Password o Email errata";
        }
    }

    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    /* echo $email . " " . $hashedPassword; */
    /* echo "test"; */
?>