<?php

//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=htmlspecialchars($_POST["email"]);
    $password=htmlspecialchars($_POST["password"]);


    include_once  'dbh.php';
    include_once 'functions.php';

    if(emptyInputLogin($email,$password)!==false){
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email,$password)!==false){
        header("Location: ../login.php?error=invalidemail");
        exit();
    }


    loginUser($conn,$email,$password);


}
else{
    header("Location: ../login.php");
    exit();
}
