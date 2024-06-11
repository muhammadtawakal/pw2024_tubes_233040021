<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

// Mengecek apakah ID ada di URL
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];

    if ($type == 'student') {
        $query = "SELECT * FROM students WHERE id=?";
    } elseif ($type == 'coach') {
        $query = "SELECT * FROM coaches WHERE id=?";
    } else {
        die("Tipe tidak valid.");
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Data tidak ditemukan.");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        if ($type == 'student') {
            $age = $_POST['age'];
        } else {
            $position = $_POST['position'];
        }

        $target_dir = "../uploads/";
        if (!empty($_FILES["photo"]["name"])) {
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            
            if ($check !== false) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $photo = $target_file;
                } else {
                    echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file.');</script>";
                }
            } else {
                echo "<script>alert('File bukan gambar.');</script>";
            }
        } else {
            $photo = $data['photo'];
        }

        if ($type == 'student') {
            $query = "UPDATE students SET name=?, age=?, photo=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sisi", $name, $age, $photo, $id);
        } else {
            $query = "UPDATE coaches SET name=?, position=?, photo=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $name, $position, $photo, $id);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil diperbarui!');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Gagal memperbarui data: " . $conn->error . "');</script>";
        }
    }
} else {
    die("ID tidak valid.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data</h2>
        <form action="edit.php?id=<?php echo $id; ?>&type=<?php echo $type; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name']; ?>" required>
            </div>
            <?php if ($type == 'student'): ?>
            <div class="form-group">
                <label for="age">Umur:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $data['age']; ?>" required>
            </div>
            <?php else: ?>
            <div class="form-group">
                <label for="position">Posisi:</label>
                <input type="text" class="form-control" id="position" name="position" value="<?php echo $data['position']; ?>" required>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="photo">Foto:</label>
                <input type="file" class="form-control" id="photo" name="photo">
                <img src="<?php echo $data['photo']; ?>" alt="Foto" style="width: 100px;">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
