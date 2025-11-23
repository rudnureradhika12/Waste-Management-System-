<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Service Request Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleForm(formId) {
      document.getElementById('waste-form').classList.remove('hidden');
      document.getElementById(formId).classList.add('hidden');
    }
  </script>
</head>
<body class="min-h-screen bg-cover bg-center" style="background-image: url('https://thumbs.dreamstime.com/b/d-cute-earth-cartoon-character-world-environment-day-save-planet-energy-eco-friendly-rendering-285776068.jpg');">
  
  <!-- Navbar -->
  <nav class="w-full bg-gradient-to-r from-green-700 to-green-500 text-white py-4 px-6 flex justify-between items-center shadow-lg">
    <h1 class="text-2xl font-bold">Industrial Recycling</h1>
    <ul class="flex space-x-6 text-lg">
      <li><a href="admin_dashboard.php" class="hover:text-yellow-200">Dashboard</a></li>
      <li><a href="municipal.php" class="hover:text-yellow-200">Municipal Corporation</a></li>
      <li><a href="recycling.php" class="hover:text-yellow-200">Industry Recycling</a></li>
      <li><a href="pest_control.php" class="hover:text-yellow-200">Pest Control</a></li>
      <li><a href="logout.php" class="hover:text-red">Logout</a></li>
    </ul>
  </nav>

  <div class="bg-black bg-opacity-70 min-h-screen flex flex-col items-center justify-start px-4 py-10 space-y-8">
    
    <h1 class="text-white text-4xl font-bold mb-4">Service Request Portal</h1>

    <!-- Toggle Buttons -->
    <div class="flex space-x-4 mb-6">
      <button id="waste-btn" onclick="toggleForm('waste-form')" class="bg-green-600 px-6 py-2 rounded-lg text-white font-semibold">Waste Pickup</button>
    </div>

    <!-- "Back to Home" Button -->
    <div class="back-btn" style="color:white;">
      <a href="admin_dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg">⬅ Back to Home</a>
    </div>

    <!-- Waste Pickup Form -->
    <div id="waste-form" class="bg-white bg-opacity-10 backdrop-blur-md p-8 rounded-2xl max-w-2xl w-full shadow-lg text-white">
      <h2 class="text-2xl font-bold text-center mb-6">Schedule Waste Pickup for Recycling</h2>
      <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="name" placeholder="Your Name" required class="input">
        <input type="tel" name="mobile" placeholder="Mobile Number (10 digits)" pattern="[0-9]{10}" required class="input">
        <input type="email" name="email" placeholder="Email Address" class="input">
        <input type="text" name="location" placeholder="Pickup Location" required class="input">

        <select name="waste_type" required class="input">
          <option value="">-- Select Waste Type --</option>
          <option>Plastic</option>
          <option>Paper</option>
          <option>E-Waste</option>
          <option>Organic</option>
          <option>Metal</option>
          <option>Other</option>
        </select>

        <input type="text" name="quantity" placeholder="Estimated Quantity (kg)" required class="input">
        <input type="date" name="pickup_date" required class="input">
        <input type="time" name="pickup_time" required class="input">
        <textarea name="comments" placeholder="Any instructions or notes..." class="input"></textarea>
        <input type="file" name="image" accept="image/*" class="input text-white">

        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 py-3 rounded-xl text-white font-semibold">Submit Pickup Request</button>
      </form>
    </div>

  </div>

  <style>
    .input {
      width: 100%;
      padding: 12px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      backdrop-filter: blur(4px);
      border: none;
      color: white;
      font-size: 1rem;
      outline: none;
    }

    .input::placeholder {
      color: white;
      opacity: 0.8;
    }
  </style>
  <footer class="bg-green-700 text-white py-4 text-center">
    &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
  </footer>
</body>
</html>
