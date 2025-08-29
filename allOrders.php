<?php
include("business_header.php");
include("db.php");

$currentUserId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM customer_orders WHERE product_owner_id=:id ORDER BY order_date DESC");
$stmt->execute(["id" => $currentUserId]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['update_status'])) {
    $status = $_GET["selected_status"];
    $order_id = $_GET["order_id"];
    print_r($_GET);

    $allowedStatuses = ['Processing', 'Shipped', 'Delivered', 'Cancelled'];

    if (in_array($status, $allowedStatuses)) {
        $updateStatus = $conn->prepare("UPDATE customer_orders SET status = :status WHERE order_id = :id");
        $updateStatus->execute(["status" => $status, "id" => $order_id]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

function getStatusClass($status) {
    switch ($status) {
        case 'Processing': return 'bg-yellow-100 text-yellow-800';
        case 'Shipped': return 'bg-blue-100 text-blue-800';
        case 'Delivered': return 'bg-green-100 text-green-800';
        case 'Cancelled': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Status Updater</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #toast {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">

    <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manage Orders</h1>
            <p class="text-gray-500">Update order statuses in real-time.</p>
        </header>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-600">Order ID</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Customer name</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Customer Address</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Order Date</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Product Image</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Product</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Price</th>
                            <th class="p-4 text-sm font-semibold text-gray-600 text-center">Items</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Total Price</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Current Status</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">New Status</th>
                            <th class="p-4 text-sm font-semibold text-gray-600 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="orders-table-body">
                        <?php if (empty($result)): ?>
                            <tr><td colspan="7" class="text-center p-8 text-gray-500">No orders found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($result as $value): ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
                                    <tr class="border-b border-gray-200">
                                        <td class="p-4">
                                            <div class="font-medium text-gray-800">#<?php echo str_pad($value['order_id'], 6, '0', STR_PAD_LEFT); ?></div>
                                        </td>
                                         <td class="p-4">
                                            <div class="font-medium text-gray-800"><?php echo htmlspecialchars($value['customer_name']); ?></div>
                                        </td>
                                         <td class="p-4">
                                            <div class="font-medium text-gray-800"><?php echo htmlspecialchars($value['address']); ?></div>
                                        </td>
                                         <td class="p-4">
                                            <div class="font-medium text-gray-800"><?php echo htmlspecialchars($value['order_date']); ?></div>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center space-x-3">
                                                <img width="60" height="60" class="rounded-md" src="<?php echo htmlspecialchars($value['product_image']); ?>" alt="product">
                                            </div>
                                        </td>
                                        <td class="p-4 text-gray-600 text-center"><?php echo htmlspecialchars($value['product_name']); ?></td>
                                        <td class="p-4 text-gray-600 text-center">₹<?php echo number_format($value['product_price']); ?></td>
                                        <td class="p-4 text-gray-600 text-center"><?php echo $value['quantity']; ?></td>
                                        <td class="p-4 font-semibold text-gray-800">₹<?php echo number_format($value['total_price']); ?></td>
                                        <td class="p-4">
                                            <span class="status-badge <?php echo getStatusClass($value['status']); ?> text-xs font-semibold px-2.5 py-1 rounded-full">
                                                <?php echo htmlspecialchars($value['status']); ?>
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <input type="hidden" name="order_id" value="<?php echo $value['order_id']; ?>">
                                            <select name="selected_status" class="status-select border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="Processing" <?php if ($value['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                                                <option value="Shipped" <?php if ($value['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                                <option value="Delivered" <?php if ($value['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                                <option value="Cancelled" <?php if ($value['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                            </select>
                                        </td>
                                        <td class="p-4 text-center">
                                            <button type="submit" name="update_status" class="update-btn bg-blue-500 text-white font-semibold px-4 py-1.5 rounded-lg hover:bg-blue-600 transition-colors">Update</button>
                                        </td>
                                    </tr>
                                </form>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <!-- <div id="toast" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transform translate-y-10">
        Status updated successfully!
    </div> -->

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateButtons = document.querySelectorAll('.update-btn');
            const toast = document.getElementById('toast');
            const statusClasses = {
                'Processing': 'bg-yellow-100 text-yellow-800',
                'Shipped': 'bg-blue-100 text-blue-800',
                'Delivered': 'bg-green-100 text-green-800',
                'Cancelled': 'bg-red-100 text-red-800'
            };

            updateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    
                    const row = this.closest('tr');
                    const statusSelect = row.querySelector('.status-select');
                    const statusBadge = row.querySelector('.status-badge');
                    const newStatus = statusSelect.value;
                    statusBadge.textContent = newStatus;
                    statusBadge.className = 'status-badge text-xs font-semibold px-2.5 py-1 rounded-full';
                    statusBadge.classList.add(...statusClasses[newStatus].split(' '));
                    showToast();
                });
            });

            function showToast() {
                toast.classList.remove('opacity-0', 'translate-y-10');
                toast.classList.add('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'translate-y-10');
                    toast.classList.remove('opacity-100', 'translate-y-0');
                }, 3000);
            }
        });
    </script> -->

</body>
</html>