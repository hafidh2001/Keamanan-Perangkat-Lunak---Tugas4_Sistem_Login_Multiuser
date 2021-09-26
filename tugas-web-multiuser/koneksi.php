<?php
// MENGHUBUNGKAN KONEKSI COMPOSER
require "./asset/lib-composer/vendor/autoload.php";



//setting default timezone
date_default_timezone_set('Asia/Jakarta');

//start session
session_start();



//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_keamanan_perangkat_lunak");

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}



//membuat function base_url
function base_url($url = null)
{
    $base_url = "http://localhost/tugas-web-multiuser";

    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}
?>

<?php
// CHECK COOKIE
function checkCookie()
{
    global $conn;

    // Cek Cookie
    if (isset($_COOKIE['id_user']) && isset($_COOKIE['key'])) {
        $id_user = $_COOKIE['id_user'];
        $key = $_COOKIE['key'];

        $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$id_user' ");
        $row = mysqli_fetch_assoc($result);

        if ($key === hash('sha256', $row['username'])) {
            if ($row['level'] == "FREE") {
                $_SESSION['free'] = true;
            } elseif ($row['level'] == "PREMIUM") {
                $_SESSION['premium'] = true;
            }
        }
    }
}





// FUNCTION REGISTER
function registrasi($data)
{
    global $conn;

    $email = strtolower(stripcslashes($data["email_user"]));
    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password_user"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2_user"]);

    // CEK EMAIL DAN USERNAME SUDAH ADA ATAU BELUM
    $result_email = mysqli_query($conn, "SELECT email FROM tb_user WHERE email = '$email' ");
    $result_username = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username' ");

    // CHECK EMAIL
    if (mysqli_fetch_assoc($result_email)) {
        echo "<script>
		alert('Email yang dibuat sudah ada !');
		</script>";

        return false;
    }

    // CHECK EMAIL
    if (mysqli_fetch_assoc($result_username)) {
        echo "<script>
            alert('Username yang dibuat sudah ada !');
            </script>";

        return false;
    }

    // CEK KONFIRMASI PASSWORD 
    if ($password !== $password2) {
        echo "<script>
		alert('Konfirmasi password salah');
		</script>";

        return false;
    }

    // ENSKRIPSI PASSWORD
    $passwordValid =  password_hash($password2, PASSWORD_DEFAULT);

    // TAMBAHKAN USER BARU KEDATABASE
    $query = "INSERT INTO tb_user(username, email, password, level, verification) 
	VALUES('$username', '$email', '$passwordValid', 'FREE', 'NO')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_affected_rows($conn);
}





// *************** MEMBUAT FUNCTION DELETE PRODUCT  *************** //
function verification_account($email)
{
    global $conn;

    //query update data tb_user
    $query = "UPDATE tb_user SET verification = 'YES' WHERE email = '$email' ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    // MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
    return mysqli_affected_rows($conn);
}





// MEMBUAT FUNCTION CHANGE PASSWORD
function forgot_password($data)
{
    global $conn;

    $otp = mysqli_real_escape_string($conn, $data["otp"]);
    $new_pwd = mysqli_real_escape_string($conn, $data["new_pass"]);
    $new_pwd2 = mysqli_real_escape_string($conn, $data["new_pass2"]);

    $result = mysqli_query($conn, "SELECT * FROM tb_reset_password WHERE otp = '$otp' ");

    if (mysqli_num_rows($result) === 0) {
        echo "<script>
		alert('Incorrect OTP code');
		</script>";

        return false;
    }

    // CEK APAKAH PASSWORD BENAR 
    $row = mysqli_fetch_assoc($result);

    // CEK KONFIRMASI PASSWORD 
    if ($new_pwd !== $new_pwd2) {
        echo "<script>
		alert('Konfirmasi password salah');
		</script>";

        return false;
    }

    // ENSKRIPSI PASSWORD
    $passwordValid = password_hash($new_pwd2, PASSWORD_DEFAULT);

    // QUERY
    $query_delete = "DELETE FROM tb_reset_password WHERE otp = '$otp' ";
    mysqli_query($conn, $query_delete) or die(mysqli_error($conn));

    $query_reset = "UPDATE tb_user SET password = '$passwordValid' WHERE id_user = '" . $row["id_user"] . "' ";
    mysqli_query($conn, $query_reset) or die(mysqli_error($conn));

    // MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
    return mysqli_affected_rows($conn);
}





// MEMBUAT FUNCTION SHOW DATA (READ)
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $boxs = [];

    // AMBIL DATA (FETCH) DARI VARIABEL RESULT DAN MASUKKAN KE ARRAY
    while ($box = mysqli_fetch_assoc($result)) {
        $boxs[] = $box;
    }
    return $boxs;
}
