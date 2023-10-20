<?php 



class ControllerBlog {

    private $post;
    private $comment;

    public function __construct($pdo) {
        $this->post = new Post($pdo);
        $this->comment = new Comment($pdo);
    }

    public function index() {
        $posts = $this->post->getAllPosts();
    
        
        $allComments = [];
    
        foreach ($posts as $p) {
            $allComments[$p['postID']] = $this->comment->getAllCommentsForPost($p['postID']);
        }
    
        include 'views/blog-index.php';
    }
    

    public function addPost($title, $content) {
        $this->post->addPost($title, $content);
        header('Location: index.php');  
    }

    public function addComment($commentContent, $postID, $userID) {
        $this->comment->addComment($commentContent, $postID, $userID);
        header('Location: index.php');  
    }

    public function deletePost($postID) {
        $this->post->deletePost($postID);
        header('Location: index.php');  
    }
    public function editPost($postID) {
        $post = $this->post->getPost($postID);
        include 'views/edit-post.php';
    }    
    public function updatePost($postID, $title, $content, $userID, $categoryID) {
        $this->post->updatePost($postID, $title, $content, $userID, $categoryID);
        header('Location: index.php');
    }
    
    
    
    
    

}

?>
