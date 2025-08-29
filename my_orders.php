<?php
session_start();
include("db.php");
include("customer_header.php");
$orders = [];

if(isset($_SESSION['customer_id'])){
    $customer_id = $_SESSION['customer_id'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
        $orderIdToCancel = $_POST['order_id'];
        $stmt = $conn->prepare("UPDATE customer_orders SET status = 'Cancelled' WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderIdToCancel]);
        $message = "Order #".str_pad($orderIdToCancel, 6, '0', STR_PAD_LEFT)." has been successfully cancelled.";
    }

try {
    $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE customer_id = :id ORDER BY order_date DESC");
    $stmt->execute(["id" => $customer_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}


}
function getStatusBadgeClass($status) {
    switch (strtolower($status)) {
        case 'processing':
            return 'bg-warning text-dark';
        case 'shipped':
            return 'bg-info text-dark';
        case 'delivered':
            return 'bg-success';
        case 'cancelled':
            return 'bg-danger';
        default:
            return 'bg-secondary';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }
        .order-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="fw-bold mb-0">My Orders</h1>
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Shop
            </a>
        </div>

        <?php if (empty($orders)): ?>
            <div class="text-center p-5 bg-white rounded-3 shadow-sm">
                <i class="bi bi-box-seam" style="font-size: 4rem; color: #6c757d;"></i>
                <h3 class="mt-3">No Orders Yet</h3>
                <p class="text-muted">You haven't placed any orders yet. Let's get shopping!</p>
                <a href="index.php" class="btn btn-success btn-lg mt-3">Shop Now</a>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="card order-card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center fw-semibold">
                        <div>
                            Order ID: #<?php echo str_pad($order['order_id'], 6, '0', STR_PAD_LEFT); ?>
                        </div>
                        <div>
                            Date: <?php echo date("d M, Y", strtotime($order['order_date'])); ?>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="<?php echo htmlspecialchars($order['product_image']); ?>"
                                     alt="Product Image"
                                     class="img-fluid rounded"
                                     style="max-height: 120px; object-fit: contain;">
                            </div>
                            <div class="col-md-4">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($order['product_name']); ?></h5>
                                <p class="text-muted mb-1">
                                    Price: ₹<?php echo number_format($order['product_price']); ?>
                                </p>
                                <p class="text-muted mb-0">
                                    Quantity: <?php echo $order['quantity']; ?>
                                </p>
                            </div>
                            <div class="col-md-3 text-md-center">
                                <p class="mb-1 fw-semibold">Status</p>
                                <span class="badge <?php echo getStatusBadgeClass($order['status']); ?> fs-6">
                                    <?php echo htmlspecialchars($order['status']); ?>
                                </span>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <p class="mb-1 fw-semibold">Total Price</p>
                                <h5 class="fw-bold">₹<?php echo number_format($order['total_price']); ?></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <p class="mb-1 fw-semibold">Delivery Address</p>
                                <p class="text-muted mb-0"><?php echo nl2br(htmlspecialchars($order['address'])); ?></p>
                            </div>
                            <div class="w-32 text-center">
                                        <?php if (strtolower($order['status']) == 'processing' || strtolower($order['status']) == 'shipped'): ?>
                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                <button type="submit" name="cancel_order" class="w-40 bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition-colors text-sm">
                                                    Cancel Order
                                                </button>
                                            </form>
                                        <?php elseif (strtolower($order['status']) == 'delivered'): ?>
                                             <button class="w-full bg-gray-200 text-gray-500 font-semibold py-2 px-4 rounded-lg cursor-not-allowed text-sm">Delivered</button>
                                        <?php elseif(strtolower($order['status']) == 'cancelled'): ?>
                                            <button class="w-full bg-gray-200 text-gray-500 font-semibold py-2 px-4 rounded-lg cursor-not-allowed text-sm">Cancelled</button>  
                                        <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>