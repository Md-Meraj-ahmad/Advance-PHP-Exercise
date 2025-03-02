<?php
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }
    
    $email = "test@example.com";
    if (validateEmail($email)) {
        echo "Valid email address!";
    } else {
        echo "Invalid email address.";
    }
    

    // Server-Side Validation using Regular Expressions
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    
    //     // Email validation
    //     if (!preg_match("/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
    //         echo "Invalid email format";
    //     }
    
    //     // Password validation (minimum 8 characters, at least one number, one uppercase, and one lowercase)
    //     if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
    //         echo "Password must be at least 8 characters long and contain at least one number.";
    //     }
    // }
    
?>