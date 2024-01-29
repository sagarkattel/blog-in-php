<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Authentication System</title>
</head>

<body>
<a href='blogs.php'>Blogs</a>
<?php
if(isset($_SESSION["useremail"])){
    echo "<h3>Welcome, {$_SESSION["useremail"]}</h3>";
    echo "<a href='includes/logouthandler.php'>Log out</a><br><br>";
    echo "<a href='userpage.php'>View Users</a>";
//    echo "<br><br><a href='blogs.php'>Blogs</a>";
}
else{
    echo "<input type='button' value='Login' id='btnLogin' onclick='redirectlogin()' />";
    echo "<input type='button' value='Sign Up' id='btnLogin' onclick='redirectsignup()' />";
}
?>



</body>

<script>
    function redirectlogin() {
        window.location.href = "login.php";
    }

    function redirectsignup(){
        window.location.href="register.php";
    }
</script>
</html>
