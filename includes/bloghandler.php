<?php

//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title=htmlspecialchars($_POST["title"]);
    $description=htmlspecialchars($_POST["description"]);


    include_once  'dbh.php';
    include_once 'functions.php';

    if(emptyInputLogin($title,$description)!==false){
        header("Location: ../blog.php?error=emptyinput");
        exit();
    }




    createBlog($conn,$title,$description);


}
else{
    header("Location: ../login.php");
    exit();
}
