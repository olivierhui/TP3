<?php
include __DIR__ . '/../database.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addUser($username, $password, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO Users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);
    }

    public function getUser($userID) {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE userID = ?");
        $stmt->execute([$userID]);
        return $stmt->fetch();
    }

    public function updateUser($userID, $username, $password, $email) {
        $stmt = $this->pdo->prepare("UPDATE Users SET username = ?, password = ?, email = ? WHERE userID = ?");
        $stmt->execute([$username, $password, $email, $userID]);
    }

    public function deleteUser($userID) {
        $stmt = $this->pdo->prepare("DELETE FROM Users WHERE userID = ?");
        $stmt->execute([$userID]);
    }

    public function register($username, $password, $email) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);  
    
        $sql = "INSERT INTO Users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
    
        try {
            $stmt->execute([$username, $hashed_password, $email]);
            return true;
        } catch (PDOException $e) {
            echo "Registration error: " . $e->getMessage();
            return false;
        }
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM Users WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
    
        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $user['password'])) {  
                $_SESSION['loggedin'] = true;     
                $_SESSION['username'] = $username;
                return true;
            }
        }
        return false;
    }
    
    
}
?>
