<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost;dbname=multibusinessbookingsystem", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $fill_all_fields = "Please fill all the field";
    $username_msg = "Username should be between 3 and 30 chracters";
    $invalid_email = "Invalid email";
    $user_exist = "Username already exist";
    $email_exist = "Email already exist";
    $error_msg = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['signUp'])) {

            $username = htmlspecialchars(stripslashes(trim($_POST['name'])));
            $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
            $password = $_POST['password'];
            $address = htmlspecialchars(stripslashes(trim($_POST['address'])));

            if (empty($username) || empty($email) || empty($password) || empty($address)) {
                $error_msg[] = $fill_all_fields;
            } else {
                if (strlen($username) < 3 || strlen($username) > 30) {
                    $error_msg[] = $username_msg;
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
                        $error_msg[] = $invalid_email;
                    } else {


                        $check = $conn->prepare("SELECT * FROM customers WHERE name=:name");
                        $check->bindParam(':name', $username);
                        $check->execute();
                        $result = $check->fetchAll(PDO::FETCH_ASSOC);

                        if (count($result) > 0) {
                            $error_msg[] = $user_exist;
                        } else {
                            $check = $conn->prepare("SELECT * FROM customers WHERE email=:email");
                            $check->bindParam(':email', $email);
                            $check->execute();
                            $result = $check->fetchAll(PDO::FETCH_ASSOC);
                            if (count($result) > 0) {
                                $error_msg[] = $email_exist;
                            } else {
                                if (empty($error_msg)) {

                                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                                    $query = "INSERT INTO customers (name,email,password,address) values (:name,:email,:password,:add)";
                                    $stsmt = $conn->prepare($query);
                                    $stsmt->bindParam(':name', $username);
                                    $stsmt->bindParam(':email', $email);
                                    $stsmt->bindParam(':password', $hashPassword);
                                    $stsmt->bindParam(':add', $address);
                                    $stsmt->execute();
                                    $_SESSION['customer_id'] = $result['customer_id'];
                                    $_SESSION['customer_address'] = $result['address'];
                                    $_SESSION['customer_name'] = $result['name'];
                                    $_SESSION['customer_email'] = $result['email'];
                                    header("Location:index.php");
                                    exit();
                                }

                            }
                        }
                    }
                }


            }

        }
    }

} catch (PDOException $e) {
    echo $e->getMessage();
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
        if (in_array($fill_all_fields, $error_msg))
            echo '<span class="error_messages" id="all_fields_error">' . $fill_all_fields . '</span>'
                ?>
            <h1>Customer SignUp</h1>
            <input autocomplete="off" class="data" type="text" name="name" placeholder="Username" value=""></input><br>
            <?php
        if (in_array($username_msg, $error_msg))
            echo '<span class="error_messages" id="user_name_exist">' . $username_msg . '</span>'
                ?>
                <?php
        if (in_array($user_exist, $error_msg))
            echo '<span class="error_messages" id="all_fields_error">' . $user_exist . '</span>'
                ?>

            <input autocomplete="off" class="data" type="email" name="email" placeholder="Email"></input><br>
            <?php
        if (in_array($invalid_email, $error_msg))
            echo '<span class="error_messages" id="user_email_exist">' . $invalid_email . '</span>'
                ?>
                <?php
        if (in_array($email_exist, $error_msg))
            echo '<span class="error_messages" id="all_fields_error">' . $email_exist . '</span>'
                ?>
        <input autocomplete="off" class="data" type="password" name="password" placeholder="Password"></input><br>
        <input autocomplete="off" class="data" type="text" name="address" placeholder="Address"></input><br>
        <button type="submit" name="signUp">Sign Up</button>
        <h4>Already have an account ? <a href="customerLogin.php">Login</a></h4>
        <span>OR</span><br>
        <h4"><a class="businessAccount" href="businessLogin.php">Business Account</a></h4>
    </form>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('form');
                const inputsFields = form.querySelectorAll('input');
                const userNameExist = document.getElementById('user_name_exist');
                const allFieldError = document.getElementById('all_fields_error');
                const userEmailErr = document.getElementById('user_email_exist');

                inputsFields.forEach(function (input) {
                    input.addEventListener('focus', function () {
                        if (allFieldError) {
                            allFieldError.textContent = '';
                        }
                        if (userNameExist) {
                            userNameExist.textContent = '';
                        }
                        if (userEmailErr) {
                            userEmailErr.textContent = '';
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