<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["photo"]["tmp_name"]);

    if($check !== false) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO students (name, age, photo) VALUES ('$name', '$age', '$target_file')";
            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Siswa berhasil ditambahkan!');</script>";
                header("Location: index.php");
            } else {
                echo "<script>alert('Gagal menambahkan siswa: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file.');</script>";
        }
    } else {
        echo "<script>alert('File bukan gambar.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Siswa</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Umur:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="photo">Foto:</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>
