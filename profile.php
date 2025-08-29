<?php
include("db.php");
include("business_header.php");
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["profile_image"])) {
    $imgName = $_FILES["profile_image"]["name"];
    $tmpName = $_FILES["profile_image"]["tmp_name"];
    $upload_path = "images/" . basename($imgName);

    if (move_uploaded_file($tmpName, $upload_path)) {
        $stmt = $conn->prepare("UPDATE business_user SET user_img=:img WHERE id=:id");
        $stmt->bindParam(':id', $_SESSION["user_id"]);
        $stmt->bindParam(':img', $upload_path);
        $stmt->execute();
    } else {
        echo "Failed to upload image";
    }
}else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout"])){
    session_unset();
    session_destroy();
    header("Location:businessLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <?php
    $selectStmt = $conn->prepare("SELECT user_img FROM business_user WHERE id=:id");
    $selectStmt->bindParam(':id', $_SESSION["user_id"]);
    $selectStmt->execute();
    $selectResult = $selectStmt->fetch();
    ?>
    <div class="profileContainer">
        <img width="200px" height="250px" src="<?= $selectResult['user_img'] ?>" alt=""></img>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="profile_image" id="profile_image" accept="image/*" style="display: none;"
                onchange="this.form.submit()">
            <button name="changeProfile" type="button" onclick="document.getElementById('profile_image').click()">Change
                Profile
                Picture</button>
        </form>
        <div class="box">
            <span>Username:</span>
            <span><?= $_SESSION['username'] ?></span>
        </div>
        <div class="box">
            <span>Email:</span>
            <span><?= $_SESSION['email'] ?></span>
        </div>
        <div class="box">
            <span>Joined On:</span>
            <span><?= $_SESSION['joined_on'] ?></span>
        </div>
        <form class="form" method="post">
            <button name="logout" class="button">Logout</button>
        </form>

    </div>
</body>

</html>