<?php
include_once __DIR__ . '/../../config/config.php';

$con = new config();

if (!$con->auth()) {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

$conn = $con->koneksi();

switch (@$_GET['page']) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $target_dir = __DIR__ . "/../../media/";
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    
            // Cek apakah file diunggah
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
    
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
    
                // Check file size
                if ($_FILES["photo"]["size"] > 500000) { // 500KB limit
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
    
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
    
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    // Try to upload file
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
    
                        // Jika file berhasil diunggah, masukkan datanya ke database
                        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                            $nama = $_POST['nama'];
                            $jabatan = $_POST['jabatan'];
                            $photo = basename($_FILES["photo"]["name"]); // Simpan nama file saja
    
                            $sql = "INSERT INTO struktur_pengurus (nama, jabatan, photo) 
                                    VALUES ('$nama', '$jabatan', '$photo')";
    
                            if ($conn->query($sql) === TRUE) {
                                header('Location: ' . $con->site_url() . '/index.php?mod=dokter');
                            } else {
                                echo 'Error: ' . $sql . "<br>" . $conn->error;
                            }
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo "No file was uploaded or an error occurred.";
            }
        }
        break;
    
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!isset($err)) {
                $nama = $_POST['nama'];
                $jabatan = $_POST['jabatan'];
                $photo = $_FILES['photo']['name'] ? $_FILES['photo']['name'] : $existing_photo;
                if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    move_uploaded_file($_FILES['photo']['tmp_name'], "path/to/upload/directory/" . $photo);
                }

                $sql = "UPDATE struktur_pengurus 
                        SET nama = ?, jabatan = ?, photo = ? 
                        WHERE id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $nama, $jabatan, $photo, $id);

                if ($stmt->execute()) {
                    header('Location: ' . $con->site_url() . '/index.php?mod=dokter');
                } else {
                    echo 'Error: ' . $stmt->error;
                }
            }
        } else {
            $err['msg'] = "Tidak Diijinkan";
        }
        include_once __DIR__ . '/../view/dokter/edit.php';
        break;
    case 'delete':
        $sql = "DELETE FROM struktur_pengurus WHERE md5(id_staff)='$_GET[id_staff]'";
        $sql = $conn->query($sql);
        header('Location: ' . $con->site_url() . 'index.php?mod=dokter');
        break;

    default:
        $sql = "SELECT * FROM struktur_pengurus";
        $dokter = $conn->query($sql);
        $content = __DIR__ . '/../view/dokter/tampil.php';
        include_once __DIR__ . '/../view/template.php';
        $conn->close();
}
