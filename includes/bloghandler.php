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
    $created_by=htmlspecialchars($_SESSION['useremail']);

    include_once  'dbh.php';
    include_once 'functions.php';

    if(emptyInputLogin($title,$description)!==false){
        header("Location: ../blog.php?error=emptyinput");
        exit();
    }




    createBlog($conn,$title,$description,$created_by);


}
else{
    header("Location: ../login.php");
    exit();
}
