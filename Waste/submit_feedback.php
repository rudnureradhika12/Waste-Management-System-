<?php include 'includes/header.php'; ?>

<?php
// session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection


$user_id = $_SESSION['user_id'];

// Retrieve user's feedback from the database
$sql = "SELECT feedback FROM feedbacks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($feedback);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Feedback - Waste Management System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
        }

        .navbar a:hover {
            background-color: #555;
            border-radius: 5px;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff6b6b;
            font-size: 36px;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }

        .button-container {
            text-align: center;
            margin: 20px 0;
        }

        .btn {
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ff4d4d;
        }

        .images-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .image-card {
            background-color: #f4f4f4;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .image-card img {
            max-width: 100%;
            border-radius: 10px;
        }

        .image-card p {
            margin-top: 10px;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <!-- <div>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="feedback.php">Feedback</a>
        <a href="rewards.php">Rewards</a>
    </div> -->
    <div>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Thank You for Your Feedback!</h2>
    <p>We appreciate your input in helping us improve the Waste Management System.</p>

    <!-- Button to view submitted feedback details -->
    <div class="button-container">
        <a href="javascript:void(0)" class="btn" onclick="showFeedback()">View Your Feedback</a>
    </div>

    <!-- Display user's submitted feedback -->
    <div id="feedback-details" style="display: none; text-align: center; margin-top: 20px;">
        <h3>Your Submitted Feedback:</h3>
        <p><?php echo htmlspecialchars($feedback); ?></p>
    </div>

    <!-- Interesting images with captions -->
    <div class="images-container">
        <div class="image-card">
            <img src="assets/images/waste1.webp" alt="Waste Management">
            <p>Reduce, Reuse, Recycle</p>
        </div>
        <div class="image-card">
            <img src="assets/images/waste2.jpg" alt="Clean Environment">
            <p>Clean Environment, Better Future</p>
        </div>
        <div class="image-card">
            <img src="assets/images/waste3.jpg" alt="Recycling Process">
            <p>Recycling Process at Work</p>
        </div>
        <!-- Add more image cards as needed -->
    </div>
</div>

<script>
    function showFeedback() {
        document.getElementById('feedback-details').style.display = 'block';
    }
</script>

<?php include 'includes/footer.php'; ?>
