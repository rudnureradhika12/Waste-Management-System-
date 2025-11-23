<?php
// Include database connection
include 'config.php'; // Ensure this points to your correct database configuration

// Start session to check if admin is logged in
session_start();

// Check if the admin session is not set, if not, redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header('Location: waste_records.php'); // Redirect to admin login page
    exit();
}

// Handle form submission to add waste record
if (isset($_POST['submit_record'])) {
    $user_id = $_POST['user_id'];
    $address = $_POST['address'];
    $zone = $_POST['zone'];
    $waste_type = $_POST['waste_type'];
    $collection_date = $_POST['collection_date'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $status = 'pending';  // Default status as pending

    // Prepare SQL statement to insert waste record
    $query = "INSERT INTO waste_collection (user_id, address, zone, waste_type, collection_date, amount, payment_mode, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isssdsss', $user_id, $address, $zone, $waste_type, $collection_date, $amount, $payment_mode, $status);

    if ($stmt->execute()) {
        $message = "Waste record added successfully!";
    } else {
        $message = "Error adding waste record.";
    }
    $stmt->close();
}

// Fetch all users to show in the form dropdown
$user_query = "SELECT id, username FROM users";
$user_result = $conn->query($user_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Collection Records</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .message {
            text-align: center;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Waste Collection Records</h1>

        <?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <form method="POST" action="waste_records.php">
            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id" required>
                <option value="">Select User</option>
                <?php while ($user = $user_result->fetch_assoc()) { ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                <?php } ?>
            </select>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="zone">Zone:</label>
            <input type="text" id="zone" name="zone" required>

            <label for="waste_type">Waste Type:</label>
            <input type="text" id="waste_type" name="waste_type" required>

            <label for="collection_date">Collection Date:</label>
            <input type="date" id="collection_date" name="collection_date" required>

            <label for="amount">Amount (kg):</label>
            <input type="number" id="amount" name="amount" step="0.01" required>

            <label for="payment_mode">Payment Mode:</label>
            <select name="payment_mode" id="payment_mode" required>
                <option value="cash">Cash</option>
                <option value="online">Online</option>
            </select>

            <button type="submit" name="submit_record">Add Record</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
