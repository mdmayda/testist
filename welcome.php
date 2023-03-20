<?php
session_start();
include('connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_photo']);
        header('location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <img src="img\Logo.jpg" width="200px" height="100px" <form class="d-flex" role="search">
            <button class="navbar_Logout">
                <span><a href="welcome.php?logout=1"  id="logout-btn" class="btn btn-danger">LOG OUT</a></span>
            </button>
            </form>
        </div>
    </nav>
    <div>
        <center>
            <table border="0" class="container">

                <tr>
                    <th colspan="2" class="top">
                        <center>
                            <h1 >Selamat Datang <?php echo $_SESSION['user_name'] ?> </h1>
                        </center>
                    </th>

                </tr>
                <tr>
                    <td rowspan="4">
                        <img src="img\Profile.jpeg" width=200px height=200px>

                    </td>
                    <td>
                        Email : <?php echo $_SESSION['user_email'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nama : <?php echo $_SESSION['user_name'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tlp : <?php echo $_SESSION['user_phone'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Alamat : <?php echo $_SESSION['user_address'] ?>
                    </td>
                </tr>
            </table>
    </div>
</body>
</center>
<footer class="">
    <center>
        <div class="footer">
            <p>
                NRP : 162021035 <br>
                NAMA : MUHAMMAD DHARMMESTI MAYDA <br>
                KELAS : BB
            </p>
        </div>
    </center>
</footer>

</html>