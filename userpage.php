<?php
session_start();
if(!isset($_SESSION["useremail"])){
    header("Location: login.php?error=loginfirst");
}
?>
<!DOCTYPE html>
<html>


<body>
<h1>The List of Users are:</h1>
<ul>
    <?php
    include_once 'includes/dbh.php';
    include_once 'includes/functions.php';
    $ouruser=listUser($conn);
    foreach ($ouruser as $user) {
        echo "<li>" . $user['email'] . "</li>";
    }
    ?>
</ul>
</body>

</html>