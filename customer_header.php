<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("db.php");

function handle_logout() {
    if(isset($_GET["logout"])){
        session_unset();
        session_destroy();
        header("Location: " . strtok($_SERVER["PHP_SELF"], '?'));
        exit();
    }
}
handle_logout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Header</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>

<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                
                <a href="index.php" class="text-2xl font-bold text-gray-800"><img src="images/logo.png" width="90px" alt="Logo"></a>
            </div>

            <div class="hidden md:flex md:items-center md:mx-auto md:space-x-8">
                <a href="index.php" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Home</a>
                <a href="index.php" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Products</a>
                <a href="about_us_customer.php" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">About Us</a>
                <a href="contact_us_customer.php" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Contact Us</a>
            </div>

            <div class="flex items-center space-x-5">
                <form action="product_listing.php" method="GET" class="relative hidden md:block">
                    <input type="text" name="search" placeholder="Search products..." class="w-full pl-4 pr-10 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <a href="my_orders.php" class="text-gray-500 hover:text-blue-600 transition-colors">
                    <i class="bi bi-cart-fill text-xl"></i>
                    <span class="sr-only">My Orders</span>
                </a>
                
                <div class="hidden md:block border-l border-gray-200 h-6 mx-2"></div>

                <div class="hidden md:block">
                    <?php
                    if(isset($_SESSION["customer_id"])){
                        echo "<div class='flex items-center space-x-2'>";
                        echo "<span class='font-medium text-gray-700'>Hi, ".htmlspecialchars($_SESSION['customer_name'])."</span>";
                        echo "<a href='?logout' class='bg-red-500 text-white text-sm font-bold py-1.5 px-3 rounded-md hover:bg-red-600 transition-colors'>Logout</a>";
                        echo "</div>";
                    } else {
                        echo "<a href='customerLogin.php' class='bg-blue-600 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-blue-700 transition-colors'>Login</a>";
                    }
                    ?>
                </div>
            </div>

            <div class="md:hidden">
            </div>
        </div>
    </nav>
</header>

</body>
</html>