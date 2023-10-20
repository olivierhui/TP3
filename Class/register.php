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

if (isset($_POST['register'])) {
    if ($controller->register($_POST['username'], $_POST['password'], $_POST['email'])) {
      
        $visitedPage = 'User Registration';
        
       
        $user = new User($pdo);
        
        $userID = $pdo->lastInsertId();  
        $user->logUserActivity($userID, $_SERVER['REMOTE_ADDR'], $visitedPage);
    }
}




include __DIR__ . '/../views/user-register.php';
?>
