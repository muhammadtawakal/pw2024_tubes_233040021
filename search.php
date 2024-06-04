<?php
include 'includes/db.php';
$search_term = $_GET['q'];
$query = "SELECT * FROM students WHERE name LIKE '%$search_term%'";
$result = $conn->query($query);

$response = [];
while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}

echo json_encode($response);
?>
