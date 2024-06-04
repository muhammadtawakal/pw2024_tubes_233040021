<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$id = $_GET['id'];
$query = "SELECT * FROM students WHERE id='$id'";
$result = $conn->query($query);
$siswa = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $photo = $_FILES['photo']['name'] ? $_FILES['photo']['name'] : $siswa['photo'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($photo);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!empty($_FILES["photo"]["tmp_name"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        // Lanjutkan dengan pemrosesan gambar jika ada file yang diunggah
        if ($check !== false) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $query = "UPDATE students SET name='$name', age='$age', photo='$target_file' WHERE id='$id'";
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file.');</script>";
            }
        } else {
            echo "<script>alert('File yang diunggah bukan gambar.');</script>";
        }
    } else {
        $query = "UPDATE students SET name='$name', age='$age' WHERE id='$id'";
    }
    
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Siswa berhasil diupdate!');</script>";
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal mengupdate siswa: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Siswa</h2>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $siswa['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Umur:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $siswa['age']; ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Foto:</label>
                <input type="file" class="form-control" id="photo" name="photo">
                <img src="<?php echo $siswa['photo']; ?>" alt="Foto Siswa" style="width: 100px;">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
