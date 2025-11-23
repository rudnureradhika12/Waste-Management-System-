<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "garbage";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT COUNT(*) AS total_requests FROM waste_requests";
$result = $conn->query($sql);
$request_count = 0;
if ($result && $row = $result->fetch_assoc()) {
    $request_count = $row['total_requests'];
}
$request_details = [];
$sql_requests = "SELECT users.name, waste_requests.created_at 
                 FROM waste_requests 
                 JOIN users ON waste_requests.user_id = users.id 
                 ORDER BY waste_requests.id DESC";
$result_requests = $conn->query($sql_requests);
if ($result_requests && $result_requests->num_rows > 0) {
    while ($row = $result_requests->fetch_assoc()) {
        $request_details[] = "Requested by " . $row['name'] . " on " . date("M d, Y H:i", strtotime($row['created_at']));
    }
}
$conn->close();
?>
<!DOCTYPE html> <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            min-height: 100vh;
            padding-bottom: 80px; }
        .navbar {
            background-color: rgba(0, 0, 0, 0.85);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar .logo { font-size: 20px; font-weight: bold; }
        .navbar .nav-links {
            display: flex;
            gap: 20px;
            position: relative;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
        .navbar a:hover { color: #1abc9c; }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: red;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 50%;
            font-weight: bold;
        }

        .notification-wrapper {
            position: relative;
        }

        .notification-box {
            position: absolute;
            right: 0;
            top: 35px;
            background-color: #333;
            border-radius: 8px;
            width: 250px;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
            z-index: 1001;
            display: none;
        }

        .notification-item {
            padding: 10px 15px;
            border-bottom: 1px solid #444;
            color: #fff;
            font-size: 14px;
        }

        .notification-item:last-child { border-bottom: none; }
        .notification-item:hover { background-color: #444; }

        .menu-icon {
            display: none;
            font-size: 26px;
            cursor: pointer;
        }

        .container {
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 25px;
            text-shadow: 2px 2px 4px #000;
        }

        .intro-box {
            max-width: 900px;
            margin: 0 auto 30px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .intro-box p {
            font-size: 17px;
            line-height: 1.6;
            margin: 0;
            flex: 1;
        }

        .info-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
            padding: 10px;
        }

        .cards-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .card {
            height: 200px;
            border-radius: 12px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px 15px;
            border-radius: 6px;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
        }

        .card:nth-child(1) { background-image: url('https://img.freepik.com/premium-vector/waste-recycling-concept-flat-cartoon-design-men-woman-collecting-sorting-separate-garbage_9209-8705.jpg'); }
        .card:nth-child(2) { background-image: url('https://th.bing.com/th/id/OIP.fco9B2Rntiwk7cjr46hv1QHaHa?rs=1&pid=ImgDetMain'); }
        .card:nth-child(3) { background-image: url('https://cdn5.vectorstock.com/i/1000x1000/27/09/graphic-cartoon-character-project-management-vector-38092709.jpg'); }
        .card:nth-child(4) { background-image: url('https://static.vecteezy.com/system/resources/previews/004/341/571/original/waste-management-eco-friendly-living-2d-web-banner-poster-garbage-separation-man-and-woman-sorting-trash-flat-characters-on-cartoon-background-printable-patches-colorful-web-elements-vector.jpg'); }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 16px;
            z-index: 1000;
        }

        /* Magical pop-up styles */
        .magic-popup {
            position: fixed;
            top: 80px;
            right: 20px;
            background: rgba(30, 144, 255, 0.85);
            color: white;
            padding: 14px 20px;
            margin-bottom: 10px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
            animation: slideIn 0.6s ease-out, fadeOut 0.6s ease-in 5s forwards;
            font-weight: bold;
            z-index: 2000;
            font-size: 15px;
        }

        @keyframes slideIn {
            from { transform: translateX(150%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(150%); }
        }

        @media (max-width: 768px) {
            .navbar .nav-links {
                display: none;
                flex-direction: column;
                background: rgba(0, 0, 0, 0.9);
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                padding: 10px;
                border-radius: 6px;
            }
            .navbar.active .nav-links {
                display: flex;
            }
            .menu-icon {
                display: block;
                color: white;
            }
            .intro-box {
                flex-direction: column;
                text-align: center;
            }
            .info-icon {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar" id="navbar">
        <div class="logo">Admin Panel</div>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="municipal.php">Municipal Corporation</a>
            <a href="recycling.php">Industry Recycling</a>
            <a href="pest_control.php">Pest Control</a>
            <div class="notification-wrapper">
                <i class="fas fa-bell" onclick="toggleNotifications()" style="cursor: pointer;"></i>
                <?php if ($request_count > 0): ?>
                    <span class="notification-badge"><?php echo $request_count; ?></span>
                <?php endif; ?>
                <div id="notification-box" class="notification-box">
                    <?php if (!empty($request_details)) : ?>
                        <?php foreach ($request_details as $note): ?>
                            <div class="notification-item"><?php echo htmlspecialchars($note); ?></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="notification-item">No new requests</div>
                    <?php endif; ?>
                </div>
            </div>
            <a href="logout.php" style="color: #e74c3c;">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Welcome to the Admin Panel</h1>
        <div class="intro-box">
            <img src="https://c8.alamy.com/comp/2J3TP8B/waste-management-and-trash-sorting-environment-protection-and-rubbish-recycling-cartoon-vector-illustration-2J3TP8B.jpg" alt="Waste Icon" class="info-icon">
            <p>
                This Waste Management System empowers municipalities, industries, and pest control units to streamline waste collection,
                user tracking, and schedule management — all in one place. Built for smarter cities and cleaner communities.
            </p>
        </div>
        <div class="cards-wrapper">
            <div class="card"><a href="pending_requests.php">Pending Waste Collection Requests</a></div>
            <div class="card"><a href="view_schedules.php">Edit Collection Schedules</a></div>
            <div class="card"><a href="user_management.php">User Management</a></div>
            <div class="card"><a href="manage_categories.php">Manage Waste Categories</a></div>
        </div>
    </div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
    </div>

    <!-- Magical pop-ups -->
    <?php foreach (array_slice($request_details, 0, 5) as $popup): ?>
        <div class="magic-popup"><?php echo htmlspecialchars($popup); ?></div>
    <?php endforeach; ?>

    <script>
        function toggleMenu() {
            document.getElementById("navbar").classList.toggle("active");
        }

        function toggleNotifications() {
            var box = document.getElementById("notification-box");
            box.style.display = box.style.display === "none" ? "block" : "none";
        }

        document.addEventListener("click", function(e) {
            var box = document.getElementById("notification-box");
            if (!e.target.closest(".notification-wrapper")) {
                box.style.display = "none";
            }
        });
    </script>
</body>
</html>
