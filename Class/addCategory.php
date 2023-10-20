<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['roleID'] != 1) {
    header('Location: index.php');
    exit;
}



include 'database.php';
include 'Class/Category.php';

$category = new Category($pdo);

if(isset($_POST['addCategory'])) {
    $category->addCategory($_POST['categoryName']);
    header('Location: admin-dashboard.php');
}
?>
