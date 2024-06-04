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

    $query = "INSERT INTO students (name, age) VALUES ('$name', '$age')";
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Siswa berhasil ditambahkan!');</script>";
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menambahkan siswa: " . $conn->error . "');</script>";
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
        <form action="add.php" method="POST">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Umur:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>
