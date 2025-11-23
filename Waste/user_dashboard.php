<!-- <?php include('../includes/congig.php'); ?> -->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('waste2.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: #fff;
    font-size: 24px;
  }

  .navbar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 15px 30px;
    position: sticky;
    top: 0;
    z-index: 999;
  }

  .navbar a {
    color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
    transition: color 0.3s;
  }

  .navbar a:hover {
    color: #FFD700;
  }

  .logout {
    background-color: #f44336;
    padding: 10px 15px;
    border-radius: 5px;
  }

  .header {
    text-align: center;
    padding: 40px 20px 10px;
    font-size: 32px;
  }

  .container {
    width: 90%;
    margin: auto;
    padding-bottom: 60px;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px; /* Increased gap */
    margin-top: 40px;
  }

  .card {
    flex: 1 1 320px; /* increased min size */
    max-width: 400px; /* increased width */
    background: rgba(255, 255, 255, 0.9);
    color: #000;
    padding: 35px 30px; /* more padding */
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    font-size: 20px; /* larger default text inside card */
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
  }

  .card h3 {
    margin-bottom: 15px;
    font-size: 28px; /* larger title */
    color: #333;
  }

  .card p {
    font-size: 18px; /* increased paragraph font */
    color: #555;
  }

  .card a {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 18px; /* larger button text */
    font-weight: bold;
    transition: background-color 0.3s;
  }

  .card a:hover {
    background-color: #388e3c;
  }

  @media (max-width: 768px) {
    .navbar {
      flex-direction: column;
      align-items: flex-end;
    }

    .card {
      max-width: 100%;
    }
  }
</style>

</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <a href="logout.php" class="logout">Logout</a>
  </div>

  <!-- Header -->
  <div class="header">
    <h2 style="color:black;">User Dashboard</h2>
  </div>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="card">
        <h3>Submit Form</h3>
        <p>Fill out a form to submit your waste collection data.</p>
        <a href="user_track.php">Go to Form</a>
      </div>

      <div class="card">
        <h3>Track Waste</h3>
        <p>View your waste collection details and track history.</p>
        <a href="track_details.php">Track Details</a>
      </div>

      <div class="card">
        <h3>Change Password</h3>
        <p>Secure your account by updating your password regularly.</p>
        <a href="change_password.php">Change Password</a>
      </div>
    </div>
  </div>

</body>
</html>
