<?php 
include('congig.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit;
}

$user_id = $_SESSION['user_id'];
$showSuccess = false;
$showError = false;
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['address'];
    $zone = $_POST['zone'];
    $waste_type = $_POST['waste_type'];
    $collection_date = $_POST['collection_date'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = '';
    }

    $sql = "INSERT INTO waste_collection (user_id, address, zone, waste_type, collection_date, description, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('issssss', $user_id, $address, $zone, $waste_type, $collection_date, $description, $image);
        if ($stmt->execute()) {
            $showSuccess = true;
        } else {
            $showError = true;
            $errorMsg = $stmt->error;
        }
        $stmt->close();
    } else {
        $showError = true;
        $errorMsg = $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waste Collection Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-size: 18px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            background: url('https://images.unsplash.com/photo-1497493292307-31c376b6e479?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: #111;
            border-bottom: 3px solid #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #00ffff;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar .nav-links a:hover {
            color: #00ffff;
            text-shadow: 0 0 10px #00ffff;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 200, 0.5);
            backdrop-filter: blur(8px);
            animation: fadeIn 1.5s ease;
            font-size: 20px;
            flex: 1;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 30px;
            color: #a7ffeb;
            text-shadow: 0 0 5px #00ffd5;
        }

        label {
            font-weight: bold;
            margin: 10px 0 5px;
            display: block;
            color: #caffff;
        }

        input, textarea, select {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background: #ffffff15;
            color: white;
            font-size: 18px;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            background: #ffffff25;
        }

        input[type="submit"] {
            background: linear-gradient(135deg, #00e5ff, #00bfa5);
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.4s;
            box-shadow: 0 0 15px #00e5ff;
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, #00c3ff, #1de9b6);
            box-shadow: 0 0 25px #1de9b6, 0 0 35px #00e5ff;
        }

        .popup {
            display: none;
            position: fixed;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #1de9b6;
            color: #000;
            padding: 20px 40px;
            border-radius: 10px;
            font-size: 18px;
            box-shadow: 0 0 20px rgba(255,255,255,0.6);
            z-index: 9999;
            text-align: center;
            animation: popIn 0.6s ease;
        }

        .popup.error {
            background-color: #ff5252;
            color: white;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        @keyframes popIn {
            0% { transform: translate(-50%, -60%) scale(0.8); opacity: 0; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
        }

        .footer {
            background-color: #111;
            padding: 20px;
            text-align: center;
            color: #aaa;
            font-size: 20px;
            border-top: 2px solid #00ffff;
            box-shadow: 0 -2px 15px rgba(0, 255, 255, 0.2);
            margin-top: auto;
        }

        @media (max-width: 640px) {
            .container {
                margin: 20px;
                padding: 25px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">♻️ WasteBusters</div>
    <div class="nav-links">
        <a href="user_dashboard.php">🏠 Dashboard</a>
        <a href="track_details.php">📊 Track Details</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

<?php if ($showSuccess): ?>
    <div class="popup" id="popupSuccess">✅ Collection Submission Successful!</div>
<?php elseif ($showError): ?>
    <div class="popup error" id="popupError">❌ Oops! <?= htmlspecialchars($errorMsg) ?></div>
<?php endif; ?>

<div class="container">
    <h2>✨ Waste Collection Request ✨</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="address">🏡 Address:</label>
        <input type="text" name="address" required>

        <label for="zone">📍 Zone:</label>
        <input type="text" name="zone" required>

        <label for="waste_type">🗑 Waste Type:</label>
        <input type="text" name="waste_type" required>

        <label for="collection_date">📅 Collection Date:</label>
        <input type="date" name="collection_date" required>

        <label for="description">📝 Description:</label>
        <textarea name="description" required></textarea>

        <label for="image">📸 Upload Image:</label>
        <input type="file" name="image">

        <input type="submit" value="✨ Submit ✨">
    </form>
</div>

<script>
    window.onload = function () {
        let successPopup = document.getElementById('popupSuccess');
        let errorPopup = document.getElementById('popupError');

        if (successPopup) {
            successPopup.style.display = 'block';
            setTimeout(() => successPopup.style.display = 'none', 4000);
        }

        if (errorPopup) {
            errorPopup.style.display = 'block';
            setTimeout(() => errorPopup.style.display = 'none', 6000);
        }
    };
</script>

<div class="footer">
    &copy; <?php echo date("Y"); ?> WasteBusters. All rights reserved.
</div>

</body>
</html>
