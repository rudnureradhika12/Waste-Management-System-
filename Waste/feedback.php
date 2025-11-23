<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "garbage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Waste Management System</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Ensure the entire page takes up full height */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Arial', sans-serif;
            /* background-color: #f0f0f0; */
            background-image: url('assets/images/waste7.jpg');
        }

        /* Flexbox layout for the content wrapper */
        .container-wrapper {
            flex: 1; /* This makes the content container expand to fill the available space */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Styling for the container holding the feedback form */
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            color: #ff6b6b; /* Soft pinkish color */
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff4d4d;
        }

        /* Footer Styling */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }
        }
        /* Footer */
        .footer {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 15px 10px;
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

<!-- Content Wrapper -->
<div class="container-wrapper">
    <div class="container">
        <h2>Feedback</h2>
        <form action="submit_feedback.php" method="POST">
            <label for="feedback" class="form-label">Your Feedback</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="5" required></textarea>
            <button type="submit" class="btn-primary">Submit Feedback</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
</footer>

</body>
</html>
