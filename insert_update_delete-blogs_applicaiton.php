<?php
/*
Expand the Blog Application to Include a Feature for User Comments, Allowing Users to Insert, Update, and Delete Their Comments

1. Database Structure for Comments:
Add a comments table to the database:
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id)
);

*/

// 2. Model (CommentModel.php):
// This model will handle the comment-related operations.
class CommentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getCommentsByPostId($postId) {
        $query = "SELECT * FROM comments WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addComment($postId, $content) {
        $query = "INSERT INTO comments (post_id, content) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $postId, $content);
        return $stmt->execute();
    }

    public function updateComment($id, $content) {
        $query = "UPDATE comments SET content = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $content, $id);
        return $stmt->execute();
    }

    public function deleteComment($id) {
        $query = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

// 3. Controller (CommentController.php):
// The comment controller will manage the comment functionality.
class CommentController {
    private $commentModel;

    public function __construct($model) {
        $this->commentModel = $model;
    }

    public function store($postId) {
        $content = $_POST['content'];
        if ($this->commentModel->addComment($postId, $content)) {
            header("Location: view.php?id=$postId");
        }
    }

    public function update($id) {
        $content = $_POST['content'];
        if ($this->commentModel->updateComment($id, $content)) {
            header("Location: view.php?id=$id");
        }
    }

    public function delete($id) {
        if ($this->commentModel->deleteComment($id)) {
            header("Location: index.php");
        }
    }
}

// 4. Views:
// •	views/comments/create.php: Form to add a comment to a post.
<form action="addComment.php" method="POST">
    <textarea name="content" placeholder="Add your comment" required></textarea>
    <button type="submit">Submit</button>
</form>
•	views/comments/show.php: Display comments on a post.
<h2>Comments</h2>
<ul>
    <?php foreach ($comments as $comment): ?>
        <li>
            <p><?php echo $comment['content']; ?></p>
            <a href="editComment.php?id=<?php echo $comment['id']; ?>">Edit</a>
            <a href="deleteComment.php?id=<?php echo $comment['id']; ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>

5. Main Execution (view.php):
// Display post with comments
$post = $postModel->getPostById($postId);
$comments = $commentModel->getCommentsByPostId($postId);

include 'views/posts/view.php';
include 'views/comments/show.php';

?>