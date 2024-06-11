<?php
session_start();
include 'includes/db.php';

$search = '';
if (isset($_POST['query'])) {
    $search = $_POST['query'];
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

// Tampilkan hasil pencarian
echo "<h3>Hasil Pencarian Siswa</h3>";
while ($row = $result_students->fetch_assoc()) {
    echo "<div>" . $row['name'] . "</div>";
}

echo "<h3>Hasil Pencarian Pelatih</h3>";
while ($row = $result_coaches->fetch_assoc()) {
    echo "<div>" . $row['name'] . "</div>";
}
?>
