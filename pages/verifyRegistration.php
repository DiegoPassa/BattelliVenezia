<?php
    require "altro/connectionDB.php";

    $errors = array();

    $name = test_input($_POST['name']);
    $lastName = test_input($_POST['lastName']);
    $email = test_input($_POST['email']);
    $DoB = test_input($_POST['DoB']);
    $password =test_input($_POST['password']);
    $confirmPassword = test_input($_POST['confirmPassword']);

    $stmt = $conn->prepare("INSERT INTO `users`(`name`, `lastName`, `email`, `password`, `dateOfBirth`) VALUES (:name,:lastName,:email,:password,:DoB)");

    // CHECK EMAIL
    $emailVerify = $conn->prepare("SELECT * FROM `users` WHERE email = :email");
    $emailVerify->bindParam(':email', $email);
    $emailVerify->execute();
    $emailVerify->setFetchMode(PDO::FETCH_ASSOC);
    if ($emailVerify->rowCount() == 1) {
        array_push($errors,'emailAlreadyUsed');
    }


    // NOME
    if (empty($name)) {
        array_push($errors,'emptyName');
    } else if(strlen($name)>20){
        array_push($errors,'20charName');
    }else{
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            array_push($errors,'invalidName');
        }
    }

    // COGNOME
    if (empty($lastName)) {
        array_push($errors,'emptyLastName');
    } else if(strlen($lastName)>20){
        array_push($errors,'20charLastName');
    }else{
        if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
            array_push($errors,'invalidLastName');
        }
    }

    // EMAIL
    if (empty($email)){
        array_push($errors,'emptyEmail');
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors,'invalidEmailFormat');
    }

    // DATA DI NASCITA
/*     $DoB= $_POST["DoB"]; */

    // PASSWORD
    if (empty($password)){
        array_push($errors,'emptyPassword');
    } else if(strlen($password) < 8){
        array_push($errors,'less8charPass');
    }
    
    // CONFIRM PASSWORD
    if (empty($confirmPassword)) {
        array_push($errors,'emptyConfirmPassword');
    } else if($password != $confirmPassword ){
        array_push($errors,'invalidConfirmPassword');
    }
    
    if(empty($errors)){

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':DoB', $DoB);
        $stmt->execute();
        array_push($errors,'ok');
    }

    echo json_encode($errors);

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
?>