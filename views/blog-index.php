<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


?>
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
        
        <input type="submit" name="addPost" value="发布">
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
