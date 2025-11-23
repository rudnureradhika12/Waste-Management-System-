<?php
// Database configuration
$host = 'localhost';  // Database host (usually localhost)
$username = 'root';   // Your MySQL username
$password = '';       // Your MySQL password (usually empty for local development)
$database = 'garbage';  // Database name 

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8 for better compatibility with special characters
$conn->set_charset('utf8');
?>
