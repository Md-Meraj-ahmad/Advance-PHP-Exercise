<?php
    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo "Connected successfully";
    $conn->close();

    // And Another methods
    // $host = 'localhost';
    // $user = 'username';
    // $pass = 'password';
    // $db = 'database';
    // $conn = new mysqli($host, $user, $pass, $db);

    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    // else{
    //     echo "Connected successfully";
    // }

    // Exception Handling with Try-Catch for Database Connection and Queries
    // try {
    //     $conn = new mysqli($servername, $username, $password, $db);
        
    //     if ($conn->connect_error) {
    //         throw new Exception("Connection failed: " . $conn->connect_error);
    //     }
    
    //     // Example query execution
    //     $sql = "SELECT * FROM users";
    //     $result = $conn->query($sql);
        
    //     if (!$result) {
    //         throw new Exception("Query failed: " . $conn->error);
    //     }
    // } catch (Exception $e) {
    //     echo "Error: " . $e->getMessage();
    // } finally {
    //     $conn->close();
    // }    
    
?>