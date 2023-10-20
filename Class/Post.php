<?php
include __DIR__ . '/../database.php';

class Post {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addPost($title, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO Posts (title, content, postDate) VALUES (?, ?, NOW())");
        $stmt->execute([$title, $content]);
    }

    public function getAllPosts() {
        $stmt = $this->pdo->query("SELECT * FROM Posts ORDER BY postDate DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function updatePost($postID, $title, $content, $userID, $categoryID) {
        $stmt = $this->pdo->prepare("UPDATE Posts SET title = ?, content = ?, userID = ?, categoryID = ? WHERE postID = ?");
        $stmt->execute([$title, $content, $userID, $categoryID, $postID]);
    }

    public function deletePost($postID) {
        $stmt = $this->pdo->prepare("DELETE FROM Posts WHERE postID = ?");
        $stmt->execute([$postID]);
    }
    public function getPost($postID) {
        $stmt = $this->pdo->prepare("SELECT * FROM Posts WHERE postID = ?");
        $stmt->execute([$postID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    
}


?>
