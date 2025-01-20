<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../includes/db.php'); // Include the database connection
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Check if the database connection exists
    if (!$conn) {
        die("Database connection failed!");
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO products (name, category, price, stock, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $name, $category, $price, $stock, $description);

    if ($stmt->execute()) {
        echo "<p class='text-green-500 text-center'>Product added successfully!</p>";
    } else {
        echo "<p class='text-red-500 text-center'>Error: " . $stmt->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold">Technova</h1>
        </div>
        <a href="dashboard.php" class="text-gray-300 hover:text-white px-3 py-2">Back to Dashboard</a>
    </nav>

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-gray-800 p-4 min-h-screen">
            <div class="flex flex-col items-center">
                <div class="bg-gray-700 rounded-full h-24 w-24 flex items-center justify-center">

                </div>
                <h2 class="text-lg font-bold mt-10">Vishwa De Silva</h2>
                <span class="bg-blue-500 text-white px-8 py-1 rounded-full text-sm">Admin</span>
            </div>

        </aside>

        <!-- Form Section -->
        <main class="w-3/4 p-8">
            <h2 class="text-3xl font-bold mb-4">Add Product</h2>
            <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg space-y-4">
                <div>
                    <label for="name" class="block text-sm font-bold mb-2">Product Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500" placeholder="Product Name" required>
                </div>
                <div>
                    <label for="category" class="block text-sm font-bold mb-2">Category</label>
                    <input type="text" id="category" name="category" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500" placeholder="Category" required>
                </div>
                <div>
                    <label for="price" class="block text-sm font-bold mb-2">Price</label>
                    <input type="number" id="price" name="price" step="0.01" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500" placeholder="Price" required>
                </div>
                <div>
                    <label for="stock" class="block text-sm font-bold mb-2">Stock</label>
                    <input type="number" id="stock" name="stock" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500" placeholder="Stock" required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-bold mb-2">Description</label>
                    <textarea id="description" name="description" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500" placeholder="Description"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg">Add Product</button>
            </form>
        </main>
    </div>
</body>
</html>
