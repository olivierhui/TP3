<?php
include __DIR__ . '/../database.php';


class Category {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addCategory($categoryName) {
        $stmt = $this->pdo->prepare("INSERT INTO Categories (categoryName) VALUES (?)");
        $stmt->execute([$categoryName]);
    }

    public function getCategory($categoryID) {
        $stmt = $this->pdo->prepare("SELECT * FROM Categories WHERE categoryID = ?");
        $stmt->execute([$categoryID]);
        return $stmt->fetch();
    }

    public function updateCategory($categoryID, $categoryName) {
        $stmt = $this->pdo->prepare("UPDATE Categories SET categoryName = ? WHERE categoryID = ?");
        $stmt->execute([$categoryName, $categoryID]);
    }

    public function deleteCategory($categoryID) {
        $stmt = $this->pdo->prepare("DELETE FROM Categories WHERE categoryID = ?");
        $stmt->execute([$categoryID]);
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
