<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM INDEX
if (isset($_SESSION["free"])) {
    header('location: index-userFree.php');
    exit;
} elseif (isset($_SESSION["premium"])) {
    header('location: index-userPremium.php');
    exit;
} elseif (isset($_SESSION["admin"])) {
    header('location: admin_dashboard.php');
    exit;
}
?>

<?php
// APABILA BUTTON LOGIN DI KLIK
if (isset($_POST["login"])) {
    // TRY AND CATCH
    try {
        //code...
        global $conn;

        $email = $_POST["email_user"];
        $password = $_POST["password_user"];

        $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email' ") or die(mysqli_error($conn));

        // CEK USERNAME APAKAH ADA PADA TABEL TB_REGIS_MHS
        if (mysqli_num_rows($result) === 1) {

            // CEK APAKAH PASSWORD BENAR 
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["password"])) {

                if ($row["verification"] == "YES") {

                    // SET SESSION USER
                    $_SESSION["id_user"] = $row["id_user"];

                    if ($row["level"] == "FREE") {
                        // SET SESSION FREE
                        $_SESSION["free"] = true;

                        // QUERY LOG ACTIVITY
                        $userLog = $row["id_user"];
                        $timeLog = date("Y-m-d H:i:s");
                        $query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

                        mysqli_query($conn, $query_log) or die(mysqli_error($conn));

                        // Cek Remember
                        if (isset($_POST['remember_me'])) {
                            // Buat Cookie
                            setcookie('id_user', $row['id_user'], time() + 86400, '/');
                            setcookie('key', hash('sha256', $row['username']), time() + 86400, '/');
                        }

                        header('location: index-userFree.php');
                    } else if ($row["level"] == "PREMIUM") {
                        // SET SESSION FREE
                        $_SESSION["premium"] = true;

                        // QUERY LOG ACTIVITY
                        $userLog = $row["id_user"];
                        $timeLog = date("Y-m-d H:i:s");
                        $query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

                        mysqli_query($conn, $query_log) or die(mysqli_error($conn));

                        // Cek Remember
                        if (isset($_POST['remember_me'])) {
                            // Buat Cookie
                            setcookie('id_user', $row['id_user'], time() + 86400, '/');
                            setcookie('key', hash('sha256', $row['username']), time() + 86400, '/');
                        }

                        header('location: index-userPremium.php');
                    } else if ($row["level"] == "ADMIN") {
                        // SET SESSION FREE
                        $_SESSION["admin"] = true;

                        // Cek Remember
                        if (isset($_POST['remember_me'])) {
                            // Buat Cookie
                            setcookie('id_user', $row['id_user'], time() + 86400, '/');
                            setcookie('key', hash('sha256', $row['username']), time() + 86400, '/');
                        }

                        header('location: admin_dashboard.php');
                    } else {
                        throw new Exception("Level akses account anda tidak terdaftar !!");
                    }
                } else {
                    throw new Exception("Anda belum melakukan verifikasi account. Silahkan cek email anda !!");
                }
            } else {
                throw new Exception("Password yang anda masukkan salah !!");
            }
        } else {
            throw new Exception("Email yang anda masukkan tidak terdaftar !!");
        }
        exit;
    } catch (Exception $error) {
        echo "<script>
        alert ('" . $error->getMessage() . "');
            document.location.href = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>

    <!-- Link Icon -->
    <link rel="icon" href="<?= base_url('asset/icons/oke.png'); ?>" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-5.15.3/css/all.css'); ?>">
    <!--load all styles -->
    <link rel="stylesheet" href="<?= base_url('asset/style/login.css?') . time(); ?>">
</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="<?= base_url('asset/icons/hf_cascade_white.png') ?>" alt="hf-cascade" title="hf-cascade" width="120px">
            </a>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Content -->
    <div class="container align-content-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-5">
                <h2 class="mt-2 mb-2">Login to Your Account</h2>
            </div>
            <div class="col-12">
                <h5>hf-cascade is a streaming platform that has more than 30,000 users from all over the world. This is because our platform can provide a variety of films both series, and singles that can be sorted by IMBD rating or genre.</h5>
                <br><br><br><br><br><br>
            </div>
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-4 mt-2 mb-5">

                            <!-- START FORM LOGIN -->
                            <form action="login.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group mt-3 mb-3">
                                    <label for="email_user" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" minlength="3" maxlength="50" title="Email must be 3-50 character and contain '@'" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_user" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password_user" name="password_user" placeholder="password" minlength="5" maxlength="20" title="Password must be 5-20 character" required>
                                </div>

                                <div class="form-check mb-3">
                                    <div class="fa-pull-left">
                                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                                        <label class="form-text mt-1" for="remember_me">Remember me</label>
                                    </div>
                                    <div class="fa-pull-right mt-1">
                                        <a href="forgot_password.php" target="_blank" class="form-text">Forgot Password ?</a>
                                    </div>
                                </div>

                                <br><br><br><br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mb-2" id="login" name="login">Login to Your Account</button>
                                </div>

                                <div class="form-register mb-5">
                                    <p class="form-text">Not a member yet ? <a href="register.php">Register Now</a></p>
                                </div>

                            </form>
                            <!-- END FORM INPUTAN -->

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End Content -->

    <!-- Link Bootstrap JavaScript -->
    <script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

</html>