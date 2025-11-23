<?php
// Include database connection
include('congig.php');

// Start session to get the logged-in user's ID
session_start();

// Check if the user is logged in and fetch the user_id from session
if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming 'user_id' is stored in session after login

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $address = $_POST['address'];
    $zone = $_POST['zone'];
    $waste_type = $_POST['waste_type'];
    $collection_date = $_POST['collection_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $payment_mode = $_POST['payment_mode'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = '';  // If no image is uploaded, set the image path as empty
    }

    // SQL query to insert data into waste_collection table
    $sql = "INSERT INTO waste_collection (user_id, address, zone, waste_type, collection_date, amount, description, payment_mode, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters (note: 'issdsssss' for 9 variables)
        $stmt->bind_param('issdsssss', $user_id, $address, $zone, $waste_type, $collection_date, $amount, $description, $payment_mode, $image);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>

<!-- HTML Form -->
<form method="POST" enctype="multipart/form-data">
    <label for="address">Address:</label><br>
    <input type="text" name="address" id="address" required><br><br>

    <label for="zone">Zone:</label><br>
    <input type="text" name="zone" id="zone" required><br><br>

    <label for="waste_type">Waste Type:</label><br>
    <input type="text" name="waste_type" id="waste_type" required><br><br>

    <label for="collection_date">Collection Date:</label><br>
    <input type="date" name="collection_date" id="collection_date" required><br><br>

    <label for="amount">Amount:</label><br>
    <input type="number" name="amount" id="amount" required><br><br>

    <label for="description">Description:</label><br>
    <textarea name="description" id="description" required></textarea><br><br>

    <label for="payment_mode">Payment Mode:</label><br>
    <select name="payment_mode" id="payment_mode" required>
        <option value="cash">Cash</option>
        <option value="online">Online</option>
    </select><br><br>

    <label for="image">Upload Image:</label><br>
    <input type="file" name="image" id="image"><br><br>

    <input type="submit" value="Submit">
</form>
