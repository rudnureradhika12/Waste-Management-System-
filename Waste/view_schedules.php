<?php 
include('congig.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: adlogin.php");
    exit();
}

// Handle update and store popup info
if (isset($_POST['update_schedule'])) {
    $request_id = $_POST['request_id'];
    $new_collection_date = $_POST['collection_date'];
    $new_address = $_POST['address'];
    $new_zone = $_POST['zone'];

    // Fetch user name before update
    $user_stmt = $conn->prepare("SELECT u.username FROM waste_collection wc JOIN users u ON wc.user_id = u.id WHERE wc.id = ?");
    $user_stmt->bind_param("i", $request_id);
    $user_stmt->execute();
    $user_stmt->bind_result($user_name);
    $user_stmt->fetch();
    $user_stmt->close();

    // Perform update
    $update_sql = "UPDATE waste_collection SET collection_date = ?, address = ?, zone = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('sssi', $new_collection_date, $new_address, $new_zone, $request_id);
    $stmt->execute();

    $_SESSION['update_success'] = true;
    $_SESSION['updated_user_name'] = $user_name;

    header("Location: view_schedules.php");
    exit();
}

$sql = "SELECT wc.id, wc.user_id, wc.address, wc.zone, wc.waste_type, wc.collection_date, u.username AS user_name 
        FROM waste_collection wc 
        JOIN users u ON wc.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Schedules</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #f3e5f5);
            animation: backgroundShift 15s ease infinite;
            color: #333;
        }

        @keyframes backgroundShift {
            0% { background-position: 0 0; }
            100% { background-position: 100% 100%; }
        }

        nav {
            background: #2e3a59;
            padding: 15px 30px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        nav h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 16px;
            background-color: #4CAF50;
            border-radius: 6px;
            transition: 0.3s;
        }

        nav a:hover {
            background-color: #66bb6a;
        }

        .container {
            flex: 1;
            max-width: 95%;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #4a148c;
            font-size: 32px;
            margin-bottom: 30px;
            text-shadow: 0 0 5px #ce93d8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f1f8e9;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        input[type="text"],
        input[type="date"] {
            padding: 8px;
            width: 150px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px #a5d6a7;
        }

        button {
            padding: 8px 14px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #388e3c;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #d32f2f;
        }

        footer {
            background-color: #2e3a59;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 15px;
        }

        @media screen and (max-width: 768px) {
            input[type="text"], input[type="date"] {
                width: 100px;
            }

            nav {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            table, th, td {
                font-size: 14px;
            }
        }

        /* Popup */
        .popup-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .popup-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            text-align: center;
            width: 300px;
        }

        .popup-icon {
            font-size: 48px;
            color: green;
        }

        .popup-box h2 {
            margin: 15px 0 10px;
        }

        .popup-box p {
            margin: 0 0 15px;
        }

        .popup-link {
            display: inline-block;
            margin-bottom: 10px;
            color: purple;
            font-weight: bold;
            text-decoration: underline;
        }

        .popup-btn {
            background: #b39ddb;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav>
    <h1>Admin Panel - Waste Management</h1>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</nav>

<div class="container">
    <h2>View & Edit Collection Schedules</h2>

    <?php
    if ($result && $result->num_rows > 0) {
        echo '<table>';
        echo '<tr>
                <th>ID</th>
                <th>User</th>
                <th>Address</th>
                <th>Zone</th>
                <th>Waste Type</th>
                <th>Collection Date</th>
                <th>Edit</th>
            </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['user_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['address']) . '</td>';
            echo '<td>' . htmlspecialchars($row['zone']) . '</td>';
            echo '<td>' . htmlspecialchars($row['waste_type']) . '</td>';
            echo '<td>' . htmlspecialchars($row['collection_date']) . '</td>';
            echo '<td>
                    <form method="POST" action="view_schedules.php">
                        <input type="hidden" name="request_id" value="' . $row['id'] . '">
                        <input type="text" name="address" value="' . $row['address'] . '" required>
                        <input type="text" name="zone" value="' . $row['zone'] . '" required>
                        <input type="date" name="collection_date" value="' . $row['collection_date'] . '" required>
                        <button type="submit" name="update_schedule">Update</button>
                    </form>
                </td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No collection schedules found.</p>';
    }
    ?>
</div>

<!-- Popup Message -->
<?php if (isset($_SESSION['update_success']) && $_SESSION['update_success']): ?>
<div class="popup-overlay">
  <div class="popup-box">
    <div class="popup-icon">&#10004;</div>
    <h2>Success!</h2>
    <p>Schedule updated for <strong><?php echo htmlspecialchars($_SESSION['updated_user_name']); ?></strong></p>
    <a href="admin_dashboard.php" class="popup-link">Go to Dashboard</a>
    <button class="popup-btn" onclick="document.querySelector('.popup-overlay').style.display='none'">OK</button>
  </div>
</div>
<?php 
    unset($_SESSION['update_success']); 
    unset($_SESSION['updated_user_name']);
endif; 
?>

<footer>
    &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
</footer>

</body>
</html>

<?php $conn->close(); ?>
