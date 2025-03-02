<?php
    // 1.	Database Class:
    class Database {
        private $conn;
    
        public function __construct($servername, $username, $password, $dbname) {
            $this->conn = new mysqli($servername, $username, $password, $dbname);
    
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        }
    
        public function fetchUserData($userId) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
    
        public function close() {
            $this->conn->close();
        }
    }

    // 2. Fetching User Data (Example Usage):
    try {
        $db = new Database("localhost", "root", "", "test_db");
        $user = $db->fetchUserData(1);
        print_r($user);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    
?>