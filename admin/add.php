<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_student'])) {
        // Proses penambahan siswa
        $name = $_POST['student_name'];
        $age = $_POST['student_age'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["student_photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["student_photo"]["tmp_name"]);

        if($check !== false) {
            if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO students (name, age, photo) VALUES ('$name', '$age', '$target_file')";
                if ($conn->query($query) === TRUE) {
                    echo "<script>alert('Siswa berhasil ditambahkan!');</script>";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Gagal menambahkan siswa: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file.');</script>";
            }
        } else {
            echo "<script>alert('File bukan gambar.');</script>";
        }
    } elseif (isset($_POST['add_coach'])) {
        // Proses penambahan pelatih
        $name = $_POST['coach_name'];
        $position = $_POST['coach_position'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["coach_photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["coach_photo"]["tmp_name"]);

        if($check !== false) {
            if (move_uploaded_file($_FILES["coach_photo"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO coaches (name, position, photo) VALUES ('$name', '$position', '$target_file')";
                if ($conn->query($query) === TRUE) {
                    echo "<script>alert('Pelatih berhasil ditambahkan!');</script>";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Gagal menambahkan pelatih: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file.');</script>";
            }
        } else {
            echo "<script>alert('File bukan gambar.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa dan Pelatih</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Siswa</h2>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="student_name">Nama Siswa:</label>
                <input type="text" class="form-control" id="student_name" name="student_name" required>
            </div>
            <div class="form-group">
                <label for="student_age">Umur Siswa:</label>
                <input type="number" class="form-control" id="student_age" name="student_age" required>
            </div>
            <div class="form-group">
                <label for="student_photo">Foto Siswa:</label>
                <input type="file" class="form-control" id="student_photo" name="student_photo" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_student">Tambah Siswa</button>
        </form>

        <h2 class="text-center mt-5">Tambah Pelatih</h2>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="coach_name">Nama Pelatih:</label>
                <input type="text" class="form-control" id="coach_name" name="coach_name" required>
            </div>
            <div class="form-group">
                <label for="coach_position">Posisi Pelatih:</label>
                <input type="text" class="form-control" id="coach_position" name="coach_position" required>
            </div>
            <div class="form-group">
                <label for="coach_photo">Foto Pelatih:</label>
                <input type="file" class="form-control" id="coach_photo" name="coach_photo" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_coach">Tambah Pelatih</button>
        </form>
    </div>
</body>
</html>
