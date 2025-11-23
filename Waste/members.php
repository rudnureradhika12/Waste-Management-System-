<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garbage";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members - Waste Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('assets/images/background.jpg');
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            flex: 1;
            max-width: 1000px;
            margin: 30px auto;
            background-color: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #2ecc71;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #2ecc71;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .info-cards {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background: #e9fbe9;
            padding: 20px;
            border-left: 5px solid #2ecc71;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin-top: 0;
            color: #2ecc71;
        }

        footer {
            background-color: #2f2f2f;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }

        /* Navbar */
        .navbar {
            background-color: #28a745;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
        }

        .navbar .nav-links a i {
            margin-right: 6px;
        }

        /* Responsive Navbar */
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
        }

    </style>
</head>
<body>
<div class="navbar">
        <div class="logo"><i class="fas fa-recycle"></i> WasteBusters</div>
        <div class="nav-links">
            <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
            <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
            <a href="members.php"><i class="fas fa-users"></i> Members</a>
        </div>
    </div>
<div class="wrapper">
    

    <div class="container">
        <h2>Registered Members</h2>

        <?php
        $sql = "SELECT id, username, email, status, created_at FROM users ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "<p class='error'>Error fetching data: " . $conn->error . "</p>";
        } elseif ($result->num_rows > 0) {
            echo "<table><thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Status</th><th>Registered On</th> <th>Created On</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>" . htmlspecialchars($row['created_at']) . "</td>
                        <td>" . date("F j, Y", strtotime($row['created_at'])) . "</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p style='text-align:center; color:#888;'>No members registered yet.</p>";
        }
        ?>

        <div class="info-cards">
            <div class="card">
                <h3>Why Register?</h3>
                <p>Join a community that cares about the planet. Get rewarded for reporting and segregating waste properly.</p>
            </div>
            <div class="card">
                <h3>Community Impact</h3>
                <p>Thousands of members across the city are already making a difference. Be part of the change!</p>
            </div>
            <div class="card">
                <h3>Real-time Updates</h3>
                <p>Track your contributions and neighborhood cleanliness in real-time via your dashboard.</p>
            </div>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
    </footer>
</div>
</body>
</html>