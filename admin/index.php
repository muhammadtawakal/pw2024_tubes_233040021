<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$query = "SELECT * FROM students";
$result = $conn->query($query);

if (!$result) {
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                var searchText = $(this).val();
                $.ajax({
                    url: 'search.php',
                    type: 'POST',
                    data: {search: searchText},
                    success: function(data){
                        $("#table-body").html(data);
                    }
                });
            });
        });
    </script>
    <style>
        /* Gaya Dark Mode */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .dark-mode .table {
            color: #ffffff;
        }
        .dark-mode .table th,
        .dark-mode .table td {
            border-color: #444444;
        }
    </style>
    <script>
        // Dark Mode Toggle
        $(document).ready(function(){
            $('.theme-switch input').on('change', function() {
                if($(this).is(':checked')) {
                    $('body').addClass('dark-mode');
                } else {
                    $('body').removeClass('dark-mode');
                }
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Dashboard Admin</h2>
        <div class="theme-switch-wrapper">
            <label class="theme-switch">
                <input type="checkbox">
                <div class="slider round"></div>
            </label>
            <em>Dark Mode</em>
        </div>
        <a href="add.php" class="btn btn-success mb-3">Tambah Siswa</a>
        <input type="text" id="search" class="form-control mb-3" placeholder="Cari Siswa...">
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
            <tbody id="table-body">
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><img src="<?php echo '../uploads/' . basename($row['photo']); ?>" alt="Foto Siswa" style="width: 100px;"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
</body>
</html>
