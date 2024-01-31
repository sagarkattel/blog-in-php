<?php
session_start();
include_once 'includes/dbh.php';
include_once 'includes/functions.php';

if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    deleteBlog($conn, $_POST['id']);

    header("Location: $_SERVER[PHP_SELF]");
    exit();
}
$ourblog = listBlog($conn);
?>

<!DOCTYPE html>
<html>
<body>

<h1>Blogs are:</h1>
<ul>
    <?php
    $users1=listEachUser($conn,$_SESSION['id']);
    echo "<input type='button' value='Create Blog' id='btnLogin' onclick='handleCreateBlog()' /><br><br>";

    foreach ($ourblog as $blog) {
        $users=listEachUser($conn,$blog["user_id"]);
        echo "<li>" .
             "Title: " . $blog['title'] . "<br>" .
            "Description: " . $blog['description'] .
            "<br>" .
            "Created By: " . $users[0]["name"] . "</h2>" .
            "<br>" .
            "<a href='blogeach.php?id=" . $blog['id'] . "'>" . "Readmore" . "</a>";
        echo ($blog['user_id'] == $_SESSION["id"]||$users1[0]["role"]=="admin") ?
            ("<br><a href='blogedit.php?id=" . $blog['id'] . "'>" . "Edit" . "</a>" .
                "<form method='post' action='$_SERVER[PHP_SELF]' onsubmit='return confirm(\"Are you sure?\");'>
            <input type='hidden' name='id' value='" . $blog['id'] . "'>
            <button type='submit'>Delete</button>
            </form>") :
            "";
        echo "</li><br><br>";
    }
    ?>
</ul>

</body>
<script>
    function handleCreateBlog(){
        window.location.href='blogcreate.php';
    }
</script>
</html>


