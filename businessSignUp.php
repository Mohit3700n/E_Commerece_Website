<?php
session_start();
include('db.php');

$username = $_SESSION['username'] ?? "";
$email = $_SESSION['email'] ?? "";
$category_id = $_SESSION['category'] ?? "";

$usernameErr = $_SESSION['usernameErr'] ?? "";
$emailErr = $_SESSION['emailErr'] ?? "";
$msg = $_SESSION['msg'] ?? "";


unset($_SESSION['usernameErr'], $_SESSION['emailErr'], $_SESSION['username'], $_SESSION['email'], $_SESSION['msg']);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['businessSignup'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($username==null || $email == null || $password == null){
        $_SESSION['msg'] = "All fields are mandatory!";
        header("Location: businessSignup.php");
        exit;
    }

    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    $check = $conn->prepare("SELECT username,email FROM business_user WHERE username = ? OR email = ?");
    $check->execute([$username,$email]);
    $existing = $check->fetch();

    if($existing){

         if ($existing['username'] === $username) {
            $_SESSION['usernameErr'] = "Username already taken";
        }
        if ($existing['email'] === $email) {
            $_SESSION['emailErr'] = "Email already registered";
        }
        header("Location: businessSignup.php");
        exit;
        
    }else{
        $query = "INSERT INTO business_user (username,email,password) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$username,$email,$password]);
        $selectStmt = $conn->prepare("SELECT * FROM business_user WHERE email=:email");
        $selectStmt->bindParam(':email',$email);
        $selectStmt->execute();
        $joined = $selectStmt->fetch();
         print_r($joined);
        $_SESSION['joined_on'] = $joined['joined_on'];
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $joined['id'];
        header("Location:businessDashboard.php");
        exit;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <form method="post">
        <?php if(isset($msg)): ?><p class="error"><?=htmlspecialchars($msg)?></p><?php endif;?>
        <h1>Business SignUp</h1>
        <input class="data" type="text" name="username" placeholder="Username"></input><br>
        <?php if($usernameErr):?><p class="error"><?=$usernameErr?></p><?php endif; ?>
        <input class="data" type="email" name="email" placeholder="Email">"></input><br>
        <?php if($emailErr):?><p class="error"><?=$emailErr?></p><?php endif; ?>
        <input class="data" type="password" name="password" placeholder="Password"></input><br>
        <button name="businessSignup">SignUp</button>
        <h3>Already have an account ?  <a href="businessLogin.php">Login</a></h3>
        <span>OR</span><br>
            <h4><a class="businessAccount" href="customerLogin.php">Customer Account</a></h4>
    </form>
</body>
</html>