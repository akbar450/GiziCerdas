<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

$sql = "
SELECT 
    u.user_id,
    u.nama_lengkap,
    n.notifikasi_id,
    n.judul,
    n.pesan,
    n.status,
    n.tanggal_kirim
FROM users u
JOIN notifikasi n ON u.user_id = n.user_id
ORDER BY n.tanggal_kirim DESC
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
