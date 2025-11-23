<?php
session_start(); // 🔁 Add this line at the top to use $_SESSION

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garbage";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id exists in session
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Step 1: Check if new passwords match
if ($new_password !== $confirm_password) {
    die("New password and confirm password do not match.");
}

// Step 2: Fetch the current hashed password from DB
$query = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Step 3: Verify current password
    if (!password_verify($current_password, $hashed_password)) {
        die("Incorrect current password.");
    }

    // Step 4: Hash new password and update
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update_query = "UPDATE users SET password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $new_hashed_password, $user_id);

    if ($update_stmt->execute()) {
        echo "Password changed successfully.";
    } else {
        echo "Failed to update password.";
    }

    $update_stmt->close();
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
