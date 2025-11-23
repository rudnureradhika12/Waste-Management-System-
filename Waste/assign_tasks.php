

// Start the session and check if the admin is logged in
<?php
session_start();

// Debug: Output session data to check if admin_id is set
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

// Check if the admin session is not set, if not, redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header('Location: adlogin.php'); // Redirect to admin login page
    exit(); // Ensure the script stops after redirection
}

// Handling task assignment
if (isset($_POST['assign'])) {
    $request_id = $_POST['request_id'];
    $collector_id = $_POST['collector_id'];

    // Update the waste_collection table with the assigned collector
    $update_sql = "UPDATE waste_collection SET collector_id = ?, status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('ii', $collector_id, $request_id);
    $stmt->execute();

    header("Location: assign_tasks.php"); // Redirect back to the same page after assignment
    exit();
}

// Fetch pending collection requests that are not assigned to any collector
$sql = "SELECT wc.id, wc.user_id, wc.address, wc.zone, wc.waste_type, wc.collection_date, wc.amount, u.username AS user_name 
        FROM waste_collection wc 
        JOIN users u ON wc.user_id = u.id
        WHERE wc.status = 'pending' AND wc.collector_id IS NULL";
$result = $conn->query($sql);

// Fetch all collectors (admins) for task assignment
$collectors_sql = "SELECT id, username FROM admins WHERE username LIKE 'collector%'";
$collectors_result = $conn->query($collectors_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Waste Collection Tasks</title>
    <style>
        /* General Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin: 20px;
            color: #333;
        }

        /* Table Styles */
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        tr:hover td {
            background-color: #e0f7fa;
        }

        /* Form Styling */
        form {
            display: inline-block;
            margin: 0 10px;
        }

        input[type="hidden"] {
            display: none;
        }

        select {
            padding: 6px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* No Requests Found Message */
        p {
            text-align: center;
            font-size: 18px;
            color: #f44336;
        }

        /* Centering the Table */
        .container {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Assign Pending Waste Collection Tasks</h2>

        <?php
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Address</th>
                    <th>Zone</th>
                    <th>Waste Type</th>
                    <th>Collection Date</th>
                    <th>Amount (kg)</th>
                    <th>Assign Task</th>
                </tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['user_name'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['zone'] . '</td>';
                echo '<td>' . $row['waste_type'] . '</td>';
                echo '<td>' . $row['collection_date'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>';
                echo '<form action="assign_tasks.php" method="POST">
                        <input type="hidden" name="request_id" value="' . $row['id'] . '">
                        <select name="collector_id" required>
                            <option value="">Select Collector</option>';

                // Fetch available collectors (admins)
                while ($collector = $collectors_result->fetch_assoc()) {
                    echo '<option value="' . $collector['id'] . '">' . $collector['username'] . '</option>';
                }

                echo '</select>
                      <button type="submit" name="assign">Assign</button>
                      </form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No pending tasks to assign.</p>';
        }

        ?>

    </div>

</body>
</html>

<?php
$conn->close(); // Close the connection after use
?>
