<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

$sql = "SELECT * FROM edukasi_gizi ORDER BY tanggal_publish DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "total_data" => count($data),
    "data" => $data
], JSON_PRETTY_PRINT);

$conn->close();
?>
