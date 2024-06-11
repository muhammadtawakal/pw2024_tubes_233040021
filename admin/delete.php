<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];

    if ($type == 'student') {
        $query = "DELETE FROM students WHERE id=?";
    } elseif ($type == 'coach') {
        $query = "DELETE FROM coaches WHERE id=?";
    } else {
        die("Tipe tidak valid.");
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data: " . $conn->error . "');</script>";
    }
} else {
    die("ID tidak valid.");
}
?>
