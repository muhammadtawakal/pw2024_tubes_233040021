<?php
include '../includes/db.php';

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM students WHERE name LIKE '%$search%' OR age LIKE '%$search%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada data ditemukan.</td></tr>";
    }
}
?>
