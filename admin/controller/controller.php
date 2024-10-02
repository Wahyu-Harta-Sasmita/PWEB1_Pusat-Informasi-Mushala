<?php
include_once __DIR__ . '/../../config/config.php';
$con = new config();

if (isset($_POST['email'])) {
    $conn = $con->koneksi();
    $email = $_POST['email'];
    $psw = md5($_POST['password']);
    $sql = "SELECT * FROM data_login WHERE password = '$psw' AND email = '$email' AND active = 'Y'";
    $user = $conn->query($sql);
    
    if ($user->num_rows > 0) {
        $sess = $user->fetch_array();
        $_SESSION['login']['email'] = $sess['email'];
        $_SESSION['login']['id'] = $sess['id'];
        header('Location: http://localhost/php_test1/index.php?mod=dokter');
        exit();
    } else {
        $msg = "Email dan Password tidak cocok";
        include_once __DIR__ . '/../view/login.php';
    }
} else {
    include_once __DIR__ . '/../view/login.php';
}
?>
