<?php
include("db.php");
include("customer_header.php");
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['view_details'])){
        $productImg = $_POST['product_image'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productDesc = $_POST['product_desc'];
        $owner_of_product_id = $_POST['owner_of_product_id'];
        $product_id = $_POST['product_id'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid mt-5 px-5">
    <div class="p-5 w-100">
        <div class="row g-5 align-items-center">
            
            <div class="col-md-5 text-center">
                <img src="<?php echo $productImg; ?>" 
                     alt="Product Image" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height:400px;">
            </div>

            <div class="col-md-7">
                <h1 class="fw-bold mb-3"><?php echo $productName; ?></h1>
                <h3 class="text-success mb-4">₹ <?php echo $productPrice; ?> /-</h3>
                <p class="text-muted fs-5">
                    <?php echo $productDesc ?>
                </p>
                <?php 
                    $checkQnty = $conn->prepare("SELECT stock FROM products_tables WHERE product_id = :id");
                    $checkQnty->execute(["id" => $product_id]);
                    $qntyResult = $checkQnty->fetch(PDO::FETCH_ASSOC);
                    $availableStock = $qntyResult ? $qntyResult['stock'] : 0;
                ?>
                <p>Available quantity : <?=$availableStock?> </p>

                <form action="place_order.php" method="post" class="mt-4">
                    <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $productImg; ?>">
                    <input type="hidden" name="owner_of_product_id" value="<?php echo $owner_of_product_id; ?>">
                    <input type="hidden" name="availableStock" value="<?php echo $availableStock; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" 
                                   name="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="<?php echo $availableStock; ?>"
                                   class="form-control form-control-lg" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Delivery Address</label>
                        <textarea name="address" 
                                  rows="3" 
                                  class="form-control form-control-lg" 
                                  placeholder="Enter your delivery address" 
                                  required></textarea>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            Place Order
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary btn-lg px-5">
                            Back to Products
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>