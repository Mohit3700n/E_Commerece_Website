<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <?php  include("customer_header.php");?>
    <main class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-8">

            <?php
            $stmt = $conn->prepare("SELECT * FROM products_tables");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            shuffle($result);
            foreach ($result as $row) {
                echo "
                <form action='product_details.php' method='post' class='bg-white rounded-2xl shadow-lg overflow-hidden group transition-shadow duration-300 ease-in-out hover:shadow-2xl flex flex-col'>
                    <div class='relative h-60 w-full overflow-hidden'>
                        <img src='" . htmlspecialchars($row['product_image']) . "' alt='" . htmlspecialchars($row['product_name']) . "' class='h-full w-full object-cover group-hover:scale-110 transition-transform duration-500 ease-in-out'>
                    </div>
                    <div class='p-5 flex-grow flex flex-col'>
                        <h3 class='text-lg font-bold text-gray-900 mb-2 truncate'>" . htmlspecialchars($row['product_name']) . "</h3>
                        <p class='text-2xl font-extrabold text-gray-800 mb-4'>₹" . number_format($row['product_price']) . "</p>

                        <input type='hidden' name='product_image' value='" . htmlspecialchars($row['product_image']) . "'>
                        <input type='hidden' name='product_name' value='" . htmlspecialchars($row['product_name']) . "'>
                        <input type='hidden' name='product_price' value='" . htmlspecialchars($row['product_price']) . "'>
                        <input type='hidden' name='product_desc' value='" . htmlspecialchars($row['product_description']) . "'>
                        <input type='hidden' name='owner_of_product_id' value='" . htmlspecialchars($row['owner_of_product_id']) . "'>
                        <input type='hidden' name='product_id' value='" . htmlspecialchars($row['product_id']) . "'>

                        <div class='mt-auto pt-4'>
                            <button name='view_details' type='submit' class='w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-all duration-300 flex items-center justify-center space-x-2'>
                                <span>View Details</span>
                                <i class='bi bi-arrow-right-circle'></i>
                            </button>
                        </div>
                    </div>
                </form>";
            }
            ?>

        </div>
    </main>
    
    <!-- Footer Placeholder -->
    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500">
            &copy; 2025 YourBrand. All Rights Reserved.
        </div>
    </footer>

</body>
</html>