
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


    $users1=listEachUser($conn,$_SESSION['id']);

    if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "DEBUG: id value - " . $_SESSION['blog_id'];
        deleteComment($conn, $_POST['id']);
        header('Location: /blogeach.php?id='.$_POST['blog_id']);
        exit();
    }

    $ourblog = listEachBlog($conn, $_GET["id"]);
    $blog_id = $_GET['id'];

    foreach ($ourblog as $blog) {
        $users=listEachUser($conn,$blog["user_id"]);
        echo "<li>" . "<h2>" . "Title: " . $blog['title'] . "</a>" . "<br>" .
            "Description: " . $blog['description'] . "</h2>" . "<br>" .
            "Created By: " . $users[0]['name'] . "</h2>" . "<br>" .
            "Comments" . "</li><br>";

        if (isset($_SESSION["id"])) {
            echo "<form action='includes/commenthandler.php' method='post'>
              <input type='hidden' name='blog_id' value='" .$blog_id ."'>
              <input type='text' name='comment_title' id='comment_title' placeholder='Comment'>
              <input type='submit'>
          </form><br><br>";

            if (isset($_GET["error"])) {
                if ($_GET["error"] == "fillallblanks") {
                    echo "<p class='p-7 text-color-red'>Fill all the blanks!</p>";
                }
            }

        } else {
            echo "<a href='login.php'>Login</a>" . " First to Comment" . "<br>";
        }

        $ourcomment = listComment($conn, $_GET["id"]);
        foreach ($ourcomment as $comment) {
            $users=listEachUser($conn,$comment["user_id"]);
            echo "<br><li>" . "Comment Title:" . $comment['comment_title'] . "<br>" .
                "Commented By: " . $users[0]["name"] . "</li>";
            echo ($users[0]['id'] == $_SESSION["id"]||$users1[0]["role"]=="admin") ?
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


