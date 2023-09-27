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
    
}

?>
