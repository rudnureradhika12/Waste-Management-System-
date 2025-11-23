<?php
// dashboard.php

session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: adlogin.php"); // Redirect to login if not logged in
    exit();
}

echo "<h1>Welcome to the Admin Dashboard</h1>";
echo "<p>You are logged in as " . $_SESSION['admin'] . "</p>";
echo "<a href='adlogout.php'>Logout</a>";
?>
