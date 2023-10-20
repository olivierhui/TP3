<?php

session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();     
    session_destroy();   
}

$_SESSION['last_activity'] = time();

include __DIR__ . '/../database.php';
include 'User.php';
include __DIR__ . '/../controllers/ControllerUser.php';

$controller = new ControllerUser($pdo);

if (isset($_POST['login'])) {
    $loginSuccess = $controller->login($_POST['username'], $_POST['password']);
    
    if ($loginSuccess) {
        
        $userID = $_SESSION['userID'];
        $ip = $_SERVER['REMOTE_ADDR']; 
        $visitedPage = 'User Login';
        $user = new User($pdo);
        $user->logUserActivity($userID, $_SERVER['REMOTE_ADDR'], $visitedPage);
        
    } else {
        $loginFailed = true;
    }
}



include __DIR__ . '/../views/user-login.php';
?>
