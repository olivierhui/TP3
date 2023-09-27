<?php

include __DIR__ . '/../database.php';
include 'User.php';
include __DIR__ . '/../controllers/ControllerUser.php';

$controller = new ControllerUser($pdo);

if (isset($_POST['register'])) {
    $controller->register($_POST['username'], $_POST['password'], $_POST['email']);
}


include __DIR__ . '/../views/user-register.php';
?>
