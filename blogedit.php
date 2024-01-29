<?php
include_once 'includes/dbh.php';
include_once 'includes/functions.php';

if(isset($_GET["id"])) {
    $blogId = $_GET["id"];
    $blog = listEachBlog($conn, $blogId);

    if($blog) {
        var_dump($blog);
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
        <form action="includes/updatebloghandler.php" method="post">
            <input type="hidden" name="id" value="<?php echo $blog[0]['id']; ?>">

            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo $blog[0]['title']; ?>" required><br>

            <label for="content">Content:</label>
            <textarea name="description" rows="4" required><?php echo $blog[0]['description']; ?></textarea><br>

            <input type="submit" value="Update Blog">
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
