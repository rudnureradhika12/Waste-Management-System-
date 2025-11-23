<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pest Control in Waste Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      transition: padding-top 0.3s ease;
    }
  </style>
</head>
<body class="bg-cover bg-center text-white" style="background-image: url('https://images.unsplash.com/photo-1611612447039-3f485bc54ec1');">

  <!-- Navbar -->
  <nav id="navbar" class="bg-black bg-opacity-80 text-white px-6 py-4 top-0 left-0 right-0 z-50">
    <div class="flex items-center justify-between">
      <a href="#" class="text-2xl font-bold">Pest Controlling</a>
      <button id="menu-toggle" class="md:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <ul id="menu" class="hidden md:flex space-x-6 mt-4 md:mt-0 md:space-x-8 text-lg font-medium">
        <li><a href="admin_dashboard.php" class="hover:text-green-400">Dashboard</a></li>
        <li><a href="municipal.php" class="hover:text-green-400">Municipal Corporation</a></li>
        <li><a href="recycling.php" class="hover:text-green-400">Industry Recycling</a></li>
        <li><a href="pest_control.php" class="hover:text-green-400">Pest Control</a></li>
        <li><a href="logout.php" class="hover:text-red-800">Logout</a></li>
      </ul>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden mt-4">
      <ul class="space-y-2 text-lg">
        <li><a href="admin_dashboard.php" class="hover:text-green-400">Dashboard</a></li>
        <li><a href="municipal.php" class="hover:text-green-400">Municipal Corporation</a></li>
        <li><a href="recycling.php" class="hover:text-green-400">Industry Recycling</a></li>
        <li><a href="pest_control.php" class="hover:text-green-400">Pest Control</a></li>
        <li><a href="logout.php" class="hover:text-red-800">Logout</a></li>
      </ul>
    </div>
  </nav>

  <!-- Pest Control Content -->
  <div class="bg-black bg-opacity-60 px-4 py-8">
    <div class="max-w-6xl mx-auto text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-6">Pest Control in Waste Management</h1>
      <br>
      <div class="mb-4">
        <a href="admin_dashboard.php" class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-xl text-white font-semibold shadow-lg transition duration-300 ease-in-out transform hover:scale-105 focus:ring-4 focus:ring-blue-300">⬅ Back to Home</a>
      </div>
      <br>
      <!-- Content Section -->

      <!-- Section with Irregular Blob Shape and Flex Layout -->
      <div class="flex flex-col md:flex-row items-center justify-center px-6 py-12 gap-8">
        <!-- Irregular Text Container -->
        <div class="relative bg-gradient-to-br from-green-400 via-blue-500 to-purple-500 text-white p-8 rounded-3xl shadow-2xl md:w-1/2 w-full"
            style="clip-path: polygon(20% 0%, 80% 0%, 100% 20%, 100% 80%, 80% 100%, 20% 100%, 0% 80%, 0% 20%); backdrop-filter: blur(8px);">
          <p class="text-lg font-medium leading-relaxed">
            Proper pest control ensures hygiene, prevents disease spread, and supports safe waste processing. Below are some common pest control types used in waste management.
          </p>
        </div>

        <!-- Fun Cartoon Image -->
        <div class="md:w-1/2 w-full flex justify-center">
          <img src="https://th.bing.com/th/id/OIP.Ee65D2M6PJAUIrjUYY3TAAHaFN?rs=1&pid=ImgDetMain"
               alt="Pest Control Illustration"
               class="w-80 h-auto rounded-xl shadow-xl transform hover:scale-105 transition duration-300 ease-in-out">
        </div>
      </div>

      <!-- <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Rodent Control</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Spraying insecticides near bins and dumps to kill flies, cockroaches, and mosquitoes.</p>
            </div>

            <div class="flex-1 p-6">
              <img src="https://www.catalystpest.com/wp-content/uploads/2022/11/pest_man.png" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div> -->

      <!-- Adding the irregular shape using clip-path -->
      <style>
        .bg-clip-text {
          clip-path: polygon(0 10%, 100% 0, 100% 90%, 0 100%);
          line-height: 1.8;
        }
      </style>

       <!--<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        Cards 
        <div class="bg-white bg-opacity-10 backdrop-blur-md p-4 rounded-2xl shadow-lg hover:scale-105 transition">
          <img src="https://www.catalystpest.com/wp-content/uploads/2022/11/pest_man.png" alt="Rodent Control" class="w-full h-48 object-cover rounded-xl mb-4"/>
          <h2 class="text-xl font-semibold">Rodent Control</h2>
          <p class="text-sm mt-2">Use of traps, poison baits, and rodent-proof bins to prevent rats/mice.</p>
        </div> -->
        <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            <!-- Irregular Shape Text Section -->
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Rodent Control</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Spraying insecticides near bins and dumps to kill flies, cockroaches, and mosquitoes.</p>
            </div>

            <!-- Image Section -->
            <div class="flex-1 p-6">
              <img src="https://www.catalystpest.com/wp-content/uploads/2022/11/pest_man.png" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            <!-- Irregular Shape Text Section -->
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Insecticide Spraying</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Spraying insecticides near bins and dumps to kill flies, cockroaches, and mosquitoes.</p>
            </div>

            <!-- Image Section -->
            <div class="flex-1 p-6">
              <img src="https://th.bing.com/th/id/OIP.t6F3DlVjlMG5I2niIEp7pAHaE8?rs=1&pid=ImgDetMain" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            <!-- Irregular Shape Text Section -->
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Biological Control</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Use of natural predators or organic repellents to control pest population safely.</p>
            </div>

            <!-- Image Section -->
            <div class="flex-1 p-6">
              <img src="https://img.freepik.com/premium-vector/biological-control-plant-disease-isolated-cartoon-vector-illustrations_107173-79511.jpg" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            <!-- Irregular Shape Text Section -->
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Larvicide Treatment</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Used to eliminate mosquito larvae in water stagnation around waste areas.</p>
            </div>

            <!-- Image Section -->
            <div class="flex-1 p-6">
              <img src="https://demirapest.com/wp-content/uploads/2021/01/Larvicide-Treatment.jpg" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            <!-- Irregular Shape Text Section -->
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Fogging</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Fogging machines are used in garbage zones to control mosquitoes and insects.</p>
            </div>

            <!-- Image Section -->
            <div class="flex-1 p-6">
              <img src="https://cdn.vectorstock.com/i/1000v/31/91/disinfectants-fogging-vector-30423191.jpg" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-center py-12 px-6">
        <div class="bg-black bg-opacity-60 text-white p-8 rounded-2xl backdrop-blur-md max-w-4xl w-full">
          <div class="flex items-center justify-between flex-wrap">
            <!-- Irregular Shape Text Section -->
            <div class="flex-1 p-6">
            <h2 class="text-xl font-semibold">Organic Repellents</h2>
              <p class="text-lg mb-10 max-w-xl mx-auto bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
              Eco-friendly options like neem oil and garlic sprays to repel pests without chemicals.</p>
            </div>

            <!-- Image Section -->
            <div class="flex-1 p-6">
              <img src="https://media.istockphoto.com/vectors/organic-foods-waste-isolated-on-white-background-organic-waste-and-vector-id1222899897?k=6&m=1222899897&s=170667a&w=0&h=won022BAFBxLqUXp23Xs--r_bgyfIObdZIjFzuTSd6k=" alt="Pest Control" class="w-full h-64 object-cover rounded-2xl shadow-lg"/>
            </div>
          </div>
        </div>
      </div>
      
      </div>
    </div>
  </div>

  <!-- Pest Control Request Form -->
  <div class="bg-black bg-opacity-60 min-h-screen flex items-center justify-center px-4 py-16">
    <div class="bg-white bg-opacity-10 backdrop-blur-md p-8 rounded-2xl max-w-2xl w-full shadow-lg">
      <h2 class="text-3xl font-bold text-center mb-6">Pest Control Request Form</h2>

      <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block mb-2 font-semibold">Type of Pest Control</label>
          <select name="pest_type" class="w-full p-3 rounded-lg bg-white bg-opacity-20 backdrop-blur-sm text-black">
            <option>Rodent Control</option>
            <option>Insecticide Spraying</option>
            <option>Biological Control</option>
            <option>Larvicide Treatment</option>
            <option>Fogging</option>
            <option>Organic Repellents</option>
          </select>
        </div>

        <div>
          <label class="block mb-2 font-semibold">Location / Address</label>
          <input type="text" name="location" placeholder="Enter location or address"
            class="w-full p-3 rounded-lg bg-white bg-opacity-20 backdrop-blur-sm text-white placeholder-white">
        </div>

        <div>
          <label class="block mb-2 font-semibold">Upload Image</label>
          <input type="file" name="image" accept="image/*"
            class="w-full p-2 rounded-lg bg-white bg-opacity-20 backdrop-blur-sm text-white file:text-white file:bg-gray-700 file:border-none file:rounded-lg file:p-2">
        </div>

        <div>
          <label class="block mb-2 font-semibold">Further Details</label>
          <textarea name="details" rows="4" placeholder="Provide any other information..."
            class="w-full p-3 rounded-lg bg-white bg-opacity-20 backdrop-blur-sm text-white placeholder-white"></textarea>
        </div>

        <div class="text-center">
          <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-3 rounded-xl text-white font-semibold transition">
            Submit Request
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-black bg-opacity-80 text-white text-center py-4 text-sm">
    &copy; <?php echo date('Y'); ?> Waste Management System. All Rights Reserved.
  </footer>

  <!-- Scripts
