<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php include("business_header.php");?>
    <div class="mainContainer">
        <div class="adminDash">
            <div class="nameAndImage marginTop">
                <img src="icons/dashboard.png" width="20px" height="20px" alt="">
                <h2>Admin Dashboard</h2>
            </div>
            <div class="productOptions">
                <div class="nameAndImage marginTop ">
                    <img src="icons/package.png" width="20px" height="20px" alt="">
                    <a href="my_all_product.php">
                        <h4>My All Products</h4>
                    </a>
                </div>
                <div class="nameAndImage">
                    <img src="icons/plus.png" width="20px" height="20px" alt="">
                    <a href="create_product.php">
                        <h4>Create Product</h4>
                    </a>
                </div>
                <div class="nameAndImage">
                    <img src="icons/shopping-cart.png" width="20px" height="20px" alt="">
                    <a href="allOrders.php">
                        <h4>All Orders</h4>
                    </a>
                </div>
                <div class="nameAndImage">
                    <img src="icons/star.png" width="20px" height="20px" alt="">
                    <a href="">
                        <h4>All Review</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="container2">
            <div class="card">
                <img src="icons/package.png" alt="" width="30px" height="30px">
                <span>Total Products</span>
                <span><?php $stmt = $conn->prepare("SELECT * FROM products_tables where owner_of_product_id = :id");
                $stmt->bindParam(':id',$_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result); ?></span>
            </div>
             <div class="card">
                <img src="icons/shopping-cart.png" alt="" width="30px" height="30px">
                <span>Total Orders</span>
                <span><?php
                $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE product_owner_id = :id");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result);
                ?></span>
            </div>
            <div class="card">
                <img src="icons/shopping-cart.png" alt="" width="30px" height="30px">
                <span>Ongoing Orders</span>
                <span><?php
                $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE product_owner_id = :id AND status != 'cancelled' AND status != 'Delivered'");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result);
                ?></span>
            </div>
            <div class="card">
                <img src="icons/shopping-cart.png" alt="" width="30px" height="30px">
                <span>Cancelled Orders</span>
                <span><?php
                $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE product_owner_id = :id AND status = 'cancelled'");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result);
                ?></span>
            </div>
            <div class="card">
                <img src="icons/shopping-cart.png" alt="" width="30px" height="30px">
                <span>Completed Orders</span>
                <span><?php
                $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE product_owner_id = :id AND status = 'Delivered'");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result);
                ?></span>
            </div>
             <div class="card">
                <img src="icons/rupee.png" alt="" width="30px" height="30px">
                <span>Total Revenue</span>
                <span><?php
                $stmt = $conn->prepare("SELECT total_price FROM customer_orders WHERE product_owner_id = :id AND status != 'Cancelled'");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $revenue = 0;
                foreach($result as $row){
                    $revenue += $row['total_price'];
                }
                echo $revenue;
                ?></span>
            </div>
             <div class="card">
                <img src="icons/check.png" alt="" width="30px" height="30px">
                <span>In Stock</span>
                <span><?php
                $stmt = $conn->prepare("SELECT stock FROM products_tables WHERE owner_of_product_id = :id AND stock != 0");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result);
                ?></span>
            </div>
             <div class="card">
                <img src="icons/exclamation.png" alt="" width="30px" height="30px">
                <span>Out of Stock</span>
                <span><?php
                $stmt = $conn->prepare("SELECT stock FROM products_tables WHERE owner_of_product_id = :id AND stock = 0");
                $stmt->execute(["id" => $_SESSION['user_id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo count($result);
                ?></span>
            </div>
        </div>
    </div>
</body>

</html>

<?php

?>