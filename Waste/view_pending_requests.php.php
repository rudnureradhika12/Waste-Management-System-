<?php
include('congig.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: adlogin.php');
    exit;
}

$user_id = $_SESSION['admin_id'];

// Fetch pending waste collection requests
$sql = "SELECT * FROM waste_collection WHERE status = 'pending'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
</head>
<body>

    <h1>Pending Waste Collection Requests</h1>
    
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Request ID</th>
                <th>Address</th>
                <th>Zone</th>
                <th>Waste Type</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['zone']; ?></td>
                    <td><?php echo $row['waste_type']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><a href="assign_task.php?id=<?php echo $row['id']; ?>">Assign Task</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No pending requests at the moment.</p>
    <?php } ?>

</body>
</html>
