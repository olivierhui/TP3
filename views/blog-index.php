<?php
include __DIR__ . '/../controllers/ControllerUser.php';
include __DIR__ . '/../database.php';

$isAdmin = false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    
    $controllerUser = new ControllerUser($pdo);
    $isAdmin = $controllerUser->checkUserRole('Admin');
}
?>


<?php if ($isAdmin) : ?>
    <a href="admin-dashboard.php">Go to Admin Dashboard</a>
<?php endif; ?>



<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog system</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <a href="Class/register.php">register</a>
    <a href="Class/login.php">Log in</a>

    <div class="container">
        <h2>add new blog post</h2>
        <form method="post" action="index.php?action=addPost">
            <label for="title">title:</label>
            <input type="text" name="title" required>

            <label for="content">content:</label>
            <textarea name="content" required></textarea>

            <input type="submit" name="addPost" value="submit">
        </form>

        <h2>blog post list</h2>
        <ul>
            <?php
            


            foreach ($posts as $p) {
                echo '<li>';
                echo '<h3>' . $p['title'] . '</h3>';
                echo '<p>' . $p['content'] . '</p>';

                echo '<h4>Comment:</h4>';
                $comments = $allComments[$p['postID']];
                foreach ($comments as $c) {
                    echo '<p>' . $c['commentContent'] . '</p>';


                    if (
                        isset($_SESSION['roleID']) && isset($_SESSION['userID']) &&
                        ($_SESSION['roleID'] == 1 || $_SESSION['userID'] == $p['userID'])
                    ) {
                        echo '<a href="index.php?action=deleteComment&commentID=' . $c['commentID'] . '">Delete Comment</a>';
                    }
                }


                echo '<h4>add comment:</h4>';
                echo '<form method="post" action="index.php?action=addComment">
        <textarea name="commentContent"></textarea>
        <input type="hidden" name="postID" value="' . $p['postID'] . '">
        <input type="submit" name="addComment" value="submit">
      </form>';


                echo '<a href="./Class/deletePost.php?id=' . $p['postID'] . '">delete this blog post</a>';
            }


            ?>
        </ul>
    </div>
</body>

</html>