<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Learn AI Skills</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #1c1c1c, #3a3a3a);
      color: #fff;
    }

    .navbar {
      display: flex;
      justify-content: flex-end;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 15px 30px;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar a {
      color: #fff;
      text-decoration: none;
      margin-left: 20px;
      font-weight: bold;
      transition: color 0.3s;
    }

    .navbar a:hover {
      color: #00f7ff;
    }

    .logout {
      background-color: #f44336;
      padding: 10px 15px;
      border-radius: 5px;
    }

    .header {
      text-align: center;
      padding: 60px 20px 30px;
    }

    .header h1 {
      font-size: 36px;
      color: #00f7ff;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      padding: 20px;
    }

    .section {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 30px;
      margin-bottom: 25px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .section h2 {
      color: #FFD700;
      margin-bottom: 15px;
    }

    .section p {
      color: #ddd;
      line-height: 1.6;
    }

    .back-btn {
      display: inline-block;
      margin: 30px 0;
      padding: 12px 25px;
      background-color: #00f7ff;
      color: #000;
      border: none;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .back-btn:hover {
      background-color: #00c8d1;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-end;
      }

      .header h1 {
        font-size: 28px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <a href="dashboard.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php" class="logout">Logout</a>
  </div>

  <!-- Header -->
  <div class="header">
    <h1>How to Learn AI Skills</h1>
    <p>Master artificial intelligence step-by-step with confidence!</p>
  </div>

  <!-- Content -->
  <div class="container">

    <div class="section">
      <h2>1. Start with the Basics</h2>
      <p>Begin with fundamental concepts like statistics, linear algebra, and Python programming. Use platforms like Khan Academy, Coursera, and freeCodeCamp.</p>
    </div>

    <div class="section">
      <h2>2. Learn Machine Learning</h2>
      <p>Explore machine learning techniques using tools like scikit-learn, TensorFlow, and PyTorch. Take beginner-friendly courses from Andrew Ng on Coursera or Google’s ML Crash Course.</p>
    </div>

    <div class="section">
      <h2>3. Dive into Deep Learning</h2>
      <p>Understand neural networks, CNNs, RNNs, and transformers. Projects and papers help solidify concepts. Try platforms like DeepLearning.AI or Hugging Face tutorials.</p>
    </div>

    <div class="section">
      <h2>4. Build Projects</h2>
      <p>Create real-world projects like chatbots, image classifiers, or recommendation systems. Use GitHub to track and share progress. Learn by doing!</p>
    </div>

    <div class="section">
      <h2>5. Stay Updated & Join Communities</h2>
      <p>Follow AI newsletters, attend webinars, and contribute to open-source. Join communities like Reddit ML, Kaggle, or Discord groups for collaboration and support.</p>
    </div>

    <!-- Back Button -->
    <a href="dashboard.php" class="back-btn">← Go Back</a>

  </div>

</body>
</html>
