<?php
session_start();
include('../includes/db.php');


$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">

        <div class="flex items-center">

            <h1 class="text-2xl font-bold">Technova</h1>
        </div>
        <div>
            <a href="add_product.php" class="text-gray-300 hover:text-white px-3 py-2">Add Product</a>
            <a href="../products/index.php" class="text-gray-300 hover:text-white px-3 py-2">View Products</a>
            <a href="manage_users.php" class="text-gray-300 hover:text-white px-3 py-2">Manage Users</a>
            <a href="../auth/userlogin.php" onclick="return confirmLogout();" class="text-red-400 hover:text-red-600 px-3 py-2">Logout</a>
        </div>
    </nav>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you would like to logout?");
        }
    </script>


    <div class="flex">
        <aside class="w-1/4 bg-gray-800 p-4 min-h-screen">
            <div class="flex flex-col items-center">
            <div class="bg-gray-700 rounded-full h-28 w-28 flex items-center justify-center">

                </div>
                <h2 class="text-lg font-bold mt-10">Vishwa De Silva</h2>
                <span class="bg-blue-500 text-white px-8 py-1 rounded-full text-sm">Admin</span>
            </div>

        </aside>
        <main class="w-3/4 p-8">
            <h2 class="text-3xl font-bold mb-4">Manage Products</h2>
            <?php if ($result->num_rows > 0): ?>
                <table class="table-auto w-full bg-gray-800 text-white rounded-md">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="p-4">ID</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Stock</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-700">
                                <td class="p-4"><?= $product['id'] ?></td>
                                <td class="p-4"><?= htmlspecialchars($product['name']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($product['category']) ?></td>
                                <td class="p-4">$<?= htmlspecialchars($product['price']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($product['stock']) ?></td>
                                <td class="p-4">
                                    <a href="edit_product.php?id=<?= $product['id'] ?>" class="text-blue-400 hover:text-blue-600">Edit</a> |
                                    <a href="delete_product.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="text-red-400 hover:text-red-600">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
