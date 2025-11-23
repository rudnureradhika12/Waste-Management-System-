<?php
// Include the database connection
include('congig.php');

// Start the session and check if the admin is logged in
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adlogin.php");
    exit();
}

// Handling user deactivation
if (isset($_GET['deactivate_user'])) {
    $user_id = $_GET['deactivate_user'];
    $deactivate_sql = "UPDATE users SET status = 'deactivated' WHERE id = ?";
    $stmt = $conn->prepare($deactivate_sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    header("Location: user_management.php");
    exit();
}

// Fetch users (removed phone column)
$sql = "SELECT id, username, email, city, status FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Management</title>
  <style>
    * {
        box-sizing: border-box;
    }

    html, body {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        color: #333;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        flex: 1;
        width: 80%;
        margin: 20px auto;
    }

    .navbar {
        background-color: rgba(40, 167, 69, 0.95);
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar .logo {
        color: white;
        font-size: 22px;
        font-weight: bold;
    }

    .navbar .nav-links a {
        color: white;
        text-decoration: none;
        margin-left: 20px;
        font-size: 16px;
    }

    h2 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        color: white;
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

    .deactivate-btn {
        background-color: #ff5722;
        border: none;
        color: white;
        padding: 8px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 15px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .deactivate-btn:hover {
        background-color: #e64a19;
        transform: scale(1.05);
    }

    .view-btn {
        background-color: #007BFF;
        border: none;
        color: white;
        padding: 8px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 15px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .view-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .footer {
        background-color: black;
        color: white;
        text-align: center;
        padding: 15px 10px;
        font-size: 14px;
        margin-top: auto;
    }

    p {
        text-align: center;
        font-size: 18px;
        color: #f44336;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar .nav-links {
            width: 100%;
            margin-top: 10px;
        }

        .navbar .nav-links a {
            display: block;
            margin: 10px 0;
        }

        table {
            width: 100%;
            font-size: 14px;
        }

        th, td {
            padding: 10px;
        }
    }
  </style>
</head>
<body>
<div class="wrapper">

    <div class="navbar">
        <div class="logo"><i class="fas fa-recycle"></i> WasteBusters</div>
        <div class="nav-links">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="municipal.php">Municipal Corporation</a>
            <a href="recycling.php">Industry Recycling</a>
            <a href="pest_control.php">Pest Control</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>User Management</h2>

        <?php
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>
                    <th>Serial Number</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>';

            $serial = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $serial++ . '</td>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . ucfirst($row['status']) . '</td>';
                echo '<td>';
                echo '<a href="#" class="view-btn" onclick="alert(\'Username: ' . htmlspecialchars($row['username']) . '\nEmail: ' . htmlspecialchars($row['email']) . '\nCity: ' . htmlspecialchars($row['city']) . '\')">View Details</a>';
                if ($row['status'] != 'deactivated') {
                    echo '<a href="user_management.php?deactivate_user=' . $row['id'] . '" class="deactivate-btn" onclick="return confirm(\'Are you sure you want to deactivate this user?\')">Deactivate</a>';
                }
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No users found.</p>';
        }
        ?>
    </div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
