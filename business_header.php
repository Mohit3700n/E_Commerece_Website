<?php
session_start();
include('db.php');

if (isset($_POST['businessLogout'])) {
    session_unset();
    session_destroy();
    header("location:businessLogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-8">
                    <a href="businessDashboard.php" class="text-gray-700 font-semibold hover:text-blue-600 transition-colors">Home</a>
                    <a href="my_all_product.php" class="text-gray-700 font-semibold hover:text-blue-600 transition-colors">Products</a>
                    <a href="about_us.php" class="text-gray-700 font-semibold hover:text-blue-600 transition-colors">About Us</a>
                    <a href="contact_us.php" class="text-gray-700 font-semibold hover:text-blue-600 transition-colors">Contact Us</a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php
                    $selectStmt = $conn->prepare("SELECT user_img FROM business_user WHERE id=:id");
                    $selectStmt->bindParam(':id', $_SESSION['user_id']);
                    $selectStmt->execute();
                    $profileImg = $selectStmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <a href="profile.php" class="flex items-center space-x-2 text-gray-800 hover:text-blue-600">
                        <img src="<?php echo htmlspecialchars($profileImg['user_img'] ?? 'https://placehold.co/100x100?text=U'); ?>" 
                             alt="Profile" 
                             class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        <span class="font-semibold hidden sm:inline"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></span>
                    </a>
                    
                    <form method="POST" action="">
                        <button type="submit" name="businessLogout" class="bg-red-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>