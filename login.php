<?php
session_start();
include('connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: welcome.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['user_email'];
    $password = ($_POST['user_password']);

    $query = "SELECT user_id, user_name, user_email, user_password, user_phone,
        user_address, user_city, user_photo FROM user
        WHERE user_email = ? AND user_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result(
            $user_id,
            $user_name,
            $user_email,
            $user_password,
            $user_phone,
            $user_address,
            $user_city,
            $user_photo
        );
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_address'] = $user_address;
            $_SESSION['user_city'] = $user_city;
            $_SESSION['user_photo'] = $user_photo;
            $_SESSION['logged_in'] = true;

            header('location:welcome.php?message=Logged in successfully');
        } else {
            header('location:login.php?error=Could not verify your account');
        }
    } else {
        // Error
        header('location: login.php?error=Something went wrong!');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <title>Document</title>
</head>



<body>
    <nav class="navbar">
        <div class="container-fluid">
            <img src="img\Logo.jpg" width="200px" height="100px" <form class="d-flex" role="search">
            </form>
        </div>
    </nav>

    <div class="box">
        <div class="container">
            <div class="top">
                <h1>LOGIN</h1>
            </div>

            <form id="login-form" method="POST" action="login.php">
                <?php if (isset($_GET['error'])) ?>
                <div role="alert">
                    <?php if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    } ?>
                </div>
                <div class="user-box">
                    <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email">
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="user-box">
                    <input type="password" name="user_password" class="form-control" placeholder="Password">
                    <i class='bx bx-key'></i>
                </div>
                <div>
                    <a class="btn btn-primary mt-3" href="register.html" role="button">Register</a>
                    <input type="submit" class="btn btn-primary mt-3" class="site-btn" id="login-btn" name="login_btn" value="Login" />
                </div>
            </form>

        </div>
    </div>
</body>

</html>