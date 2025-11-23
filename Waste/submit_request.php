<?php
session_start();
$user_id = $_SESSION['user_id'];

$conn = new mysqli("localhost", "root", "", "wms");

if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "INSERT INTO waste_requests (user_id) VALUES ('$user_id')";
if ($conn->query($sql)) {
    echo "Request submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
