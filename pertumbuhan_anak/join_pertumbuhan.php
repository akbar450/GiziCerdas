<?php
header("Content-Type: application/json; charset=UTF-8");
include "../db.php";

$sql = "
    SELECT
        pertumbuhan_anak.pertumbuhan_id,
        pertumbuhan_anak.berat_badan,
        pertumbuhan_anak.tinggi_badan,
        pertumbuhan_anak.tanggal_catat,
        pertumbuhan_anak.keterangan,

        anak.anak_id,
        anak.nama_anak,
        anak.usia_bulan,

        users.user_id,
        users.nama_lengkap,
        users.email,
        users.provinsi
    FROM pertumbuhan_anak
    INNER JOIN anak
        ON pertumbuhan_anak.anak_id = anak.anak_id
    INNER JOIN users
        ON anak.user_id = users.user_id
    ORDER BY pertumbuhan_anak.tanggal_catat DESC
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "total_data" => count($data),
    "data" => $data
], JSON_PRETTY_PRINT);

$conn->close();
