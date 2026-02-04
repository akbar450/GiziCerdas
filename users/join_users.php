<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

$sql = "
SELECT 
    u.user_id,
    u.nama_lengkap,
    u.email,
    u.provinsi,
    a.anak_id,
    a.nama_anak,
    a.usia_bulan
FROM users u
LEFT JOIN anak a ON u.user_id = a.user_id
ORDER BY u.user_id
";

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
