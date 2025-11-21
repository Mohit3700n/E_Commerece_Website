<?php
session_start();
include('db.php');

$email = $_SESSION['email'] ?? "";
$password = $_SESSION['password'] ?? "";
$msg = $_SESSION['msg'] ?? "";

unset($_SESSION['email'], $_SESSION['password'], $_SESSION['msg']);

if(isset($_POST['businessLogin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email == null || $password == null){
        $_SESSION['msg'] = "Invalid email or password !";
        header("Location:businessLogin.php");
        exit();
    }

    $check = $conn->prepare("SELECT * FROM business_user WHERE email = ? AND password = ?");
    $check->execute([$email,$password]);
    $result = $check->fetch(PDO::FETCH_ASSOC);

    //print_r($result);

    if($result){
        $_SESSION['username'] = $result['username'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['joined_on'] = $result['joined_on'];
        $_SESSION['user_id'] = $result['id'];
        header("Location:businessDashboard.php");
    }else{
        $_SESSION['msg'] = "Invalid email or password !";
        header("Location:businessLogin.php");
        exit();
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="blurBox">
    </div>
    <form method="post">
        <?php if(isset($msg)): ?><p style="color:red;font-size:14px"><?=$msg?></p><?php endif; ?>
        <h1>Business Login</h1>
        <input class="data" type="text" name="email" placeholder="Email"></input><br>
        <input class="data" type="password" name="password" placeholder="Password"></input><br>
        <button name="businessLogin">Login</button> 
        <h4>Don't have an account ?  <a href="businessSignUp.php">Sign Up</a></h4>
        <span>OR</span><br>
        <h4><a class="businessAccount" href="customerLogin.php">Customer Account</a></h4>
    </form>
</body>
</html>