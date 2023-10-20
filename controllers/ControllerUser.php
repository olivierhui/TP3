<?php

class ControllerUser {

    private $user;

    public function __construct($pdo) {
        $this->user = new User($pdo);
    }

    public function login($username, $password) {
        if ($this->user->login($username, $password)) {  
            header('Location: /');
            exit();
        } else {
            return false;
        }
    }

    public function register($username, $password, $email) {
        return $this->user->register($username, $password, $email);
    }
    public function checkUserRole($roleName) {
        $userID = $_SESSION['userID'] ?? null;
        if ($userID) {
            $userRole = $this->user->getRole($userID);
            return strtolower($userRole) == strtolower($roleName);
        }
        return false;
    }
    public function editUser($userID) {
        $user = $this->user->getUser($userID);
        include 'views/edit-user.php';
    }
    
    public function updateUser($userID, $username, $password, $email) {
        $this->user->updateUser($userID, $username, $password, $email);
        header('Location: admin-dashboard.php');
    }
    
    public function deleteUser($userID) {
        $this->user->deleteUser($userID);
        header('Location: admin-dashboard.php');
    }
    
    
}


?>
