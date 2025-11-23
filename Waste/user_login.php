<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garbage";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_success = false;

if (isset($_POST['submit'])) {
    $input_username = $_POST['username'];
    $input_password = MD5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $login_success = true;
    } else {
        $error_message = "Invalid username or password!";
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
  <title>User Login - Waste Management System</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('b3.avif');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
      animation: float-in 1s ease;
    }

    @keyframes float-in {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      color: #006d77;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      font-weight: bold;
      color: #333;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background: linear-gradient(to right, #38bdf8, #6366f1);
      color: white;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s ease;
    }

    input[type="submit"]:hover {
      background: linear-gradient(to right, #2563eb, #7c3aed);
    }

    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
    }

    .register-link {
      text-align: center;
      margin-top: 20px;
    }

    .register-link a {
      color: #0077cc;
      text-decoration: none;
      font-weight: bold;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .popup-success {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: radial-gradient(circle at top left, #38bdf8, #6366f1);
  color: white;
  padding: 40px 60px;
  border-radius: 30px;
  font-size: 26px;
  font-weight: bold;
  text-align: center;
  z-index: 9999;
  box-shadow: 0 0 40px rgba(56, 189, 248, 0.8), 0 0 80px rgba(99, 102, 241, 0.7);
  animation: popup-glow 4s ease-in-out forwards;
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


    @keyframes popup-fade {
      0% { opacity: 0; transform: translate(-50%, -60%) scale(0.9); }
      10% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
      90% { opacity: 1; }
      100% { opacity: 0; transform: translate(-50%, -50%) scale(1); }
    }

    @media (max-width: 480px) {
      .container {
        margin: 10px;
        padding: 20px;
      }
    }
    .popup-error {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: radial-gradient(circle at top left, #ff1e1e, #990000);
  color: white;
  padding: 40px 60px;
  border-radius: 30px;
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  z-index: 9999;
  box-shadow: 0 0 40px rgba(255, 0, 0, 0.8), 0 0 80px rgba(255, 0, 0, 0.6);
  animation: popup-glow 4s ease-in-out forwards;
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
      window.location.href = 'user_dashboard.php';
    }, 4000);
  </script>
<?php endif; ?>

<?php if (isset($error_message)): ?>
  <div class="popup-error" id="popup">
    ❌ <br> <?php echo $error_message; ?> <br> ❌
  </div>
  <script>
    setTimeout(() => {
      document.getElementById("popup").style.display = "none";
    }, 4000);
  </script>
<?php endif; ?>

<div class="container">
  <h2>User Login</h2>
  <form method="POST" action="user_login.php">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required />
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required />
    </div>

    <input type="submit" name="submit" value="Login" />
  </form>

  <?php if (isset($error_message)): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
  <?php endif; ?>

  <div class="register-link">
    <p>New user? <a href="user_register.php">Register here</a></p>
  </div>
</div>

</body>
</html>
