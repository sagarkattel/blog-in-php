<?php
session_start();
if(!isset($_SESSION["useremail"])){
    header("Location: login.php?error=loginfirst");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
</head>

<body>
<h1>Create Blog</h1>
<form action="includes/bloghandler.php" method="post">
    Title:
    <input type="text" name="title" id="title">
    <br>
    <br>
    Description:
    <input type="text" name="description" id="description">
    <br>
    <br>
    <input type="submit" >
</form>
</body>

</html>

<?php
if(isset($_GET["error"])){
    if($_GET["error"]=="wronglogin"){
        echo "<p>Invalid Email or Password!</p>";
    }
    elseif ($_GET["error"]=="invalidemail"){
        echo "<p>Invalid Email</p>";
    }
    elseif ($_GET["error"]=="loginfirst"){
        echo "<p>Login First</p>";
    }
    elseif($_GET["error"]=="emptyinput"){
        echo "<p>Fill all the blanks</p>";
    }

    elseif($_GET["error"]=="stmtfailed"){
        echo "<p>Oops Something went wrong!</p>";
    }
    elseif($_GET["error"]=="usercreated"){
        echo "<p>User Created</p>";
    }

    elseif($_GET["error"]=="none"){
        echo "<p>You have Logged In</p>";
    }
}