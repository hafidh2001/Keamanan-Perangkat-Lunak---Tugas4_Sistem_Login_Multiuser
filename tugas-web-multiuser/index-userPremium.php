<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM SHOWDATA
if (!isset($_SESSION["premium"])) {
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

    <title>HF-Cascade | Premium</title>

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
                <h1>SELAMAT DATANG PREMIUM-USER</h1>
                <br><br><br><br>
            </div>
            <div class="col-12 mt-2 mb-2" style="background-color: rgba(10, 10, 10, 1);">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo a natus soluta, quas beatae enim minima at, eaque doloremque inventore quaerat necessitatibus facilis ipsa sunt nihil ea id assumenda repellendus tempore alias autem illo, sapiente odio voluptate! Pariatur officia similique ullam? Voluptas, modi porro. Sint vitae tempore iure, repellat placeat ad sequi aliquam eum est debitis impedit? Odit enim illum nostrum eum modi doloribus in velit repudiandae explicabo! Officiis pariatur ea porro eligendi ipsa, voluptatem enim repellendus fuga. Quis officia, possimus quisquam a veritatis neque facilis. Ea aut provident, molestias porro ex tempora? Error quia eaque magnam tempore tempora saepe veritatis aperiam libero, sequi soluta doloribus accusamus molestiae delectus? Autem pariatur eligendi porro, iste itaque nesciunt cum error perspiciatis doloribus perferendis necessitatibus fuga fugiat totam unde tempore, accusantium doloremque, vero laborum alias excepturi. Odit natus voluptas obcaecati? Necessitatibus illo, deleniti labore placeat dignissimos natus qui iste vitae accusantium excepturi? Atque id provident nam ducimus natus earum inventore pariatur. Quia, harum reprehenderit odit corrupti quod alias, officiis quasi, ipsam sapiente exercitationem praesentium! In enim ullam, adipisci repellat, expedita consectetur id, eum natus excepturi nulla saepe est culpa accusantium nostrum. Delectus assumenda officiis iure incidunt sint adipisci quo est eaque pariatur corporis illum exercitationem aperiam vero repellendus, eius dicta. Est animi mollitia eligendi ducimus tenetur accusantium dolore tempore quis. Similique praesentium architecto illo vel eveniet voluptatibus cupiditate dolorem ut quisquam eos eius deleniti, voluptatum iste et temporibus minima saepe sed veniam! Aliquid natus obcaecati beatae, molestias commodi saepe, debitis voluptatem dolor blanditiis magni nostrum perferendis ratione earum, modi voluptatum minima esse id inventore veniam ullam. Nobis et ut totam quidem quam laudantium voluptates aperiam maiores dolorum voluptatum? Atque dolorem, accusantium veritatis perspiciatis, commodi ipsam tempore odio culpa nemo assumenda voluptatibus alias aperiam fugit pariatur temporibus. Quas provident fuga sed doloribus. Minima, reprehenderit omnis praesentium cumque vitae rerum aliquam animi, unde iure aspernatur possimus illo consectetur, tenetur sequi harum ex rem ipsam facilis. Corporis laborum quidem laboriosam eaque corrupti? Dolorum maxime voluptatum repudiandae beatae in? Consequatur, ducimus odit. Minus, nihil sapiente. Nulla iste omnis possimus doloremque nostrum odio dolorem, perspiciatis eos, sed est distinctio repellat adipisci nam temporibus rem sequi consequatur! Sit, sapiente repudiandae adipisci blanditiis accusantium illo ab pariatur aliquam ducimus non nobis natus reprehenderit! Placeat fugiat porro quae, nobis eius odit fuga sapiente commodi distinctio alias nostrum voluptatem! Maxime magnam et officia veritatis, provident eveniet tempore reiciendis exercitationem sapiente atque numquam fugit maiores deserunt ipsa quasi illo incidunt nam at dolor accusamus! Deleniti consequatur expedita quasi est reiciendis, dignissimos illum corrupti quibusdam id ut asperiores nulla? Sit, nesciunt quisquam? Distinctio optio accusantium reprehenderit recusandae, culpa perspiciatis labore. Officiis repudiandae pariatur aliquam quidem quas? Provident cumque repellat fuga nostrum, ratione beatae esse suscipit ipsam culpa quo impedit, excepturi natus quae. Nesciunt voluptas possimus porro quia amet repellat mollitia doloremque hic recusandae in, quod aliquam expedita consequatur illum adipisci provident veritatis dolore, unde eligendi corporis. Architecto, nihil animi fugit et ad accusamus, rerum a illum non distinctio soluta quo ab numquam laborum! Doloremque libero delectus eveniet ad ullam consequuntur neque perspiciatis dolore impedit molestias suscipit, accusamus voluptate dolorem labore nam voluptatibus sed velit quo voluptas exercitationem consequatur porro. Velit rem ad aliquid labore, doloribus similique ipsa doloremque commodi blanditiis, esse, quae voluptas harum obcaecati tempora ducimus adipisci. Ratione cum dolorum autem dicta voluptate nihil voluptatibus, officiis tempore doloremque, repellat voluptates animi esse. Veniam ut incidunt quae atque quos reprehenderit! Asperiores nihil itaque suscipit, error omnis totam sit eaque corrupti necessitatibus consectetur nemo, eius est repellat enim magni aliquid culpa iusto! Quasi rem provident non. Alias mollitia aliquid, doloribus laboriosam tempore porro maxime enim dignissimos neque, exercitationem nulla nisi numquam delectus quis illum? Asperiores optio in atque vitae veritatis, repellat assumenda doloremque eos maiores officia beatae mollitia, eum ea blanditiis ipsum, quia quis? Porro iure temporibus, accusantium a eligendi ipsam perferendis omnis quia voluptatem cum, pariatur iusto beatae laboriosam aperiam veniam dolor optio. Eaque commodi ullam omnis ratione harum, quaerat a velit minima dicta neque amet? Magni maiores maxime sapiente facere accusantium recusandae minus nemo hic reprehenderit labore aliquid, eaque, voluptate fugiat neque cum dicta suscipit temporibus iusto sequi? Accusantium architecto recusandae eius rem quam minima expedita illum ad commodi, possimus atque quo ipsa sapiente! Soluta nesciunt corporis quae id autem odit ex ipsa! Tempore aperiam molestias aspernatur voluptatibus dolorem sit, ullam veniam fugit nemo vel nihil minima atque temporibus odit accusantium neque nobis dicta ipsum soluta delectus? Laborum ducimus cum nihil et distinctio vitae tenetur sequi, explicabo aut perferendis sed, ex necessitatibus assumenda qui, delectus consequatur est eaque tempora aliquam odit nesciunt laudantium sit! Voluptatem natus dolores numquam. Dolores officia fugiat autem nam facere. Fugiat, quibusdam porro. Est debitis dicta et consectetur eius provident ducimus impedit incidunt delectus vitae earum accusantium, vel atque itaque voluptatum corrupti esse ea sunt cupiditate maxime numquam, culpa voluptatem sequi! Iure praesentium quia, et repellendus, quibusdam cum animi quis necessitatibus, velit ex nihil voluptatibus distinctio omnis? Minima cumque ratione similique sapiente ab in, fugiat et voluptate vero quidem natus ex dolorem, reiciendis repellat explicabo quisquam quam excepturi! Laborum fuga officiis dolore modi ab commodi dicta magni cum, facere esse tempora id quasi error, necessitatibus nihil? Fugiat ex molestias labore dolor incidunt sint numquam laborum quae sed eligendi ullam sit commodi ab, earum, velit magnam voluptatem vero a, unde debitis illum. Voluptates ratione, aliquid earum dolores aspernatur hic iste animi mollitia cumque dicta est reprehenderit facilis aperiam perferendis deserunt repellat sit explicabo quidem saepe ex accusamus quasi aut. Perferendis ab consequuntur placeat culpa, temporibus pariatur ipsa, quos iure commodi molestias laboriosam distinctio eum repellat maxime vitae non laborum quaerat deleniti a dolorem, dolore consequatur eligendi omnis natus! Fugiat eaque nostrum sunt eos quaerat ipsam atque facilis beatae, recusandae velit aliquam maxime, perspiciatis nam inventore laudantium. Illum quaerat explicabo autem id perspiciatis pariatur nihil vitae consequatur quisquam error tenetur sint est quis exercitationem ab consequuntur, nisi dicta repellat, cupiditate asperiores quam minus illo. Aspernatur dignissimos laudantium, ad dicta, provident doloribus accusamus voluptatum impedit mollitia, similique fuga! Illum voluptate asperiores exercitationem.</p>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Link Bootstrap JavaScript -->
    <script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

</html>