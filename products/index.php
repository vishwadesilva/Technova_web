<?php
include('../includes/db.php');


$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technova2 - Product Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold">Technova</h1>
        </div>
        <div class="flex space-x-4">
            <a href="../auth/userlogin.php" onclick="return confirmLogout();" class="text-red-400 hover:text-red-600">Log out</a>
        </div>
    </nav>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you would like to logout?");
        }
    </script>


    <main class="p-8">
        <h2 class="text-3xl font-bold mb-4 text-center">Browse Through Our PC Components!</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 overflow-y-scroll h-[80vh]">
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                        <div class="h-48 w-full bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="h-full w-full object-cover rounded-md">
                            <?php else: ?>
                                <span class="text-gray-400 text-sm">Image Not Available</span>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="text-gray-300"><strong>Category:</strong> <?= htmlspecialchars($product['category']) ?></p>
                        <p class="text-gray-300"><strong>Price:</strong> $<?= htmlspecialchars($product['price']) ?></p>
                        <p class="text-gray-300"><strong>Stock:</strong> <?= htmlspecialchars($product['stock']) ?></p>
                        <p class="text-gray-400 mt-2 text-sm"><?= htmlspecialchars($product['description']) ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No products available.</p>
            <div class="text-center mt-4">
                <a href="../index.php" class="text-blue-500 hover:text-blue-600">Back to Homepage</a> | 
                <a href="../admin/dashboard.php" class="text-blue-500 hover:text-blue-600">Admin Dashboard</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
