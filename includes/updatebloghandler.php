<?php

//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=htmlspecialchars($_POST["id"]);
    $title=htmlspecialchars($_POST["title"]);
    $description=htmlspecialchars($_POST["description"]);

    include_once  'dbh.php';
    include_once 'functions.php';



    updateblog($conn,$id,$title,$description);


}
else{
    header("Location: ../register.php");
    exit();
}