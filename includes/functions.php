<?php

function emptyInputSignup($email,$password,$confirm_password){
    $result;
    if(empty($email)||empty($password)||empty($confirm_password)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function emptyInputLogin($email,$password){
    $result;
    if(empty($email)||empty($password)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function emptyComment($comment_title,$blog_id,$user_id){
    $result;
    if (empty($comment_title)||empty($blog_id)||empty($user_id)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}




function invalidEmail($email){
    $result;
    if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function pwdMatch($password,$confirm_password){
    $result;
    if($password!==$confirm_password){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function emailExists($conn,$email){
    $sql="SELECT * FROM User WHERE email = ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn,$name,$email,$password){
    $sql="INSERT INTO User(name,email,password) VALUES(?,?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }
    $hashedPwd=password_hash($password,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"sss",$name,$email,$hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../login.php?error=usercreated");
    exit();
}

function loginUser($conn,$email,$password){
    $emailExists=emailExists($conn,$email);

    if($emailExists===false){
        header("Location: ../login.php?error=wronglogin");
        exit();
    }
    $pwdHashed=$emailExists["password"];
    $checkPwd=password_verify($password,$pwdHashed);

    if($checkPwd===false){
        header("Location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd===true){
        session_start();
        $_SESSION["useremail"]=$emailExists["email"];
        $_SESSION["id"]=$emailExists["id"];
        header("Location: ../index.php");
        exit();
    }
}

function listEachUser($conn,$id){
    $sql="SELECT * FROM User WHERE id=".$id.";";
    $result=$conn->query($sql);
    $users=$result->fetch_all(MYSQLI_ASSOC);
    return $users;
}

function listUser($conn){
    $sql="SELECT * FROM User;";
    $result=$conn->query($sql);
    $users=$result->fetch_all(MYSQLI_ASSOC);
    return $users;
}

function listBlog($conn){
    $sql="SELECT * FROM Blog;";
    $result=$conn->query($sql);
    $blogs=$result->fetch_all(MYSQLI_ASSOC);
    return $blogs;
}

function createBlog($conn,$title,$description,$user_id)
{
    $sql="INSERT INTO Blog(title,description,user_id) VALUES(?,?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../blogcreate.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss",$title,$description,$user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../blogs.php?error=blogcreated");
    exit();
}

function listEachBlog($conn,$id)
{
    $sql="SELECT * FROM Blog WHERE id=".$id.";";
    $result=$conn->query($sql);
    $blog=$result->fetch_all(MYSQLI_ASSOC);
    return $blog;
}

function updateblog($conn,$id,$title,$description,$user_id)
{
    $sql="UPDATE Blog SET title=?,description=?,user_id=? WHERE id=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../blogedit.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ssss",$title,$description,$user_id,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../blogs.php?error=blogupdated");
    exit();
}

function deleteBlog($conn, $id){
    $sql = "DELETE FROM Blog WHERE id=?";
    $sql2= "DELETE FROM Comment WHERE blog_id=?";

    $stmt2=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt2, "s", $id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function listComment($conn,$id)
{
    $sql="SELECT * FROM Comment WHERE blog_id=".$id.";";
    $result=$conn->query($sql);
    $blog=$result->fetch_all(MYSQLI_ASSOC);
    return $blog;
}

function createComment($conn,$comment_title,$blog_id,$user_id)
{
    $sql="INSERT INTO Comment (comment_title,blog_id,user_id) VALUES (?,?,?)";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../blogcreate.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss",$comment_title,$blog_id,$user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function deleteComment($conn,$id)
{
    $sql2= "DELETE FROM Comment WHERE id=?";

    $stmt2=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt2, "s", $id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
    return true;

}

function listEachComment($conn,$id)
{
    $sql="SELECT * FROM Comment WHERE id=".$id.";";
    $result=$conn->query($sql);
    $blog=$result->fetch_all(MYSQLI_ASSOC);
    return $blog;
}

function updateComment($conn,$id,$comment_title,$blog_id)
{
    $sql="UPDATE Comment SET comment_title=?,blog_id=? WHERE id=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../blogedit.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss",$comment_title,$blog_id,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../blogeach.php?id=".$blog_id);
    exit();
}


