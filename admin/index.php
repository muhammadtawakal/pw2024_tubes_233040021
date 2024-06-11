<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Ambil data siswa
$query_students = "SELECT * FROM students WHERE name LIKE ?";
$search_param = "%" . $search . "%";
$stmt_students = $conn->prepare($query_students);
$stmt_students->bind_param("s", $search_param);
$stmt_students->execute();
$result_students = $stmt_students->get_result();

if (!$result_students) {
    die("Query error: " . $conn->error);
}

// Ambil data pelatih
$query_coaches = "SELECT * FROM coaches WHERE name LIKE ?";
$stmt_coaches = $conn->prepare($query_coaches);
$stmt_coaches->bind_param("s", $search_param);
$stmt_coaches->execute();
$result_coaches = $stmt_coaches->get_result();

if (!$result_coaches) {
    die("Query error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Dashboard Admin</h2>
        <form class="form-inline mb-3" method="GET" action="index.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Cari nama" aria-label="Search" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
        </form>
        <a href="add.php" class="btn btn-success mb-3">Tambah Siswa dan Pelatih</a>
        
        <h3 class="mt-5">Data Siswa</h3>
        <?php if ($result_students->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result_students->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><img src="<?php echo '../uploads/' . basename($row['photo']); ?>" alt="Foto Siswa" style="width: 100px;"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>&type=student" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>&type=student" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">Tidak ada data siswa yang ditemukan.</p>
        <?php endif; ?>

        <h3 class="mt-5">Data Pelatih</h3>
        <?php if ($result_coaches->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result_coaches->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><img src="<?php echo '../uploads/' . basename($row['photo']); ?>" alt="Foto Pelatih" style="width: 100px;"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>&type=coach" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>&type=coach" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">Tidak ada data pelatih yang ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
