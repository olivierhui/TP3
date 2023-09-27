<?php
include __DIR__ . '/../database.php';
class Comment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addComment($content, $postID, $userID) {
        $stmt = $this->pdo->prepare("INSERT INTO Comments (commentContent, commentDate, postID, userID) VALUES (?, NOW(), ?, ?)");
        $stmt->execute([$content, $postID, $userID]);
    }

    public function getComment($commentID) {
        $stmt = $this->pdo->prepare("SELECT * FROM Comments WHERE commentID = ?");
        $stmt->execute([$commentID]);
        return $stmt->fetch();
    }

    public function updateComment($commentID, $content) {
        $stmt = $this->pdo->prepare("UPDATE Comments SET commentContent = ? WHERE commentID = ?");
        $stmt->execute([$content, $commentID]);
    }

    public function deleteComment($commentID) {
        $stmt = $this->pdo->prepare("DELETE FROM Comments WHERE commentID = ?");
        $stmt->execute([$commentID]);
    }
    public function getAllCommentsForPost($postID) {
        $stmt = $this->pdo->prepare("SELECT * FROM Comments WHERE postID = ? ORDER BY commentDate DESC");
        $stmt->execute([$postID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


?>
