<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<body>
<h1>Login</h1>
<form action="includes/loginhandler.php" method="post">
    Email:
    <input type="text" name="email" id="email">
    <br>
    <br>
    Password:
    <input type="password" name="password" id="password">
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