<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['roleID'] != 1) {
    header('Location: index.php');
    exit;
}



include 'database.php';
include 'Class/Category.php';

$category = new Category($pdo);

if(isset($_GET['categoryID'])) {
    $category->deleteCategory($_GET['categoryID']);
    header('Location: admin-dashboard.php');
}
?>
