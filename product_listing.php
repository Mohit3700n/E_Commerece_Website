<?php
include("db.php");
session_start();
$searchTerm = '';
$sql = "SELECT * FROM products_tables";
$params = [];

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchTerm = trim($_GET['search']);
    $sql .= " WHERE product_name LIKE :search OR product_description LIKE :search";
    $params[':search'] = "%" . $searchTerm . "%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($searchTerm)) {
    shuffle($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50">
    <?php include("customer_header.php"); ?>
    <main class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <section class="my-8">
            <?php if (!empty($searchTerm)): ?>
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Search Results for "<?php echo htmlspecialchars($searchTerm); ?>"</h1>
                    <p class="text-gray-600 mt-2"><?php echo count($result); ?> product(s) found.</p>
                </div>
            <?php else: ?>
                 <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">All Products</h1>
                    <p class="text-gray-600 mt-2">Browse our collection of high-quality items.</p>
                </div>
            <?php endif; ?>
        </section>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php if (empty($result)): ?>
                <div class="col-span-full text-center py-16">
                    <p class="text-lg text-gray-500">No products found matching your search.</p>
                </div>
            <?php else: ?>
                <?php foreach ($result as $row): ?>
                <form action='product_details.php' method='post' class='bg-white rounded-2xl shadow-lg overflow-hidden group transition-shadow duration-300 ease-in-out hover:shadow-2xl flex flex-col'>
                    <div class='relative h-60 w-full overflow-hidden'>
                        <img src='<?php echo htmlspecialchars($row['product_image']); ?>' alt='<?php echo htmlspecialchars($row['product_name']); ?>' class='h-full w-full object-cover group-hover:scale-110 transition-transform duration-500 ease-in-out'>
                    </div>
                    <div class='p-5 flex-grow flex flex-col'>
                        <h3 class='text-lg font-bold text-gray-900 mb-2 truncate'><?php echo htmlspecialchars($row['product_name']); ?></h3>
                        <p class='text-2xl font-extrabold text-gray-800 mb-4'>₹<?php echo number_format($row['product_price']); ?></p>

                        <input type='hidden' name='product_image' value='<?php echo htmlspecialchars($row['product_image']); ?>'>
                        <input type='hidden' name='product_name' value='<?php echo htmlspecialchars($row['product_name']); ?>'>
                        <input type='hidden' name='product_price' value='<?php echo htmlspecialchars($row['product_price']); ?>'>
                        <input type='hidden' name='product_desc' value='<?php echo htmlspecialchars($row['product_description']); ?>'>
                        <input type='hidden' name='owner_of_product_id' value='<?php echo htmlspecialchars($row['owner_of_product_id']); ?>'>
                        <input type='hidden' name='product_id' value='<?php echo htmlspecialchars($row['product_id']); ?>'>

                        <div class='mt-auto pt-4'>
                            <button name='view_details' type='submit' class='w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-all duration-300 flex items-center justify-center space-x-2'>
                                <span>View Details</span>
                                <i class='bi bi-arrow-right-circle'></i>
                            </button>
                        </div>
                    </div>
                </form>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500">
            &copy; <?php echo date("Y"); ?> YourBrand. All Rights Reserved.
        </div>
    </footer>
</body>
</html>

