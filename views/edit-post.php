<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Post</h2>
        <form method="post" action="index.php?action=updatePost">
            <input type="hidden" name="postID" value="<?= $post['postID']; ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" value="<?= $post['title']; ?>" required>
            <label for="content">Content:</label>
            <textarea name="content" required><?= $post['content']; ?></textarea>
           
            <input type="submit" name="updatePost" value="Update Post">
        </form>
    </div>
</body>
</html>
