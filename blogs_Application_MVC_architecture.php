<?php
/*
Build a Small Blog Application Using the MVC Architecture, Where Users Can Create, Read, Update, and Delete Posts

Practical Exercise:

In this example, we’ll build a small blog application with the following basic operations using MVC architecture:
    •	Model: Handles the database interaction.
    •	View: Displays the data to the user.
    •	Controller: Manages the interaction between the model and the view.

*/

/*
1. Database Structure:
Let's assume we have a database called blog_db and a table called posts:
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
*/

// 2. Model (PostModel.php):
// The model interacts with the database to fetch and manipulate post data.
class PostModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $query = "SELECT * FROM posts";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($id) {
        $query = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createPost($title, $content) {
        $query = "INSERT INTO posts (title, content) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $title, $content);
        return $stmt->execute();
    }

    public function updatePost($id, $title, $content) {
        $query = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $title, $content, $id);
        return $stmt->execute();
    }

    public function deletePost($id) {
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

// 3. Controller (PostController.php):
// The controller handles user requests and interacts with the model to manipulate data.
class PostController {
    private $postModel;

    public function __construct($model) {
        $this->postModel = $model;
    }

    // Display all posts
    public function index() {
        $posts = $this->postModel->getAllPosts();
        include 'views/posts/index.php';
    }

    // Display single post
    public function view($id) {
        $post = $this->postModel->getPostById($id);
        include 'views/posts/view.php';
    }

    // Show the form for creating a new post
    public function create() {
        include 'views/posts/create.php';
    }

    // Store new post data
    public function store() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        if ($this->postModel->createPost($title, $content)) {
            header("Location: index.php");
        }
    }

    // Show the form for editing a post
    public function edit($id) {
        $post = $this->postModel->getPostById($id);
        include 'views/posts/edit.php';
    }

    // Update post data
    public function update($id) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        if ($this->postModel->updatePost($id, $title, $content)) {
            header("Location: index.php");
        }
    }

    // Delete a post
    public function delete($id) {
        if ($this->postModel->deletePost($id)) {
            header("Location: index.php");
        }
    }
}
// 5. Main Execution (index.php):
require_once 'PostModel.php';
require_once 'PostController.php';

// Database connection
$db = new mysqli('localhost', 'root', '', 'blog_db');
$postModel = new PostModel($db);
$postController = new PostController($postModel);

// Display posts
$postController->index();

?>
________________________________________
<!-- 4. Views: -->
<!-- •	views/posts/index.php: Displays all posts. -->
<h1>All Posts</h1>
<a href="create.php">Create New Post</a>
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href="view.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
            <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $post['id']; ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>
<!-- •	views/posts/create.php: Form to create a new post. -->
<h1>Create New Post</h1>
<form action="store.php" method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <button type="submit">Submit</button>
</form>
<!-- •	views/posts/view.php: Displays a single post. -->
<h1><?php echo $post['title']; ?></h1>
<p><?php echo $post['content']; ?></p>
<a href="index.php">Back to all posts</a>
________________________________________