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

<?php
// KONFIGURASI PAGINATION
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM tb_user WHERE level = 'FREE' OR level = 'PREMIUM' "));
$jumlahHalaman =  ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

//QUERY :
$data_log = query("SELECT tb_user.email, tb_user.username, tb_log.time_log FROM tb_log INNER JOIN tb_user ON tb_log.id_user = tb_user.id_user WHERE level = 'FREE' OR level = 'PREMIUM' ORDER BY time_log DESC LIMIT $awalData, $jumlahDataPerHalaman");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin_UserLog | HF-Cascade</title>

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
                            <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="admin_dataUser.php">Data User</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">User Log</a>
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
                <h3>User Log Activity</h3>
            </div>
            <div class="col-12 mt-2 mb-2">
                <div class="table-responsive">
                    <table class="table align-middle table-dark table-hover table-bordered" style="width: 1320px">
                        <thead class="align-middle">
                            <tr>
                                <th style="width: 50px">No.</th>
                                <th style="width: 200px">Email</th>
                                <th style="width: 200px">Username</th>
                                <th style="width: 450px">Log Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_log as $dl) : ?>

                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $dl["email"]; ?></td>
                                    <td><?= $dl["username"]; ?></td>
                                    <td><?= $dl["time_log"]; ?></td>
                                </tr>

                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br><br>
            </div>

            <div class="col-12">
                <div class="page">

                    <!-- TANDA PANAH MENURUN -->
                    <?php if ($halamanAktif > 1) : ?>
                        <a href="?halaman=<?= $halamanAktif - 1; ?>">
                            <div class="kotak" style="line-height: 30px; font-size: 20px;">&laquo;</div>
                        </a>
                    <?php else : ?>
                        <a>
                            <div class="kotak" style="line-height: 30px; font-size: 20px;">&laquo;</div>
                        </a>
                    <?php endif; ?>

                    <!-- Menampilkan Halaman -->
                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <a href="?halaman=<?= $i; ?>">
                                <div class="kotak" style="border: 3px solid rgba(255, 210, 0, 1); color: rgba(255, 210, 0, 1)"><?= $i; ?></div>
                            </a>
                        <?php else : ?>
                            <a href="?halaman=<?= $i; ?>">
                                <div class="kotak"><?= $i; ?></div>
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- TANDA PANAH BERTAMBAH-->
                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <a href="?halaman=<?= $halamanAktif + 1; ?>">
                            <div class="kotak" style="line-height: 30px; font-size: 20px;">&raquo;</div>
                        </a>
                    <?php else : ?>
                        <a>
                            <div class="kotak" style="line-height: 30px; font-size: 20px;">&raquo;</div>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- Link Bootstrap JavaScript -->
        <script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

</html>