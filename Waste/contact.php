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
    <title>Contact - Waste Management System</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('assets/images/waste8.jpg'); 
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #ff6b6b;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
        }

        .form-control:focus {
            border-color: #ff6b6b;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 107, 107, 0.5);
        }

        .btn {
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #ff4d4d;
        }

        .flex-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .flex-item {
            background: linear-gradient(135deg, #ffdfba, #f76b1c);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .testimonial {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .testimonial h3 {
            color: #ff6b6b;
            margin-bottom: 15px;
        }

        .testimonial-item {
            font-style: italic;
            margin: 10px 0;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 20px;
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
<div class="container">
    <h2>Contact Us</h2>
    <form action="submit_contact.php" method="POST">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>

        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>

        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>

        <button type="submit" class="btn">Send Message</button>
    </form>

    <div class="flex-container">
        <div class="flex-item">Join our community and make a difference in waste management!</div>
        <div class="flex-item">Learn more about our rewards system for effective waste segregation.</div>
        <div class="flex-item">Stay updated with the latest news on recycling and waste management.</div>
        <div class="flex-item">Your efforts in waste segregation can contribute to a cleaner planet!</div>
    </div>

    <div class="testimonial">
        <h3>What Our Users Say</h3>
        <div class="testimonial-item">"WasteWise has changed how I manage waste at home. I love the rewards!" - Sarah W.</div>
        <div class="testimonial-item">"This system is easy to use and makes recycling fun!" - John D.</div>
        <div class="testimonial-item">"I appreciate how I can track my waste segregation efforts!" - Lisa T.</div>
        <div class="testimonial-item">"The rewards are a great motivation to recycle more!" - Mark L.</div>
    </div>
</div>

<div class="footer">
        &copy; <?= date("Y") ?> WasteBusters. All rights reserved.
    </div>

</body>
</html>
