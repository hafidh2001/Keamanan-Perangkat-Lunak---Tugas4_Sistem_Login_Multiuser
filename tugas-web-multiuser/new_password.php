<?php
// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

if (!isset($_GET["code"])) {
    echo "<script>
        alert( 'The link has expired' );
        document.location.href = 'login.php';
    </script>";
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($conn, "SELECT * FROM tb_reset_password WHERE code='$code'");

if (mysqli_num_rows($getEmailQuery) === 0) {
    echo "<script>
        alert( 'The link has expired' );
        document.location.href = 'login.php';
    </script>";
}
?>

<?php
if (isset($_POST["change_password"])) {
    // CEK APAKAH BERHASIL DIUBAH ATAU TIDAK
    if (forgot_password($_POST) > 0) {
        echo "<script>
            alert( 'recovery password success !' );
            document.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert( 'recovery password failed !' );
            document.location.href = 'new_password.php?code=" . $code . " ';
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

    <title>Change Password</title>

    <!-- Link Icon -->
    <link rel="icon" href="<?= base_url('asset/icons/oke.png'); ?>" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-5.15.3/css/all.css'); ?>">
    <!--load all styles -->
    <link rel="stylesheet" href="<?= base_url('asset/style/register.css?') . time(); ?>">
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
                <h2 class="mt-2 mb-2">Change Your Password</h2>
            </div>
            <div class="col-12">
                <h5>Change your password in three easy steps. This will help you to secure your password!</h5>
                <br><br>
            </div>
            <div class="col-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-4 mt-2 mb-5">

                            <!-- START FORM LOGIN -->
                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group mt-3 mb-3">
                                    <label for="otp" class="form-label">Code OTP</label>
                                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Code-OTP" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_pass" class="form-label">Enter your new password</label>
                                    <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New password" minlength="5" maxlength="20" title="Password must be 5-20 character" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_pass2" class="form-label">Confirm new password</label>
                                    <input type="password" class="form-control" id="new_pass2" name="new_pass2" placeholder="Confirm new password" minlength="5" maxlength="20" title="Password must be 5-20 character" required>
                                </div>

                                <br><br><br><br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mb-2" id="register" name="change_password">Send to your email</button>
                                </div>
                            </form>

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