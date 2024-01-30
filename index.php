<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Authentication System</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
<div class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 mt-8  lg:text-3xl">
<a href='blogs.php' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Blogs</a>
<?php
if(isset($_SESSION["useremail"])){
    echo "<h3>Welcome, {$_SESSION["useremail"]}</h3>";
    echo "<a href='includes/logouthandler.php'>Log out</a><br><br>";
    echo "<a href='userpage.php'>View Users</a>";
//    echo "<br><br><a href='blogs.php'>Blogs</a>";
}
else{
    echo "<br><br><input type='button' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' value='Login' id='btnLogin' onclick='redirectlogin()' />";
    echo "<br><br><input type='button' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' value='Sign Up' id='btnLogin' onclick='redirectsignup()' />";
}
?>


</div>
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
