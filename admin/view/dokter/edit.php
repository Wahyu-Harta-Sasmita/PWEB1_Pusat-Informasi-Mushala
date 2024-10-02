<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body style="display: flex; justify-content:center; height:100vh; align-items:center; background: url('../../assets/images/airplane.jpg') center center / cover no-repeat;">
<form action="/php_test1/admin/controller/dokter.php?mod=dokter&page=edit&id=<?= htmlspecialchars($id) ?>" method="POST" enctype="multipart/form-data" class="container-add" enctype="multipart/form-data" style="width: 30%; padding: 20px; color: white; font-weight:bold;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <div class="mb-3">
            <label for="add" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($nama ?? '') ?>" placeholder="gus selem" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" value="<?= htmlspecialchars($jabatan ?? '') ?>" placeholder="ketua pengurus" required>

        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Change Photo</label>
            <input class="form-control" type="file" name="photo">
        </div>
        <?php if (!empty($photo)): ?>
            <div class="mb-3">
                <label class="form-label">Foto Lama</label>
                <img src="path/to/upload/directory/<?= htmlspecialchars($photo) ?>" alt="Foto Pengurus" style="max-width: 100%; height: auto;">
            </div>
        <?php endif; ?>
        <div class="btn-s" style="text-align: right;">
            <button type="submit" style="border-radius:10px; padding:5px 10px;">
                <i class="fa-regular fa-floppy-disk" style="margin-right: 5px;"></i>Save
            </button>
        </div>
    </form>
</body>

</html>
