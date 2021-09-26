<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM SHOWDATA
if (!isset($_SESSION["free"])) {
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

    <title>HF-Cascade | Free</title>

    <!-- Link Icon -->
    <link rel="icon" href="<?= base_url('asset/icons/oke.png'); ?>" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-5.15.3/css/all.css'); ?>">
    <!--load all styles -->
    <link rel="stylesheet" href="<?= base_url('asset/style/index.css?') . time(); ?>">
</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="<?= base_url('asset/icons/hf_cascade_white.png') ?>" alt="hf-cascade" title="hf-cascade" width="120px">
            </a>

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
    <div class="container align-content-center">
        <div class="row">
            <div class="col-12 mt-2 mb-2">
                <h1>SELAMAT DATANG FREE-USER</h1>
                <br><br><br><br>
            </div>
            <div class="col-12 mt-2 mb-2" style="background-color: rgba(10, 10, 10, 1);">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit itaque fuga autem? Ex harum voluptatibus dolores ducimus tenetur. Cum perferendis adipisci qui, mollitia minus rem aliquid minima voluptate dolorum voluptatibus, eius, corporis veniam praesentium dolor quis omnis voluptas repudiandae laboriosam nam libero? Impedit ipsa enim delectus, autem non unde culpa vitae amet atque quos. Aperiam ipsum expedita at sapiente velit animi, reprehenderit praesentium ea, molestias, dolore corporis nihil rerum enim omnis et iure tempora ab quibusdam suscipit veniam maxime? Deserunt accusamus earum ex voluptates corrupti sapiente rerum, deleniti illo ratione enim, cum id minima in. Hic vitae necessitatibus sint eum!</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit itaque fuga autem? Ex harum voluptatibus dolores ducimus tenetur. Cum perferendis adipisci qui, mollitia minus rem aliquid minima voluptate dolorum voluptatibus, eius, corporis veniam praesentium dolor quis omnis voluptas repudiandae laboriosam nam libero? Impedit ipsa enim delectus, autem non unde culpa vitae amet atque quos. Aperiam ipsum expedita at sapiente velit animi, reprehenderit praesentium ea, molestias, dolore corporis nihil rerum enim omnis et iure tempora ab quibusdam suscipit veniam maxime? Deserunt accusamus earum ex voluptates corrupti sapiente rerum, deleniti illo ratione enim, cum id minima in. Hic vitae necessitatibus sint eum!</p>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Link Bootstrap JavaScript -->
    <script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

</html>