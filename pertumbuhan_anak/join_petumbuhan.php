<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

$sql = "
SELECT 
    u.nama_lengkap,
    a.anak_id,
    a.nama_anak,
    p.pertumbuhan_id,
    p.usia_bulan,
    p.berat_badan,
    p.tinggi_badan,
    p.tanggal_input
FROM users u
JOIN anak a ON u.user_id = a.user_id
JOIN pertumbuhan_anak p ON a.anak_id = p.anak_id
ORDER BY p.tanggal_input DESC
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
