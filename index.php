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
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');


        $controller->addPost($_POST['title'], $_POST['content']);
    } elseif ($action == 'addComment' && isset($_POST['addComment'])) {
        
        $userID = $_SESSION['userID'];
        $controller->addComment($_POST['commentContent'], $_POST['postID'], $userID);
    } elseif ($action == 'deletePost' && isset($_GET['id'])) {
        $controller->deletePost($_GET['id']);
    } elseif ($action == 'updatePost' && isset($_POST['updatePost'])) {
        $postID = $_POST['postID'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $controller->updatePost($postID, $title, $content, $userID, $categoryID);
    } elseif ($action == 'editPost' && isset($_GET['postID'])) {
        $controller->editPost($_GET['postID']);
    } elseif ($action == 'editUser' && isset($_GET['userID'])) {
        $controllerUser->editUser($_GET['userID']);
    } elseif ($action == 'updateUser' && isset($_POST['updateUser'])) {
        $controllerUser->updateUser($_POST['userID'], $_POST['username'], $_POST['password'], $_POST['email']);
    } elseif ($action == 'deleteUser' && isset($_GET['userID'])) {
        $controllerUser->deleteUser($_GET['userID']);
    }
} else {
    $controller->index();
}
