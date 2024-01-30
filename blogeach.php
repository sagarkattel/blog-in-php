
<!DOCTYPE html>
<html>


<body>

<h1>Blogs of  :</h1>
<ul>
    <?php
    session_start();
    include_once 'includes/dbh.php';
    include_once 'includes/functions.php';


    $_SESSION['blog_id'] = isset($_GET['id']) ? $_GET['id'] : null;


    if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "DEBUG: id value - " . $_SESSION['blog_id'];
        deleteComment($conn, $_POST['id']);
        header('Location: /blogeach.php?id='.$_POST['blog_id']);
        exit();
    }

    $ourblog = listEachBlog($conn, $_GET["id"]);
    $blog_id = $_GET['id'];

    foreach ($ourblog as $blog) {
        echo "<li>" . "<h2>" . "Title: " . $blog['title'] . "</a>" . "<br>" .
            "Description: " . $blog['description'] . "</h2>" . "<br>" .
            "Comments" . "</li><br>";

        if (isset($_SESSION["useremail"])) {
            echo "<form action='includes/commenthandler.php' method='post'>
              <input type='hidden' name='blog_id' value='" .$blog_id ."'>
              <input type='text' name='comment_title' id='comment_title' placeholder='Comment'>
              <input type='submit'>
          </form><br><br>";
        } else {
            echo "<a href='login.php'>Login</a>" . " First to Comment" . "<br>";
        }

        $ourcomment = listComment($conn, $_GET["id"]);
        foreach ($ourcomment as $comment) {
            echo "<br><li>" . "Comment Title:" . $comment['comment_title'] . "<br>" .
                "Commented By: " . $comment['comment_email'] . "</li>";
            echo ($comment['comment_email'] == $_SESSION["useremail"]) ?
                ("<a href='commentedit.php?commentid=" . $comment['id'] . "'>" . "Edit" . "</a>" .
                    "<form method='post' action='$_SERVER[PHP_SELF]' onsubmit='return confirm(\"Are you sure?\");'>
            <input type='hidden' name='id' value='" . $comment['id'] . "'>
            <input type='hidden' name='blog_id' value='" . $comment['blog_id'] . "'>
            <button type='submit'>Delete</button>
            </form>") :
                "";
            echo "</li><br><br>";
        }
    }
    ?>

</ul>
</body>

<script>
    function redirectback() {
        window.location.href = "blogs.php";
    }


</script>

</html>
