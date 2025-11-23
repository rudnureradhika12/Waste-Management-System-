<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Selection</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional external file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
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

        /* Main Background and Content */
        .main {
            flex: 1;
            background: url('assets/images/login_admin.jpg') no-repeat center center/cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            text-align: center;
        }

        .overlay h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #FFD700;
        }

        .overlay p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .buttons {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .btn {
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            transition: all 0.3s ease;
        }

        .user-btn {
            background: linear-gradient(90deg, #1e90ff, #00bfff);
            color: white;
        }

        .user-btn:hover {
            background: linear-gradient(90deg, #1e80e5, #009ad6);
        }

        .admin-btn {
            background: linear-gradient(90deg, #ff4500, #ff6347);
            color: white;
        }

        .admin-btn:hover {
            background: linear-gradient(90deg, #e44000, #d94f3a);
        }

        @media (max-width: 768px) {
            .overlay h1 {
                font-size: 2.5rem;
            }

            .overlay p {
                font-size: 1rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 10px 20px;
            }

            .buttons {
                flex-direction: column;
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

    <!-- Main Background with Overlay -->
    <div class="main">
        <div class="overlay">
            <h1>Welcome to Our Portal</h1>
            <p>Select your role to continue:</p>
            <div class="buttons">
                <a href="user_login.php" class="btn user-btn">User</a>
                <a href="adlogin.php" class="btn admin-btn">Admin</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; <?= date("Y") ?> WasteBusters. All rights reserved.
    </div>

</body>
</html>
