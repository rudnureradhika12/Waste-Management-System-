<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garbage";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$login_success = false;
$error_message = "";

if (isset($_POST['submit'])) {
    $input_username = $_POST['username'];
    $input_password = md5($_POST['password']); // For demo only; use password_hash in production

    $sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $input_username;
        $login_success = true;
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - Waste Management</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('1.png') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: black;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 25px;
      padding: 40px 30px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.3), 0 0 80px rgba(0, 0, 255, 0.2);
      animation: fadeIn 1s ease-in;
      text-align: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    h2 {
      color: #000000;
      margin-bottom: 25px;
      font-size: 28px;
      text-shadow: 0 0 10px #00f0ff;
    }

    label {
      display: block;
      color: black;
      text-align: left;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 12px;
      margin-bottom: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      color: black;
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      font-size: 18px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(to right, #38bdf8, #6366f1);
      color: white;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 0 10px #38bdf8, 0 0 20px #6366f1;
      transition: all 0.3s ease;
    }

    input[type="submit"]:hover {
      background: linear-gradient(to right, #2563eb, #7c3aed);
      box-shadow: 0 0 15px #38bdf8, 0 0 30px #6366f1;
      transform: scale(1.03);
    }

    .popup-success, .popup-error {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      padding: 40px 60px;
      border-radius: 30px;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      z-index: 9999;
      animation: popup-glow 4s ease-in-out forwards;
    }

    .popup-success {
      background: radial-gradient(circle at top left, #38bdf8, #6366f1);
      box-shadow: 0 0 40px rgba(56, 189, 248, 0.8), 0 0 80px rgba(99, 102, 241, 0.7);
    }

    .popup-error {
      background: radial-gradient(circle at top left, #ff1e1e, #990000);
      box-shadow: 0 0 40px rgba(255, 0, 0, 0.8), 0 0 80px rgba(255, 0, 0, 0.6);
    }

    @keyframes popup-glow {
      0% {
        opacity: 0;
        transform: translate(-50%, -60%) scale(0.8);
      }
      10% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.1);
      }
      80% {
        transform: translate(-50%, -50%) scale(1);
      }
      100% {
        opacity: 0;
      }
    }

    @media (max-width: 480px) {
      .container {
        margin: 10px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<?php if ($login_success): ?>
  <div class="popup-success" id="popup">
    ✨🎉 <br> Successfully Logged In! <br> 🎉✨
  </div>
  <script>
    setTimeout(() => {
      window.location.href = 'admin_dashboard.php';
    }, 4000);
  </script>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
  <div class="popup-error" id="popup">
    ❌ <br> <?php echo htmlspecialchars($error_message); ?> <br> ❌
  </div>
  <script>
    setTimeout(() => {
      document.getElementById("popup").style.display = "none";
    }, 4000);
  </script>
<?php endif; ?>

<div class="container">
  <h2>🌟 Admin Login Portal 🌟</h2>
  <form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required />

    <input type="submit" name="submit" value="Login">
  </form>
</div>

</body>
</html>
