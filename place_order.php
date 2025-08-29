<?php
include("db.php");
session_start();

if(isset($_SESSION['customer_id'])){
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $productName  = htmlspecialchars($_POST['product_name']);
    $productPrice = filter_var($_POST['product_price'], FILTER_VALIDATE_FLOAT);
    $productImg   = $_POST['product_image'];
    $quantity     = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
    $address      = htmlspecialchars($_POST['address']);
    $product_owner = htmlspecialchars($_POST['owner_of_product_id']);
    $customer_id = $_SESSION['customer_id'];
    $availableStock = $_POST['availableStock'];
    $remainingStock = $availableStock - $quantity;
    $product_id = $_POST['product_id'];
    $status = "processing";
    $customer_name = $_SESSION['customer_name'];
    

    if ($productPrice !== false && $quantity !== false) {
        $totalPrice = $productPrice * $quantity;

        $updateQty = $conn->prepare("UPDATE products_tables SET stock=:stock WHERE owner_of_product_id = :owner_id AND product_id=:product_id");
        $updateQty->execute(["stock" => $remainingStock, "owner_id" => $product_owner, "product_id" => $product_id]);

        $stmt = $conn->prepare("INSERT INTO customer_orders (product_name, product_price, product_image, quantity, total_price, address, product_owner_id, customer_id, status, customer_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$productName, $productPrice, $productImg, $quantity, $totalPrice, $address, $product_owner, $customer_id, $status, $customer_name]);
    } else {
        $productName = 'Invalid Data Submitted';
        $totalPrice = 0;
    }
}

}else{
    header("Location:customerLogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }
        .order-success-container {
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center order-success-container">
        <div class="card shadow-lg p-4 p-md-5 text-center" style="max-width:600px; border-radius:20px; border: none;">
    
            <div class="mb-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size:4rem;"></i>
            </div>

            <h1 class="fw-bold text-success mb-3">Order Placed!</h1>
            <p class="text-muted fs-5 mb-4">
                Thank you for your purchase. Your order details are below:
            </p>

            <div class="border rounded-3 p-4 mb-4 text-start bg-light">
                <div class="d-flex align-items-center mb-3">
                    <img src="<?php echo $productImg; ?>" 
                         alt="Product Image" 
                         onerror="this.onerror=null;this.src='https://placehold.co/100x100/e2e8f0/64748b?text=Image';"
                         class="img-fluid rounded me-3 shadow-sm" 
                         style="width:100px; height:100px; object-fit:cover;">
                    <div>
                        <h5 class="fw-bold mb-1"><?php echo $productName; ?></h5>
                        <p class="text-muted mb-1">Price: ₹<?php echo number_format($productPrice); ?></p>
                        <p class="text-muted mb-1">Quantity: <?php echo $quantity; ?></p>
                        <p class="fw-semibold text-dark mb-0">Total: ₹<?php echo number_format($totalPrice); ?></p>
                    </div>
                </div>
                <hr>
                <p class="mb-0"><strong>Delivery Address:</strong><br><?php echo nl2br(htmlspecialchars($address)); ?></p>
            </div>

            <div class="d-grid gap-3 d-sm-flex justify-content-center">
                <a href="index.php" class="btn btn-success btn-lg px-5">Back to Shop</a>
                <a href="my_orders.php" class="btn btn-outline-secondary btn-lg px-5">View My Orders</a>
            </div>
        </div>
    </div>

</body>
</html>