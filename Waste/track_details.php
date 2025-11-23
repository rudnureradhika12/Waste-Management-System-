<?php  
include('congig.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM waste_collection WHERE user_id = ?";
$waste_data = [];

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $waste_data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Waste Collection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Existing styles remain unchanged... */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(90deg, #28a745, #218838);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 17px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .navbar .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container {
            width: 85%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .track-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to right, #4CAF50, #66bb6a);
            padding: 15px 25px;
            border-radius: 12px;
            color: #fff;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 26px;
        }

        .back-button {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .back-button:hover {
            background-color: #e53935;
        }

        .track-record {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: #f0fff4;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            gap: 20px;
        }

        .record-details {
            flex: 2;
        }

        .record-details p {
            font-size: 17px;
            margin: 12px 0;
            font-weight: 500;
            color: #333;
        }

        .status-message {
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 8px;
            margin-top: 10px;
            display: inline-block;
        }

        .approved {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .rejected {
            background-color: #ffcdd2;
            color: #c62828;
        }

        .pending {
            background-color: #fff9c4;
            color: #f57f17;
        }

        .record-image {
            flex: 1;
            text-align: right;
        }

        .record-image img {
            max-width: 820px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .footer {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 15px 10px;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .track-record {
                flex-direction: column;
                text-align: center;
            }
            .record-image {
                margin-top: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo"><i class="fas fa-recycle"></i> WasteBusters</div>
    <div class="nav-links">
        <a href="user_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="container">
    <div class="track-header">
        <h2>Your Waste Collection Details</h2>
        <a href="user_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>

    <?php if (count($waste_data) > 0): ?>
        <?php foreach ($waste_data as $record): ?>
            <div class="track-record">
                <div class="record-details">
                    <p><strong>Address:</strong> <?= htmlspecialchars($record['address']); ?></p>
                    <p><strong>Zone:</strong> <?= htmlspecialchars($record['zone']); ?></p>
                    <p><strong>Waste Type:</strong> <?= htmlspecialchars($record['waste_type']); ?></p>
                    <p><strong>Collection Date:</strong> <?= htmlspecialchars($record['collection_date']); ?></p>
                    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($record['description'])); ?></p>
                    
                    <!-- Status Message Display -->
                    <?php
                        $status = strtolower($record['status']);
                        if ($status === 'approved') {
                            echo '<span class="status-message approved">✔️ Request Approved</span>';
                        } elseif ($status === 'rejected') {
                            echo '<span class="status-message rejected">❌ Request Rejected</span>';
                        } else {
                            echo '<span class="status-message pending">⏳ Pending Approval</span>';
                        }
                    ?>
                </div>
                <?php if (!empty($record['image'])): ?>
                    <div class="record-image">
                        <img src="<?= htmlspecialchars($record['image']); ?>" alt="Waste Image">
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">No waste collection records found.</p>
    <?php endif; ?>
</div>

<div class="footer">
    &copy; <?= date("Y") ?> WasteBusters. All rights reserved.
</div>

</body>
</html>
