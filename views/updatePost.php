<?php
session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();     
    session_destroy();   
}

$_SESSION['last_activity'] = time();
?>

<form method="post" action="index.php?action=updatePost">
    <input type="hidden" name="postID" value="<?php echo $postID; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $title; ?>" required>
    <label for="content">Content:</label>
    <textarea name="content" required><?php echo $content; ?></textarea>
    <input type="submit" name="updatePost" value="Update Post">
</form>
