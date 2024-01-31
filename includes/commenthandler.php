<?php

session_start();

if (!isset($_SESSION['useremail'])) {
    header("Location: ../login.php");
    exit();
}
//global $conn;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $comment_title=htmlspecialchars($_POST["comment_title"]);
//    $comment_email=htmlspecialchars($_SESSION['useremail']);
    $blog_id=htmlspecialchars($_POST['blog_id']);
    $user_id=htmlspecialchars($_SESSION['id']);

    include_once  'dbh.php';
    include_once 'functions.php';

//    if(emptyInputLogin($comment_title,$user_id,$blog_id)!==false){
//        header("Location: ../blog.php?error=emptyinput");
//        exit();
//    }

    if(emptyComment($comment_title,$blog_id,$user_id)!==false){
        header("Location: ../blogeach.php?id=".$blog_id."&&error=fillallblanks");
        exit();
    }




    createComment($conn,$comment_title,$blog_id,$user_id);
    header("Location: ../blogeach.php?id=".$blog_id);
    exit();

}
else{
    header("Location: ../login.php");
    exit();
}
