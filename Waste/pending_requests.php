<?php  
include('congig.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adlogin.php");
    exit();
}

// Handle approve/reject actions
if (isset($_POST['action'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        // Update status in waste_collection table
        $stmt = $conn->prepare("UPDATE waste_collection SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $stmt->close();

        // Fetch the request details for the user
        $fetchStmt = $conn->prepare("SELECT user_id, address, zone, waste_type, collection_date FROM waste_collection WHERE id = ?");
        $fetchStmt->bind_param("i", $request_id);
        $fetchStmt->execute();
        $fetchResult = $fetchStmt->get_result();

        if ($fetchResult->num_rows > 0) {
            $row = $fetchResult->fetch_assoc();

            // Insert approved message into approved_message table
            $insertStmt = $conn->prepare("INSERT INTO approved_message (user_id, address, zone, waste_type, collection_date, status) VALUES (?, ?, ?, ?, ?, 'approved')");
            $insertStmt->bind_param("issss", $row['user_id'], $row['address'], $row['zone'], $row['waste_type'], $row['collection_date']);
            $insertStmt->execute();
            $insertStmt->close();
        }
        $fetchStmt->close();
    } elseif ($action === 'reject') {
        // Update status in waste_collection table
        $stmt = $conn->prepare("UPDATE waste_collection SET status = 'rejected' WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect after the action is done
    header("Location: pending_requests.php?status=$action");
    exit();
}

// Fetch pending requests
$sql = "SELECT wc.id, wc.user_id, wc.address, wc.zone, wc.waste_type, wc.collection_date, u.username AS user_name 
        FROM waste_collection wc 
        JOIN users u ON wc.user_id = u.id
        WHERE wc.status = 'pending'";
$result = $conn->query($sql);

// Fetch approved count
$approvedCount = 0;
$approvedQuery = "SELECT COUNT(*) AS total FROM waste_collection WHERE status = 'approved'";
$approvedResult = $conn->query($approvedQuery);
if ($approvedResult && $approvedResult->num_rows > 0) {
    $approvedCount = $approvedResult->fetch_assoc()['total'];
}

// Fetch rejected count
$rejectedCount = 0;
$rejectedQuery = "SELECT COUNT(*) AS total FROM waste_collection WHERE status = 'rejected'";
$rejectedResult = $conn->query($rejectedQuery);
if ($rejectedResult && $rejectedResult->num_rows > 0) {
    $rejectedCount = $rejectedResult->fetch_assoc()['total'];
}

// Fetch approved and rejected data
$approvedRejectedSql = "SELECT wc.id, wc.user_id, wc.address, wc.zone, wc.waste_type, wc.collection_date, wc.status, u.username AS user_name 
                        FROM waste_collection wc 
                        JOIN users u ON wc.user_id = u.id
                        WHERE wc.status IN ('approved', 'rejected')";
$approvedRejectedResult = $conn->query($approvedRejectedSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Waste Collection Requests</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #2c3e50;
            padding: 1rem 2rem;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: #ecf0f1;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            padding: 2rem;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        form {
            display: inline-block;
        }

        button {
            padding: 5px 10px;
            margin: 3px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #2ecc71;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #27ae60;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .card {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            color: #2c3e50;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .card p {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 1rem;
            text-align: center;
        }

        @media screen and (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                display: flex;
                flex-direction: column;
                margin-top: 10px;
            }

            .nav-links a {
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
<div style="min-height: 100vh; display: flex; flex-direction: column;">

<div class="navbar">
    <div class="logo">Pending Requests</div>
    <div class="nav-links">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="municipal.php">Municipal</a>
        <a href="recycling.php">Recycling</a>
        <a href="pest_control.php">Pest Control</a>
        <a href="logout.php" style="color: #e74c3c;">Logout</a>
    </div>
</div>

<div class="container" style="flex: 1;">
    <h1>Pending Waste Collection Requests</h1>

    <div class="dashboard-cards">
        <div class="card"><h3>Total Pending</h3><p><?= ($result && $result->num_rows > 0) ? $result->num_rows : 0 ?></p></div>
        <div class="card"><h3>Collector Rejections</h3><p><?= $rejectedCount ?></p></div>
        <div class="card"><h3>Collection Approved</h3><p><?= $approvedCount ?></p></div>
        <div class="card"><h3>Unassigned Zones</h3><p>Check Manually</p></div>
    </div>

    <br>
    <h2>Pending Requests</h2>
    <?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Serial No.</th>
            <th>User</th>
            <th>Address</th>
            <th>Zone</th>
            <th>Waste Type</th>
            <th>Collection Date</th>
            <th>Actions</th>
        </tr>
        <?php $serial = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $serial++ ?></td>
            <td><?= $row['user_name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['zone'] ?></td>
            <td><?= $row['waste_type'] ?></td>
            <td><?= $row['collection_date'] ?></td>
            <td>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="approve">
                    <button type="submit">Approve</button>
                </form>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="reject">
                    <button type="submit" style="background:#e74c3c;">Reject</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No pending requests found.</p>
    <?php endif; ?>

    <br><br>
    <h2>Approved & Rejected Requests</h2>

    <?php if ($approvedRejectedResult && $approvedRejectedResult->num_rows > 0): ?>
        <table>
            <tr>
                <th>Serial No.</th>
                <th>User</th>
                <th>Address</th>
                <th>Zone</th>
                <th>Waste Type</th>
                <th>Collection Date</th>
                <th>Status</th>
            </tr>
            <?php $serial = 1; while ($row = $approvedRejectedResult->fetch_assoc()): ?>
            <tr>
                <td><?= $serial++ ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['zone'] ?></td>
                <td><?= $row['waste_type'] ?></td>
                <td><?= $row['collection_date'] ?></td>
                <td><?= ucfirst($row['status']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No approved or rejected requests found.</p>
    <?php endif; ?>
</div>

<footer class="footer">
    <p>&copy; 2025 Waste Management System. All rights reserved.</p>
</footer>

</div>
</body>
</html>
