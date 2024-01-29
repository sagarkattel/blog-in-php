
<!DOCTYPE html>
<html>


<body>

<h1>Blogs of  :</h1>
<ul>
    <?php
    include_once 'includes/dbh.php';
    include_once 'includes/functions.php';
    $ourblog=listEachBlog($conn,$_GET["id"]);
    foreach ($ourblog as $blog) {
//        echo "<li>" . $blog['title'] . "</li>";
        echo "<li>"."<h2>"."Title: ".$blog['title']."</a>"."<br>"."Description: ".$blog['description']."</h2>"."<br>"."Comments"."</li>";
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
