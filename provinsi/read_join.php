<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

$sql = "
SELECT 
    p.provinsi_id,
    p.nama_provinsi,

    u.user_id,
    u.nama_lengkap,
    u.email,
    u.tanggal_lahir AS tanggal_lahir_ortu,

    a.anak_id,
    a.nama_anak,
    a.tanggal_lahir AS tanggal_lahir_anak,
    a.jenis_kelamin
FROM provinsi p
INNER JOIN users u 
    ON p.provinsi_id = u.provinsi_id
LEFT JOIN anak a 
    ON u.user_id = a.user_id
ORDER BY p.provinsi_id, u.user_id
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status"      => "success",
    "total_data" => count($data),
    "data"       => $data
], JSON_PRETTY_PRINT);

$conn->close();
?>
