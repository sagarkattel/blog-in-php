<?php
include_once 'includes/dbh.php';
include_once 'includes/functions.php';

if(isset($_GET["commentid"])) {
    $comment = listEachComment($conn, $_GET["commentid"]);

    if($comment) {
        var_dump($comment);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Blog</title>
        </head>
        <body>
        <h2>Edit Blog</h2>
        <form action="includes/updatecommenthandler.php" method="post">
            <input type="hidden" name="id" value="<?php echo $comment[0]['id']; ?>">

            <label for="title">Title:</label>
            <input type="text" name="comment_title" value="<?php echo $comment[0]['comment_title']; ?>" required><br>

<!--            <input type="hidden" name="comment_email" value="--><?php //echo $comment[0]['comment_email']; ?><!--">-->

            <input type="hidden" name="blog_id" value="<?php echo $comment[0]['blog_id']; ?>">

            <input type="submit" value="Update Comment">
        </form>
        </body>
        </html>
        <?php
    } else {
        echo "Blog not found.";
    }
} else {
    echo "Invalid request. Please provide a blog ID.";
}
?>
