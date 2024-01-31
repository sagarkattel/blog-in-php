<?php

//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=htmlspecialchars($_POST["id"]);
    $title=htmlspecialchars($_POST["title"]);
    $description=htmlspecialchars($_POST["description"]);
    $user_id=htmlspecialchars($_POST["user_id"]);

    include_once  'dbh.php';
    include_once 'functions.php';



    updateblog($conn,$id,$title,$description,$user_id);


}
else{
    header("Location: ../register.php");
    exit();
}