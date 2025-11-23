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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About WasteBusters</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: url('assets/images/waste2.jpg') no-repeat center center/cover;
      color: #333;
      display: flex;
      flex-direction: column;
    }

    body {
      margin: 0; /* Remove default body margin */
    }

    /* Navbar */
    .navbar {
      background-color: #4CAF50;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      border-radius: 0;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .logo {
      display: flex;
      align-items: center;
      font-size: 22px;
      /* font-weight: bold; */
    }

    .logo-icon {
      height: 30px;
      width: 30px;
      margin-right: 10px;
    }

    .nav-links {
      display: flex;
      gap: 25px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      /* font-weight: bold; */
      display: flex;
      align-items: center;
      transition: opacity 0.3s ease;
    }

    .nav-links a:hover {
      opacity: 0.8;
    }

    .icon {
      margin-right: 8px;
      font-size: 18px;
    }

    .wrapper {
      flex: 1;
      padding-top: 80px; /* Adjusted for navbar height */
      display: flex;
      flex-direction: column;
    }

    .content {
      padding: 30px;
      max-width: 1200px;
      margin: auto;
    }

    h2 {
      font-size: 36px;
      color: #ffffff;
      text-align: center;
      margin-bottom: 40px;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    .circle-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 25px;
    }

    .circle {
      width: 280px;
      height: 280px;
      background-color: rgba(255, 255, 255, 0.85);
      border-radius: 50%;
      padding: 20px;
      text-align: center;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: transform 0.3s;
    }

    .circle:hover {
      transform: scale(1.05);
    }

    .circle h3 {
      color: #2b6777;
      margin-bottom: 10px;
    }

    .circle p {
      font-size: 15px;
      color: #333;
    }

    @media (max-width: 768px) {
      .circle {
        width: 220px;
        height: 220px;
        padding: 15px;
      }

      .circle p {
        font-size: 14px;
      }

      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .nav-links {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        margin-top: 10px;
      }
    }

    @media (max-width: 480px) {
      .circle {
        width: 90%;
        height: auto;
        border-radius: 30px;
      }
    }

    .footer {
      background-color: black;
      color: #ffffff;
      text-align: center;
      padding: 15px 10px;
      font-size: 14px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    .footer a {
      color: #90caf9;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
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
  <!-- Main Content -->
  <div class="wrapper">
    <div class="content">
      <h2>About WasteBusters</h2>
      <div class="circle-container">
        <div class="circle">
          <h3>Smart Waste Management</h3>
          <p>Encouraging communities to take control of waste through sorting and recycling at source.</p>
        </div>
        <div class="circle">
          <h3>Reward System</h3>
          <p>Get rewarded for proper segregation through points, coupons, and achievements.</p>
        </div>
        <div class="circle">
          <h3>Mobile App</h3>
          <p>Manage your reports, rewards, and insights directly from our intuitive mobile app.</p>
        </div>
        <div class="circle">
          <h3>Cloud Powered</h3>
          <p>Store and access historical waste management data securely in the cloud.</p>
        </div>
        <div class="circle">
          <h3>Recycling Insights</h3>
          <p>Visual analytics to help communities track performance and reduce landfill waste.</p>
        </div>
        <div class="circle">
          <h3>Sustainable Design</h3>
          <p>Built with an eco-friendly approach using energy-efficient systems and materials.</p>
        </div>
      </div>
    </div>

    <!-- Footer -->
</div>
    <div>
    <footer class="footer">
      <p>&copy; 2025 WasteBusters. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>
