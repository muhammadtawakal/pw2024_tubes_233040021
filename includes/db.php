<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pw2024_tubes_233040021";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
