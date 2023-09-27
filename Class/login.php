<?php

include __DIR__ . '/../database.php';
include 'User.php';
include __DIR__ . '/../controllers/ControllerUser.php';

$controller = new ControllerUser($pdo);

if (isset($_POST['login'])) {
    $loginSuccess = $controller->login($_POST['username'], $_POST['password']);
    
    if (!$loginSuccess) {
        $loginFailed = true;
    }
}


include __DIR__ . '/../views/user-login.php';
?>
