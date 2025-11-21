<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalGo - All Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                gray: { 100: '#f1f3f6', 200: '#e2e8f0', 800: '#1f2937' },
                brand: {
                  green: '#04472f', // LocalGo Green
                  orange: '#ea580c', // LocalGo Orange
                  'orange-dark': '#c2410c',
                }
              }
            }
          }
        }
      </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            
            background-image: url(images/back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
         }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <?php include("customer_header.php");?>

    <?php
    $stmt = $conn->prepare("SELECT * FROM products_tables");
    $stmt->execute();
    $all_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    shuffle($all_products);
    // Group products by Category
    $grouped_products = [];
    foreach ($all_products as $row) {
        // Fallback to 'General' if no category column exists
        $cat = $row['product_category'] ?? 'All Products'; 
        $grouped_products[$cat][] = $row;
    }
    ?>

    <main class="container mx-auto px-2 sm:px-4 py-6 space-y-8">

        <?php foreach ($grouped_products as $category_name => $products): ?>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div>
                        <h2 class="text-2xl font-bold text-brand-green flex items-center gap-2">
                            <?php echo htmlspecialchars($category_name); ?>
                            <span class="text-sm font-normal text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">
                                <?php echo count($products); ?> Items
                            </span>
                        </h2>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-0 divide-x divide-y divide-gray-100">
                    
                    <?php foreach ($products as $row): ?>
                        <form action="product_details.php" method="post" class="group relative bg-white p-4 hover:shadow-[0_0_15px_rgba(0,0,0,0.1)] hover:z-10 transition-all duration-300 flex flex-col">
                            
                            <div class="relative h-48 w-full mb-4 flex items-center justify-center p-2">
                                <img src="<?php echo htmlspecialchars($row['product_image']); ?>" 
                                     alt="<?php echo htmlspecialchars($row['product_name']); ?>" 
                                     class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500">
                            </div>

                            <div class="mt-auto">
                                <h3 class="text-sm font-medium text-gray-700 hover:text-brand-orange transition-colors line-clamp-2 mb-2 h-10" title="<?php echo htmlspecialchars($row['product_name']); ?>">
                                    <?php echo htmlspecialchars($row['product_name']); ?>
                                </h3>
                                
                                <div class="flex flex-col mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-bold text-brand-orange">₹<?php echo number_format($row['product_price']); ?></span>
                                        <span class="text-xs text-gray-400 line-through">₹<?php echo number_format($row['product_price'] * 1.15); ?></span>
                                    </div>
                                    <span class="text-[10px] text-green-600 font-bold">Free Delivery</span>
                                </div>

                                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['product_image']); ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>">
                                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['product_price']); ?>">
                                <input type="hidden" name="product_desc" value="<?php echo htmlspecialchars($row['product_description']); ?>">
                                <input type="hidden" name="owner_of_product_id" value="<?php echo htmlspecialchars($row['owner_of_product_id']); ?>">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">

                                <button name="view_details" type="submit" class="w-full bg-white border border-gray-200 text-gray-700 text-sm font-semibold py-2 rounded hover:bg-brand-orange hover:border-brand-orange hover:text-white transition-colors duration-200">
                                    View Details
                                </button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        <?php endforeach; ?>

    </main>
    
    <footer class="bg-brand-green mt-12 py-8">
        <div class="container mx-auto px-6 text-center text-white/80">
            <p>&copy; 2025 LocalGo. Empowering Local Sellers.</p>
        </div>
    </footer>

    <expertise-ai client="4fdfd765-2cf4-49ae-a954-d31172cef9ac"></expertise-ai><script src="https://cdn.expertise.ai/genweb/ai-genweb.js" defer></script>
</body>
</html>