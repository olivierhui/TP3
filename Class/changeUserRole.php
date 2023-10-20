<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['roleID'] != 1) {
    header('Location: index.php');
    exit;
}




include __DIR__ . '/../database.php';
include __DIR__ . '/../Class/User.php';

$user = new User($pdo);

if(isset($_POST['roleID']) && isset($_POST['userID'])) {
    $user->changeUserRole($_POST['userID'], $_POST['roleID']);
    header('Location: admin-dashboard.php');
}
?>
