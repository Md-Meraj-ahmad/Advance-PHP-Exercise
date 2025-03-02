<?php
// Start a session and store user data
session_start();
$_SESSION['username'] = 'john_doe';

// Retrieve session data on another page
echo "Welcome, " . $_SESSION['username'];

// Set and retrieve cookies
setcookie("user", "john_doe", time() + 3600, "/"); // Cookie expires in 1 hour
echo $_COOKIE['user'];

?>