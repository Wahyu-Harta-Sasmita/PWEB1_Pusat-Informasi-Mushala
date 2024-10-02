<?php
include_once __DIR__ . '/../../../config/config.php';
$con = new config();
$conn = $con->koneksi();
$sql = "SELECT id_staff, nama, jabatan, photo FROM struktur_pengurus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        $nama = $row['nama'];
        $jabatan = $row['jabatan'];
        $photo = $row['photo'];
?>

        <div class="card" style="width: 10.5rem; margin: 8.5px;">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" class="card-img-top" width="50" height="150" alt="Profile Picture">
            <div class="card-body">
                <h5 class="card-title"><?php echo $nama; ?></h5>
                <p class="card-text" style="font-size: 12px;"><?php echo $jabatan; ?></p>
                <a href="../../controller/dokter.php?mod=dokter&page=delete&id=<?php echo md5($row['id_staff']); ?>" class="btn btn-primary" style="background-color: red; border: red; width: 55px; font-size:10px; margin-right:1px;">Delete</a>
                <a href="../../controller/dokter.php?mod=dokter&page=edit&id=<?php echo md5($row['id_staff']); ?>" class="btn btn-primary" style="width: 50px; font-size:10px">Edit</a>

            </div>
        </div>

<?php
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}
?>