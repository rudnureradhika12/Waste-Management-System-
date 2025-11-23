<?php
// Include database connection
include 'congig.php';

// Start session to check if admin is logged in
session_start();

// Check if the admin session is not set, if not, redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header('Location: generate_reports.php'); // Redirect to admin login page
    exit();
}

// Initialize message variable for status updates
$message = "";

// Handle the report generation
if (isset($_POST['generate_report'])) {
    // Get filter parameters from the form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $zone = $_POST['zone'];
    $status = $_POST['status'];

    // Create the SQL query to fetch data based on the filters
    $query = "SELECT wc.id, u.username, wc.address, wc.zone, wc.waste_type, wc.collection_date, wc.amount, wc.payment_mode, wc.status 
              FROM waste_collection wc
              JOIN users u ON wc.user_id = u.id
              WHERE wc.collection_date BETWEEN ? AND ?";
    
    // Add additional conditions if filter is selected
    if ($zone != '') {
        $query .= " AND wc.zone = ?";
    }
    if ($status != '') {
        $query .= " AND wc.status = ?";
    }

    // Prepare the statement and bind parameters
    $stmt = $conn->prepare($query);
    
    if ($zone != '' && $status != '') {
        $stmt->bind_param('ssss', $start_date, $end_date, $zone, $status);
    } elseif ($zone != '') {
        $stmt->bind_param('sss', $start_date, $end_date, $zone);
    } elseif ($status != '') {
        $stmt->bind_param('sss', $start_date, $end_date, $status);
    } else {
        $stmt->bind_param('ss', $start_date, $end_date);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Store results in an array for displaying the report
        $reports = [];
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }
    } else {
        $message = "No records found for the given filters.";
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        .btn {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #218838;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Generate Reports</h1>

        <?php if ($message != "") { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <!-- Report Filter Form -->
        <form method="POST" action="generate_reports.php">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <label for="zone">Zone:</label>
            <select name="zone" id="zone">
                <option value="">All Zones</option>
                <option value="Zone A">Zone A</option>
                <option value="Zone B">Zone B</option>
                <option value="Zone C">Zone C</option>
                <!-- Add more zones as needed -->
            </select>

            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>

            <button type="submit" name="generate_report" class="btn">Generate Report</button>
        </form>

        <?php if (isset($reports) && !empty($reports)) { ?>
            <!-- Display the Report Table -->
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Address</th>
                        <th>Zone</th>
                        <th>Waste Type</th>
                        <th>Collection Date</th>
                        <th>Amount (kg)</th>
                        <th>Payment Mode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($report['username']); ?></td>
                            <td><?php echo htmlspecialchars($report['address']); ?></td>
                            <td><?php echo htmlspecialchars($report['zone']); ?></td>
                            <td><?php echo htmlspecialchars($report['waste_type']); ?></td>
                            <td><?php echo htmlspecialchars($report['collection_date']); ?></td>
                            <td><?php echo htmlspecialchars($report['amount']); ?></td>
                            <td><?php echo htmlspecialchars($report['payment_mode']); ?></td>
                            <td><?php echo ucfirst($report['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
