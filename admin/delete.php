<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$id = $_GET['id'];
$query = "DELETE FROM students WHERE id='$id'";
if ($conn->query($query) === TRUE) {
    echo "<script>alert('Siswa berhasil dihapus!');</script>";
    header("Location: index.php");
} else {
    echo "<script>alert('Gagal menghapus siswa: " . $conn->error . "');</script>";
}
?>
