<?php

class ControllerComment {
    private $comment;

    public function __construct($pdo) {
        $this->comment = new Comment($pdo);
    }

    public function addComment() {
        if (isset($_POST['addComment'])) {
            $commentContent = $_POST['commentContent'];
            $postID = $_POST['postID'];
            $userID = $_SESSION['userID'];  
            $this->comment->addComment($commentContent, $postID, $userID);
              
            
            header('Location: index.php');
        }
    }
    public function deleteComment($commentID) {
        $this->comment->deleteComment($commentID);
        header('Location: index.php');  
    }
    

   

    
}

?>

