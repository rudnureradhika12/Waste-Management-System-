<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $description = $_POST["description"];
    $image = $_FILES["image"];

    // TODO: Save data to database, process image
    echo "<script>alert('Form submitted successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Municipal Corporation | Waste Management</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #d4fc79, #96e6a1);
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #2e7d32;
      color: white;
      padding: 20px 30px;
      flex-wrap: wrap;
    }

    .nav-left {
      font-size: 24px;
      font-weight: bold;
    }

    .nav-right a {
      color: white;
      text-decoration: none;
      margin-left: 25px;
      font-weight: 600;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .nav-right a:hover {
      color: #ffeb3b;
    }

    .container {
      flex: 1;
      padding: 40px 20px;
      max-width: 1300px;
      margin: auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #2e7d32;
    }

    .grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: space-between;
    }

    .card {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      flex: 1 1 calc(33.333% - 20px);
      min-width: 280px;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      color: #388e3c;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 14px;
    }

    .form-section {
      background: rgba(255, 255, 255, 0.95);
      width: 100%;
      max-width: 600px;
      margin: 60px auto;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #444;
    }

    input[type="text"],
    input[type="tel"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 14px;
      margin-bottom: 25px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 14px 0;
      border: none;
      border-radius: 8px;
      width: 100%;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #43a047;
    }

    .back-btn {
      text-align: center;
      margin-bottom: 30px;
    }

    .back-btn a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #2e7d32;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .back-btn a:hover {
      background-color: #1b5e20;
    }

    footer {
      background-color: #2e7d32;
      color: white;
      text-align: center;
      padding: 15px 20px;
      font-size: 16px;
      margin-top: auto;
    }

    @media (max-width: 1000px) {
      .card {
        flex: 1 1 calc(50% - 20px);
      }
    }

    @media (max-width: 600px) {
      .grid {
        flex-direction: column;
        gap: 20px;
      }

      .card {
        flex: 1 1 100%;
      }

      .form-section {
        padding: 30px 20px;
        margin: 40px 15px;
      }

      .nav-right {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
      }

      .nav-right a {
        margin: 8px 0;
      }
    }
  </style>
</head>
<body>

  <nav>
    <div class="nav-left">Municipal Panel</div>
    <div class="nav-right">
      <a href="admin_dashboard.php">Dashboard</a>
      <a href="municipal.php">Municipal Corporation</a>
      <a href="recycling.php">Industry Recycling</a>
      <a href="pest_control.php">Pest Control</a>
      <a href="logout.php">Logout</a>
    </div>
  </nav>

  <div class="container">
    <h2>Key Requirements</h2>
    <div class="back-btn">
      <a href="admin_dashboard.php">⬅ Back to Home</a>
    </div>

    <div class="grid">
      <div class="card">
        <h3>1. Infrastructure</h3>
        <p>Segregated bins, garbage trucks, transfer stations, treatment plants (recycling, compost, WtE).</p>
      </div>
      <div class="card">
        <h3>2. Technology</h3>
        <p>IoT smart bins, GIS mapping, mobile apps for citizens, live dashboards and route tracking.</p>
      </div>
      <div class="card">
        <h3>3. Policies & Regulations</h3>
        <p>Mandatory segregation, penalties, public-private partnerships, and incentive-based systems.</p>
      </div>
      <div class="card">
        <h3>4. Human Resources</h3>
        <p>Sanitation workers, monitoring staff, data entry operators, technical team for system upkeep.</p>
      </div>
      <div class="card">
        <h3>5. Public Awareness</h3>
        <p>Workshops, community programs, school campaigns, and media engagement for education.</p>
      </div>
      <div class="card">
        <h3>6. Monitoring Tools</h3>
        <p>Live tracking, complaint redressal portals, audit reports, and automated alerts.</p>
      </div>
      <div class="card">
        <h3>7. Emergency Waste Plans</h3>
        <p>Preparedness for waste spikes during festivals, natural calamities, or pandemics.</p>
      </div>
    </div>

    <div class="form-section">
      <h2>Submit a Waste Collection Request</h2>

      <form method="POST" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="mobile">Mobile Number</label>
        <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>

        <label for="address">Waste Collection Address</label>
        <input type="text" id="address" name="address" required>

        <label for="description">Description of Waste</label>
        <textarea id="description" name="description" placeholder="e.g. Plastic waste, debris, etc."></textarea>

        <label for="image">Upload Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" value="Submit Request">
      </form>
    </div>
  </div>

  <footer>
    &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
  </footer>

</body>
</html>
