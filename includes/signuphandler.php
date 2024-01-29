<?php

//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=htmlspecialchars($_POST["email"]);
    $password=htmlspecialchars($_POST["password"]);
    $confirm_password=htmlspecialchars($_POST["confirm_password"]);


    include_once  'dbh.php';
    include_once 'functions.php';

    if(emptyInputSignup($email,$password,$confirm_password)!==false){
        header("Location: ../register.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email,$password)!==false){
        header("Location: ../register.php?error=invalidemail");
        exit();
    }
    

    if(pwdMatch($password,$confirm_password)){
        header("Location: ../register.php?error=passwordsdonotmatch");
        exit();
    }

    if(emailExists($conn,$email)!==false){
        header("Location: ../register.php?error=Emailalreadyexists");
        exit();
    }

    createUser($conn,$email,$password);


}
else{
    header("Location: ../register.php");
    exit();
}