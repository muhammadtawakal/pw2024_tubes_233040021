<?php
include '../includes/db.php';

// Membuat tabel users
$sql_users = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_users) === TRUE) {
    echo "Tabel `users` berhasil dibuat.";
} else {
    echo "Error membuat tabel `users`: " . $conn->error;
}

// Membuat tabel students
$sql_students = "CREATE TABLE IF NOT EXISTS `students` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `age` INT NOT NULL
)";

if ($conn->query($sql_students) === TRUE) {
    echo "Tabel `students` berhasil dibuat.";
} else {
    echo "Error membuat tabel `students`: " . $conn->error;
}

$conn->close();
?>

