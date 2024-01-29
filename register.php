<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<body>
<h1>Register</h1>
<form action="includes/signuphandler.php" method="post">
    Email:
    <input type="text" name="email" id="email">
    <br>
    <br>
    Password:
    <input type="password" name="password" id="password">
    <br>
    <br>
    Confirm Password:
    <input type="password" name="confirm_password" id="confirm_password">
    <br>
    <br>
    <input type="submit" name="submit">
</form>
</body>

</html>

<?php
if(isset($_GET["error"])){
    if($_GET["error"]=="emptyinput"){
        echo "<p>Fill in all fields!</p>";
    }
    elseif ($_GET["error"]=="invalidemail"){
        echo "<p>Invalid Email</p>";
    }
    elseif($_GET["error"]=="passwordsdonotmatch"){
        echo "<p>Password Donot Match</p>";
    }
    elseif($_GET["error"]=="Emailalreadyexists"){
        echo "<p>Email Already Exist</p>";
    }
    elseif($_GET["error"]=="stmtfailed"){
        echo "<p>Oops Something went wrong!</p>";
    }
    elseif($_GET["error"]=="none"){
        echo "<p>You have signed in</p>";
    }
}