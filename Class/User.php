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
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE Users SET username = ?, password = ?, email = ? WHERE userID = ?");
        $stmt->execute([$username, $hashedPassword, $email, $userID]);
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
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['roleID'] = $user['roleID']; 
                return true;
            }
        }
        return false;
    }
    
    public function getRole($userID) {
        $sql = "SELECT roleName FROM roles WHERE roleID = (SELECT roleID FROM users WHERE userID = ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchColumn(); 
    }
    
    public function logUserActivity($userID, $ip, $visitedPage) {
        $sql = "INSERT INTO logs (userID, ip, visitedPage) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userID, $ip, $visitedPage]);
    }
    public function getAllLogs() {
        $stmt = $this->pdo->query("SELECT * FROM logs ORDER BY date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function changeUserRole($userID, $roleID) {
        $stmt = $this->pdo->prepare("UPDATE users SET roleID = ? WHERE userID = ?");
        $stmt->execute([$roleID, $userID]);
    }
    
    
    
    
}
?>
