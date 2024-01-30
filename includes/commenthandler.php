<?php

session_start();

if (!isset($_SESSION['useremail'])) {
    header("Location: ../login.php");
    exit();
}
//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $comment_title=htmlspecialchars($_POST["comment_title"]);
    $comment_email=htmlspecialchars($_SESSION['useremail']);
    $blog_id=htmlspecialchars($_POST['blog_id']);

    include_once  'dbh.php';
    include_once 'functions.php';

    if(emptyInputLogin($comment_title,$comment_email)!==false){
        header("Location: ../blog.php?error=emptyinput");
        exit();
    }




    createComment($conn,$comment_title,$comment_email,$blog_id);
    header("Location: ../blogeach.php?id=".$blog_id);
    exit();

}
else{
    header("Location: ../login.php");
    exit();
}
