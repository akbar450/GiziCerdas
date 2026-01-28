<?php
header("Content-Type: application/json; charset=UTF-8");

include "../db.php";

$sql = "
    SELECT
        anak.anak_id,
        anak.nama_anak,
        anak.usia_bulan,
        anak.berat_badan,
        anak.tinggi_badan,
        anak.tanggal_input,
        users.user_id,
        users.nama_lengkap,
        users.email,
        users.provinsi
    FROM anak
    INNER JOIN users
        ON anak.user_id = users.user_id
    ORDER BY anak.anak_id ASC
";

$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }


echo json_encode([
        "status" => "success",
        "total_data" => count($data),
        "data" => $data
    ], JSON_PRETTY_PRINT);

} else {
    // Jika tidak ada data
    echo json_encode([
        "status" => "success",
        "total_data" => 0,
        "data" => []
    ], JSON_PRETTY_PRINT);
}

// Tutup koneksi (opsional)
$conn->close();