<?php
    // Model (UserProfileModel.php):
    class UserProfileModel {
        private $db;
    
        public function __construct($db) {
            $this->db = $db;
        }
    
        public function getUserById($userId) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
    
        public function updateUser($userId, $name, $email) {
            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $email, $userId);
            return $stmt->execute();
        }
    }
    // View (userProfileView.php):
    echo "<h2>User Profile</h2>";
    echo "<p>Name: " . $user['name'] . "</p>";
    echo "<p>Email: " . $user['email'] . "</p>";
    echo "<a href='editProfile.php?id=" . $user['id'] . "'>Edit Profile</a>";
    
    // Controller (UserProfileController.php):
    class UserProfileController {
        private $model;
    
        public function __construct($model) {
            $this->model = $model;
        }
    
        public function viewProfile($userId) {
            $user = $this->model->getUserById($userId);
            include 'views/userProfileView.php';
        }
    
        public function updateProfile($userId, $name, $email) {
            if ($this->model->updateUser($userId, $name, $email)) {
                header("Location: profile.php?id=$userId");
            } else {
                echo "Error updating profile.";
            }
        }
    }
    
    // Main Execution:
    $controller = new UserProfileController(new UserProfileModel($db));
    $controller->viewProfile($userId);
    
?>