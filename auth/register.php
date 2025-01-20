<?php
include('../includes/db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 


    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='userlogin.php'>Log in</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex-shrink-0 flex items-center">
                <a href="index.php" class="text-white text-2xl font-bold flex items-center">
                    Technova
                 </a>
                </div>
                <div class="hidden md:flex space-x-4 items-center">
                    <a href="userlogin.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Log In</a>
                    <a href="register.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Sign Up</a>
                </div>
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden bg-gray-800">
            <a href="userlogin.php" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">Log In</a>
            <a href="register.php" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">Sign Up</a>
        </div>
    </nav>


    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="max-w-lg w-full bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-bold text-center mb-6">Register</h1>
            <form method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Full Name" class="w-full p-3 rounded-md bg-gray-700 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="w-full p-3 rounded-md bg-gray-700 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="w-full p-3 rounded-md bg-gray-700 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-3 rounded-md font-semibold transition">Register</button>
            </form>
            <div class="mt-4 text-center">
                <a href="userlogin.php" class="text-sm text-blue-400 hover:underline">Already have an account? Log in</a>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>