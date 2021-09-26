<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require './asset/lib-composer/vendor/phpmailer/phpmailer/src/Exception.php';
require './asset/lib-composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './asset/lib-composer/vendor/phpmailer/phpmailer/src/SMTP.php';

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
// APABILA TOMBOL RESET DITEKAN
if (isset($_POST["reset"])) {

    global $conn;
    $emailTo = $_POST["email_user"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$emailTo' ");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        $code = uniqid();
        $otp = mt_rand(100000, 999999);

        // BUAT KODE OTP UNTUK VERIFIKASI
        $query = "INSERT INTO tb_reset_password(code, id_user, otp) VALUES('$code', '" . $row["id_user"] . "', '$otp')";
        mysqli_query($conn, $query) or die(mysqli_error($conn));


        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            //Server settings
            $mail->isSMTP();                                          //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
            $mail->Username   = 'websitemonitoring100@gmail.com';     //SMTP username
            $mail->Password   = 'website100monitoring';               //SMTP password
            $mail->SMTPSecure = 'ssl';                                //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('websitemonitoring100@gmail.com', 'HF-Cascade');
            $mail->addAddress($emailTo);                     //Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

            //Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/new_password.php?code=$code";
            $mail->isHTML(true);                              //Set email format to HTML
            $mail->Subject = 'Your Password Reset Link';
            $mail->Body    = "<h1>You Requested a password reset</h1><br>
            <h3>Kode OTP : " . $otp . "</h3>
            Click <a href='$url'>This Link</a> to do so";
            $mail->AltBody = 'Thankyou.';

            $mail->send();
            echo "<script>
                    alert ('Reset Password link has been sent to your email');
                    document.location.href = 'login.php';
                </script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>
            alert ('Email yang anda masukkan tidak terdaftar !');
            document.location.href = 'forgot_password.php';
        </script>";
    }
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Forgot Password</title>

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
                <h2 class="mt-2 mb-2">Forgot Your Password ?</h2>
            </div>
            <div class="col-12">
                <h5>Change your password in three easy steps. This will help you to secure your password!</h5>
                <br>
            </div>
            <div class="col-10">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <p>1. Enter your email address below.</p>
                            <p>2. Our system will send you a temporary link</p>
                            <p>3. Use the link to reset your password</p>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-4 mt-2 mb-5">

                            <!-- START FORM LOGIN -->
                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group mt-3 mb-3">
                                    <label for="email_user" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" minlength="3" maxlength="50" title="Email must be 3-50 character and contain '@'" required>
                                </div>

                                <br><br><br><br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mb-2" id="register" name="reset">Send to your email</button>
                                </div>
                            </form>
                            <!-- END FORM INPUTAN -->
                            <a href="login.php"><button class="btn mb-5" id="back">back</button></a>

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