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

function createUser($conn,$email,$password){
    $sql="INSERT INTO User(email,password) VALUES(?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }
    $hashedPwd=password_hash($password,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ss",$email,$hashedPwd);
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
        header("Location: ../index.php");
        exit();
    }
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

function createBlog($conn,$title,$description)
{
    $sql="INSERT INTO Blog(title,description) VALUES(?,?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../blogcreate.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$title,$description);
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

function updateblog($conn,$id,$title,$description)
{
    $sql="UPDATE Blog SET title=?,description=? WHERE id=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../blogedit.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss",$title,$description,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../blogs.php?error=blogupdated");
    exit();
}

function deleteBlog($conn, $id){
    $sql = "DELETE FROM Blog WHERE id=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}




