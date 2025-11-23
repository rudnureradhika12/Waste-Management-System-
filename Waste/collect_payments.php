<?php
// Include database connection
include 'congig.php';

// Check if admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: collect_payments.php');
    exit();
}

// Fetch all pending/approved collection requests
$query = "SELECT wc.id, u.username, wc.address, wc.waste_type, wc.collection_date, wc.amount, wc.payment_status, wc.transaction_id, wc.payment_date
          FROM waste_collection wc
          JOIN users u ON wc.user_id = u.id
          WHERE wc.payment_status = 'pending' OR wc.payment_status = 'failed'";

$result = $conn->query($query);

// Handle payment update
if (isset($_POST['mark_paid'])) {
    $request_id = $_POST['request_id'];
    $transaction_id = $_POST['transaction_id'];
    $payment_date = date('Y-m-d H:i:s');

    // Update the payment status to 'paid' and add the transaction details
    $update_query = "UPDATE waste_collection SET payment_status = 'paid', transaction_id = ?, payment_date = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('ssi', $transaction_id, $payment_date, $request_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = "Payment marked as paid successfully!";
    } else {
        $message = "Error updating payment status.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collect Payments</title>
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

        .form-container {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .message {
            text-align: center;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Collect Payments</h1>

        <?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Address</th>
                    <th>Waste Type</th>
                    <th>Collection Date</th>
                    <th>Amount (kg)</th>
                    <th>Payment Status</th>
                    <th>Transaction ID</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['waste_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['collection_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['amount']); ?></td>
                        <td><?php echo ucfirst($row['payment_status']); ?></td>
                        <td><?php echo htmlspecialchars($row['transaction_id'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_date'] ?? 'N/A'); ?></td>
                        <td>
                            <?php if ($row['payment_status'] == 'pending' || $row['payment_status'] == 'failed') { ?>
                                <form method="post" action="collect_payments.php">
                                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="transaction_id" placeholder="Enter Transaction ID" required>
                                    <button type="submit" name="mark_paid" class="btn">Mark as Paid</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
