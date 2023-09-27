<?php


session_start();

include 'database.php';
include 'Class/User.php';
include 'Class/Post.php';
include 'Class/Comment.php';
include 'Class/Category.php';
include 'controllers/ControllerBlog.php';
include 'controllers/ControllerComment.php';

$controller = new ControllerBlog($pdo);
$commentController = new ControllerComment($pdo);

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'addPost' && isset($_POST['addPost'])) {
        $controller->addPost($_POST['title'], $_POST['content']);

    } elseif ($action == 'addComment' && isset($_POST['addComment'])) {
        $userID = $_SESSION['userID'];
        $controller->addComment($_POST['commentContent'], $_POST['postID'], $userID);
    } 
    
    elseif ($action == 'deletePost' && isset($_GET['id'])) {
        $controller->deletePost($_GET['id']);
    }

    elseif ($action == 'updatePost' && isset($_POST['updatePost'])) {
        $postID = $_POST['postID'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $controller->updatePost($postID, $title, $content, $userID, $categoryID);
    }
    
} else {
    $controller->index();
}






?>
