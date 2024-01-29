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
    echo "<input type='button' value='Create Blog' id='btnLogin' onclick='handleCreateBlog()' />";
    foreach ($ourblog as $blog) {
        echo "<li>" .
            "<h2>" . "Title: " . "<a href='blogeach.php?id=" . $blog['id'] . "'>" . $blog['title'] . "</a>" . "<br>" .
            "Description: " . $blog['description'] . "</h2>" .
            "<br>" .
            "Created By: " . $blog['created_by'] . "</h2>" .
            "<br>";
        echo ($blog['created_by'] == $_SESSION["useremail"]) ?
            ("<a href='blogedit.php?id=" . $blog['id'] . "'>" . "Edit" . "</a>" .
                "<form method='post' action='$_SERVER[PHP_SELF]' onsubmit='return confirm(\"Are you sure?\");'>
            <input type='hidden' name='id' value='" . $blog['id'] . "'>
            <button type='submit'>Delete</button>
            </form>") :
            "";
        echo "</li>";
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


