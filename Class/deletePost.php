<?php


session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();     
    session_destroy();   
}

$_SESSION['last_activity'] = time();


include __DIR__ . '/../database.php';
include 'Post.php';


$post = new Post($pdo);

if (isset($_GET['id'])) {
    $postID = $_GET['id'];
    $post->deletePost($postID);

    header('Location: ../index.php'); 
}
?>
