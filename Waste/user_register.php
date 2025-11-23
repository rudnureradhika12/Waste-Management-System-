<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garbage";

$conn = new mysqli($servername, $username, $password, $dbname);

$message = "";
$success = null;

if (isset($_POST['submit'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $input_email = $_POST['email'];
    $input_phone = $_POST['phone'];
    $input_city = $_POST['city'];

    if (strlen($input_password) < 6) {
        $message = "Password must be at least 6 characters long!";
        $success = false;
    } else {
        $hashed_password = md5($input_password); // Use bcrypt in production

        $sql = "INSERT INTO users (username, password, email, phone, city) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $input_username, $hashed_password, $input_email, $input_phone, $input_city);
            if ($stmt->execute()) {
                $success = true;
                $message = "Registration successful!";
            } else {
                $success = false;
                $message = "Registration failed! Try again.";
            }
            $stmt->close();
        } else {
            $success = false;
            $message = "Database error. Please check your table structure.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Magical User Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Base styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0,0,0,0.8)), url('b3.avif') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 40px;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 0 25px #ffffff60;
            text-align: center;
            width: 350px;
            position: relative;
        }

        h1 {
            color: #fff;
            font-size: 34px;
            margin-bottom: 20px;
            text-shadow: 0 0 15px #fff, 0 0 20px #00f2ff;
        }

        label {
            color: #fff;
            font-size: 16px;
            display: block;
            margin: 10px 0 5px;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            outline: none;
            margin-bottom: 15px;
            font-size: 16px;
            background: rgba(255,255,255,0.2);
            color: #fff;
            box-shadow: 0 0 12px #9c00ff50;
        }

        input::placeholder {
            color: #ddd;
        }

        input[type="submit"] {
            background: linear-gradient(45deg, #00f2ff, #9c00ff);
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.4s ease;
            text-shadow: 0 0 6px #000;
        }

        input[type="submit"]:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px #fff, 0 0 25px #9c00ff;
        }

        /* Modal styles */
        .popup-overlay {
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0,0,0,0.6);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 1000;
        }

        .popup {
            background: white;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            max-width: 400px;
            position: relative;
            animation: popFade 0.3s ease-out;
            box-shadow: 0 0 25px #00000088;
        }

        .popup img {
            width: 60px;
            margin-bottom: 20px;
        }

        .popup h2 {
            margin: 10px 0 10px;
            color: #333;
        }

        .popup p {
            font-size: 15px;
            color: #666;
        }

        .popup a {
            color: #6b00ff;
            font-weight: bold;
            text-decoration: underline;
        }

        .popup button {
            background: #a67cff;
            border: none;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .popup button:hover {
            background: #7b5acc;
        }

        @keyframes popFade {
            from {
                opacity: 0;
                transform: scale(0.85);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .popup {
    background: white;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    max-width: 600px; /* Increased from 400px */
    width: 90%; /* Optional: makes it responsive */
    position: relative;
    animation: popFade 0.3s ease-out;
    box-shadow: 0 0 25px #00000088;
}
.popup {
    background: white;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    max-width: 600px;
    width: 90%;
    position: relative;
    animation: popFade 0.3s ease-out;
    box-shadow: 0 0 25px #00000088;
}

    </style>
</head>
<body>

<div class="container">
    <h1>Register</h1>
    <form method="POST" action="user_register.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" required>

    <label for="city">City:</label>
    <input type="text" name="city" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <input type="submit" name="submit" value="Register">

    <p style="margin-top: 15px; color: #fff;">
        Already registered? 
        <a href="user_login.php" style="color: #00f2ff; text-decoration: underline; font-weight: bold;">Login here</a>
    </p>
</form>

</div>

<?php if ($success !== null): ?>
<div class="popup-overlay" id="popupBox">
    <div class="popup">
        <img src="<?= $success ? 'https://img.icons8.com/fluency/96/ok.png' : 'https://img.icons8.com/color/96/error--v1.png' ?>" alt="<?= $success ? 'Success' : 'Error' ?>">
        <h2><?= $success ? "Success!" : "Oops!" ?></h2>
        <p><?= $message ?></p>
        <?php if ($success): ?>
            <p><a href="user_login.php">Login here</a></p>
        <?php else: ?>
            <p><a href="user_register.php">Register correctly</a></p>
        <?php endif; ?>
        <button onclick="document.getElementById('popupBox').style.display='none';">OK</button>
    </div>
</div>
<?php endif; ?>

</body>
</html>
