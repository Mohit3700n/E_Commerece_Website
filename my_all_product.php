<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="allOrders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
     <?php
    include("business_header.php");
?>
     <div class="allOrderTableDiv">
       
    <h1>My All Products</h1>
    <table>
        <tr>
            <th>SI No</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>In Stock</th>
            <th>Price</th>
            <th>Category</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php
            $query = "SELECT * FROM products_tables WHERE owner_of_product_id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id',$_SESSION["user_id"]);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            $i=1;
            foreach($result as $row){
                 echo "<tr>
                        <td>{$i}</td>
                        <td><img width='120px' height='auto' src='{$row['product_image']}'></img></td>
                        <td>{$row['product_name']}</td>
                        <td>{$row['stock']}</td>
                        <td>&#8377;{$row['product_price']}</td>
                        <td>{$row['category_name']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                        <a href='updateProduct.php?product_id={$row['product_id']}'><i class='fa-solid fa-pen-to-square'></i></a>
                        <a href='?delete_id={$row['product_id']}' onclick=\"return confirm('Are you sure want to delete this product ?');\"><i class='fa-solid fa-trash'></i></a>
                        </td>
                     </tr>";
                       $i++;
            }
        ?>
    </table>
    </div>
</body>
</html>

<?php
if(isset($_GET["delete_id"])){
    $product_id = $_GET["delete_id"];
    $rmt = $conn->prepare("DELETE FROM products_tables WHERE product_id = :id");
    $rmt->bindParam(':id',$product_id);
    $rmt->execute();
    header("Location:".$_SERVER["PHP_SELF"]);
}

?>