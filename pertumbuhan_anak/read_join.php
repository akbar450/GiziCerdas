<?php
header("Content-Type: application/json; charset=UTF-8");
include "../db.php";

$sql = "
    SELECT
        pa.pertumbuhan_id,
        pa.berat_badan,
        pa.tinggi_badan,
        pa.tanggal_catat,
        pa.keterangan,

        a.anak_id,
        a.nama_anak,
        a.tanggal_lahir AS tanggal_lahir_anak,
        a.jenis_kelamin,

        u.user_id,
        u.nama_lengkap,
        u.email,
        u.provinsi_id
    FROM pertumbuhan_anak pa
    INNER JOIN anak a
        ON pa.anak_id = a.anak_id
    INNER JOIN users u
        ON a.user_id = u.user_id
    ORDER BY pa.tanggal_catat DESC
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
?>
