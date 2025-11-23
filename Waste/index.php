<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garbage";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data, no LIMIT
$sql = "SELECT address, zone, waste_type, description, image, collection_date FROM waste_collection ORDER BY collection_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waste Management - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('assets/images/waste2.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            display: inline-flex;
            align-items: center;
        }

        .navbar .nav-links a i { margin-right: 6px; }

        h1 {
            text-align: center;
            margin: 30px 10px 10px;
            color: #fff;
            text-shadow: 2px 2px 5px #000;
        }

        .get-started {
            text-align: center;
            margin: 20px;
        }

        .get-started a {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #ffc107, #ff8c00);
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            font-size: 18px;
            border-radius: 40px;
            box-shadow: 0 0 15px #ff9800, 0 0 30px #ffc107;
            transition: all 0.3s ease-in-out;
            animation: pulse 2s infinite;
            position: relative;
            overflow: hidden;
        }

        .get-started a:hover {
            transform: scale(1.08);
            background: linear-gradient(135deg, #ff8c00, #ffc107);
            box-shadow: 0 0 20px #ffd54f, 0 0 40px #ff9800;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 15px #ff9800, 0 0 30px #ffc107; }
            50% { box-shadow: 0 0 30px #ffd54f, 0 0 60px #ff9800; }
            100% { box-shadow: 0 0 15px #ff9800, 0 0 30px #ffc107; }
        }

        .grid { padding: 30px; flex: 1; }

        .row {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .card {
            width: 300px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h3 {
            font-size: 20px;
            color: #28a745;
            margin-bottom: 10px;
        }

        .card-content p {
            font-size: 14px;
            color: #333;
            margin: 6px 0;
        }

        .footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 15px 10px;
            font-size: 14px;
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

            .row {
                flex-direction: column;
                align-items: center;
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

<h1>Latest Waste Reports From Your City 🌍</h1>

<div class="get-started">
    <a href="index1.php"><i class="fas fa-magic"></i> Let's Get Started!</a>
</div>

<div class="grid">
    <?php 
    if ($result && $result->num_rows > 0):
        $count = 0;
        while($row = $result->fetch_assoc()):
            if ($count % 3 === 0) echo '<div class="row">';
    ?>
        <div class="card">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Waste Image">
            <div class="card-content">
            <h3><i class="fas fa-dumpster-fire"></i> <?= htmlspecialchars($row['waste_type']) ?></h3>
                <p><strong>📍 Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                <p><strong>🗺️ Zone:</strong> <?php echo htmlspecialchars($row['zone']); ?></p>
                <p><strong>📅 Date:</strong> <?php echo htmlspecialchars($row['collection_date']); ?></p>
                <p><strong>📝 Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
            </div>
        </div>
    <?php 
        $count++;
        if ($count % 3 === 0) echo '</div>';
        endwhile;
        if ($count % 3 !== 0) echo '</div>';
    ?>
        <p style="text-align:center; color: white;">No waste reports available.</p>
    <?php endif; ?>
</div>

<div class="footer">
    &copy; <?php echo date("Y"); ?> WasteBusters. All rights reserved.
</div>

</body>
</html>
