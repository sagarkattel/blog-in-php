<?php

session_start();

if (!isset($_SESSION['useremail'])) {
    header("Location: ../login.php");
    exit();
}
//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title=htmlspecialchars($_POST["title"]);
    $description=htmlspecialchars($_POST["description"]);
//    $created_by=htmlspecialchars($_SESSION['useremail']);
    $user_id=htmlspecialchars($_SESSION["id"]);

    include_once  'dbh.php';
    include_once 'functions.php';

    if(emptyInputLogin($title,$description)!==false){
        header("Location: ../blogcreate.php?error=emptyinput");
        exit();
    }




    createBlog($conn,$title,$description,$user_id);


}
else{
    header("Location: ../login.php");
    exit();
}
