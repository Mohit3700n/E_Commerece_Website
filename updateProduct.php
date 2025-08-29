<?php
include("db.php");
include('business_header.php');

$product_id = null;

if(isset($_GET["product_id"])){
    $product_id = $_GET["product_id"];
    $smt = $conn->prepare("SELECT * FROM products_tables WHERE product_id=:id");
    $smt->bindParam(":id", $product_id);
    $smt->execute();
    $rslt = $smt->fetch(PDO::FETCH_ASSOC);
    //  echo "<pre>";
    //         print_r($rslt);
    //         echo "</pre>";
    $pName = $rslt["product_name"];
    $pPrice = $rslt["product_price"];
    $pImg = $rslt["product_image"];
    $pStock = $rslt["stock"];
    $pCName = $rslt["category_name"];
    $pDesc = $rslt["product_description"];
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_product"])){
    $name =  $_POST["product_name"];
    $price =  $_POST["product_price"];
    $desc =  $_POST["product_desc"];
    $stock =  $_POST["product_stock"];
    $category_name =  $_POST["category_name"];
    $user_id = $_SESSION["user_id"];

    $img_name = $_FILES["product_img"]["name"];
    $tmp_name = $_FILES["product_img"]["tmp_name"];
    $upload_path = "images/".basename($img_name);

    if(!empty($img_name) && move_uploaded_file($tmp_name, $upload_path)){
        $finalImg = $upload_path;
    }else{
        $finalImg = $pImg;
    }

    $query = "UPDATE products_tables SET product_name=:name,product_price=:price,product_image=:img,stock=:stock,product_description=:desc,category_name=:category_name WHERE product_id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':price',$price);
    $stmt->bindParam(':img',$finalImg);
    $stmt->bindParam(':stock',$stock);
    $stmt->bindParam(':desc',$desc);
    $stmt->bindParam(':category_name',$category_name);
    $stmt->bindParam(':id',$product_id);
    $stmt->execute();

    header("Location:my_all_product.php");
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="create_product.css">
</head>
<body>
    <div class="container3">
        <h2>Update Product</h2>
        <form class="form" method="post" enctype="multipart/form-data">
            <input class="input margin-top" type="text" name="product_name" placeholder="Product Name" value="<?=$pName?>"></input><br>
            <input class="input" type="number" name="product_price"  place="price" placeholder="Product Price" value="<?=$pPrice?>"></input><br>
            <input class="input" type="text" name="product_desc"  place="description" placeholder="Product Description" value="<?=$pDesc?>"></input><br>
            <?php if(!empty($pImg)): ?>
                <img src="<?=$pImg?>" alt="" width="100" ><br>
                <span>Current image</span>
            <?php endif; ?>
            <input class="input" type="file" name="product_img"  accept="images/*" placeholder="product Image"></input><br>
            <input class="input" type="number" name="product_stock"  placeholder="Product Stock" value="<?=$pStock?>"></input><br>
            <select class="input" name="category_name">
            <option>Select category</option>
            <?php
            $query = "SELECT * FROM businesscategory";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $row){
                $selected = ($pCName===$row['category'])?"selected":"";
                echo "<option value='".htmlspecialchars($row['category'])."' $selected>".ucfirst($row['category'])."</option>";
            }
            ?>
        </select>
            <button class="btn" name="update_product" type="submit">Update</button><br>
        </form>
    </div>
</body>
</html>