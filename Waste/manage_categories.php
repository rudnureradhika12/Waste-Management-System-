<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "garbage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission to add a new category
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    
    $stmt = $conn->prepare("INSERT INTO waste_categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Category added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error adding category: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Handling deletion of a category
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    
    $stmt = $conn->prepare("DELETE FROM waste_categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Category deleted successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error deleting category: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Handling form submission to update an existing category
if (isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    
    $stmt = $conn->prepare("UPDATE waste_categories SET category_name = ? WHERE id = ?");
    $stmt->bind_param("si", $category_name, $category_id);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Category updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error updating category: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch all waste categories
$sql = "SELECT * FROM waste_categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Waste Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #da190b;
        }
        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 75%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Manage Waste Categories</h2>

        <!-- Form to add a new category -->
        <div class="form-container">
            <form method="POST">
                <input type="text" name="category_name" placeholder="Enter waste category name" required>
                <button type="submit" name="add_category" class="btn">Add Category</button>
            </form>
        </div>

        <!-- Displaying all categories -->
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['category_name'] . "</td>
                                <td>
                                    <a href='manage_categories.php?edit=" . $row['id'] . "' class='btn'>Edit</a>
                                    <a href='manage_categories.php?delete=" . $row['id'] . "' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No categories found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
