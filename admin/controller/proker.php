<?php
include_once '../../config/config.php';

$con = new config();

if (!$con->auth()) {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

$conn = $con->koneksi();

switch (@$_GET['page']) {
    case 'add':
        echo "Hello Add";
        break;
    case 'edit':
        echo "Hello Edit";
        break;
    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM struktur_pengurus WHERE md5(id_staff) = '$id'";
        $conn->query($sql);
        header('Location: proker.php');
        break;

    default:
        $sql = "SELECT * FROM struktur_pengurus";
        $dokter = $conn->query($sql);
        $conn->close();
        $proker = '../view/proker/proker-card.php';
        include_once '../view/proker-view.php';
}
