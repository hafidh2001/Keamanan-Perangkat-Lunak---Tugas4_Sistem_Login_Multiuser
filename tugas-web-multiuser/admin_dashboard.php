<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM SHOWDATA
if (!isset($_SESSION["admin"])) {
    header('location: login.php');
    exit;
} else {
    if (isset($_SESSION['id_user'])) {
        // var_dump($_SESSION['id_user']); die;
        $my_id = $_SESSION['id_user'];
    } else {
        $my_id = $_COOKIE['id_user'];
    }

    // QUERY MAHASISWA
    $user = query("SELECT * FROM tb_user WHERE id_user = '$my_id' ")[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Dashboard | HF-Cascade</title>

    <!-- Link Icon -->
    <link rel="icon" href="<?= base_url('asset/icons/oke.png'); ?>" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-5.15.3/css/all.css'); ?>">
    <!--load all styles -->
    <link rel="stylesheet" href="<?= base_url('asset/style/admin.css?') . time(); ?>">
</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <div class="fa-pull-left">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <a class="navbar-brand">
                            <img src="<?= base_url('asset/icons/hf_cascade_white.png') ?>" alt="hf-cascade" title="hf-cascade" width="120px">
                        </a>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="admin_dataUser.php">Data User</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="admin_userLog.php">User Log</a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- DROPDOWN -->
            <div class="fa-pull-right">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="#"><?= $user["email"] ?></a>
                        </li>
                        <p style="color: white; margin-left: 10px; margin-right: 10px; margin-top: 6px;">|</p>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- DROPDOWN -->

        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Content -->
    <div class="container">
        <div class="row">
            <div class="col-4 mt-2 mb-2">
                <h3>Daashboard</h3>
            </div>
        </div>
        <!-- End Content -->

        <!-- Link Bootstrap JavaScript -->
        <script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

</html>