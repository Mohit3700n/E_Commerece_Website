<?php
session_start();
$invalid_email = "Invalid email or password";
$error_msg = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['login'])) {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=multibusinessbookingsystem", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $email = $_POST["email"];
        $password = $_POST["password"];
        $stmt = $conn->prepare("SELECT * FROM customers WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result['password'])) {
            $_SESSION['customer_id'] = $result['customer_id'];
            $_SESSION['customer_address'] = $result['address'];
            $_SESSION['customer_name'] = $result['name'];
            $_SESSION['customer_email'] = $result['email'];
            header("Location:index.php");
            exit();

        } else {
            $error_msg[] = $invalid_email;
        }
    } catch (Exception $e) {
        echo "Invalid credentials";
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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="blurBox">
    </div>
     <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php if (in_array($invalid_email, $error_msg)) {
                echo '<p class="error_message" id="all_fields_error">' . $invalid_email . '</p>';
            } ?>
            <h1>Customer Login</h1>
            <input autocomplete="off" class="data" type="email" name="email" placeholder="Email" required></input><br>
            <input autocomplete="off" class="data" type="password" name="password" placeholder="Password"
                required></input><br>
            <button type="submit" name="login">Login</button>
            <h4>Don't have an account ? <a href="customerSignUp.php">Sign Up</a></h4>
            <span>OR</span><br>
            <h4"><a class="businessAccount" href="businessLogin.php">Business Account</a></h4>
        </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const inputsFields = form.querySelectorAll('input');
            const all_fields_error = document.getElementById('all_fields_error');
            inputsFields.forEach(function (input) {
                input.addEventListener('focus', function () {
                    if (all_fields_error) {
                        all_fields_error.textContent = '';
                    }
                    const errorSpan = this.nextElementSibling;

                    if (errorSpan && errorSpan.classList.contains('error_message')) {
                        errorSpan.textContent = '';
                    }
                })
            })
        })
    </script>
</body>

</html>