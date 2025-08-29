<?php
include("db.php");
include('business_header.php');
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create_product"])){
    $name =  $_POST["product_name"];
    $price =  $_POST["product_price"];
    $desc =  $_POST["product_desc"];
    $stock =  $_POST["product_stock"];
    $category_name =  $_POST["category_name"];
    $user_id = $_SESSION["user_id"];

    $img_name = $_FILES["product_img"]["name"];
    $tmp_name = $_FILES["product_img"]["tmp_name"];
    $upload_path = "images/".basename($img_name);

    if(move_uploaded_file($tmp_name, $upload_path)){

    $query = "INSERT INTO products_tables (product_name,product_price,product_image,stock,owner_of_product_id,product_description,category_name) values (:name,:price,:img,:stock,:owner,:desc,:category_name)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':price',$price);
    $stmt->bindParam(':img',$upload_path);
    $stmt->bindParam(':stock',$stock);
    $stmt->bindParam(':owner',$user_id);
    $stmt->bindParam(':desc',$desc);
    $stmt->bindParam(':category_name',$category_name);
    $stmt->execute();

    header("Location:businessDashboard.php");

    }else{
        echo "Failed to upload image";
    }
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom style for file input */
        input[type="file"]::file-selector-button {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8 max-w-2xl">
        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <header class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Add a New Product</h1>
                <p class="text-gray-500 mt-2">Fill in the details below to list a new item.</p>
            </header>
            
            <form method="post" enctype="multipart/form-data">
                <div class="space-y-6">
                    <!-- Product Name -->
                    <div>
                        <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                        <input id="product_name" type="text" name="product_name" placeholder="e.g., Wireless Gaming Mouse" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Price and Stock -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="product_price" class="block text-sm font-medium text-gray-700 mb-1">Price (₹)</label>
                            <input id="product_price" type="number" name="product_price" placeholder="e.g., 2500" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                           <label for="product_stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                           <input id="product_stock" type="number" name="product_stock" placeholder="e.g., 50" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div>
                        <label for="product_desc" class="block text-sm font-medium text-gray-700 mb-1">Product Description</label>
                        <textarea id="product_desc" name="product_desc" rows="4" placeholder="Describe the product's features, materials, etc." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select id="category_name" name="category_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="" disabled selected>Select a category</option>
                            <?php
                            // --- THIS IS YOUR EXISTING PHP LOGIC - UNCHANGED ---
                            $query = "SELECT * FROM businesscategory";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $row){
                                echo "<option value='".htmlspecialchars($row['category'])."'>".ucfirst(htmlspecialchars($row['category']))."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label for="product_img" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                        <input id="product_img" type="file" name="product_img" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button name="create_product" type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>