<?php

//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=htmlspecialchars($_POST["id"]);
    $comment_title=htmlspecialchars($_POST["comment_title"]);
//    $comment_email=htmlspecialchars($_POST["comment_email"]);
    $blog_id=htmlspecialchars($_POST["blog_id"]);

    include_once  'dbh.php';
    include_once 'functions.php';



    updateComment($conn,$id,$comment_title,$blog_id);


}
else{
    header("Location: ../register.php");
    exit();
}