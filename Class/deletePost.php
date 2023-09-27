<?php
include __DIR__ . '/../database.php';
include 'Post.php';

$post = new Post($pdo);

if (isset($_GET['id'])) {
    $postID = $_GET['id'];
    $post->deletePost($postID);

    header('Location: ../index.php'); 
}
?>
