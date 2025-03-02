<?php
    trait Logger {
        public function log($message) {
            echo "Log: $message\n";
        }
    }
    
    class User {
        use Logger;
    }
    
    $user = new User();
    $user->log("User created");  // Output: Log: User created
    
?>