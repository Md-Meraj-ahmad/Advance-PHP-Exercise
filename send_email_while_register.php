<?php
    // Server-side Validation while Registration using Regular Expressions
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Username validation (letters and numbers only)
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            echo "Invalid username. Only letters and numbers are allowed.";
        }
        
        // Password validation (at least 8 characters, one uppercase, one number)
        if (!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            echo "Password must be at least 8 characters long, with at least one uppercase letter and one number.";
        }
    }
    
    // Send Email While Registration
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        // Registration logic here
        
        // Send confirmation email
        $to = $email;
        $subject = "Registration Confirmation";
        $message = "Thank you for registering!";
        $headers = "From: no-reply@example.com";
    
        if (mail($to, $subject, $message, $headers)) {
            echo "Confirmation email sent!";
        } else {
            echo "Failed to send confirmation email.";
        }
    }    
?>