<?php
header("Content-Type: application/json; charset=UTF-8");

include "../db.php";

$sql = "
    SELECT
        a.anak_id,
        a.nama_anak,
        a.tanggal_lahir AS tanggal_lahir_anak,
        a.jenis_kelamin,

        p.pertumbuhan_id,
        p.usia_bulan,
        p.berat_badan,
        p.tinggi_badan,
        p.tanggal_catat,
        p.keterangan,

        u.user_id,
        u.nama_lengkap,
        u.email,
        u.provinsi_id
    FROM anak a
    INNER JOIN pertumbuhan_anak p
        ON a.anak_id = p.anak_id
    INNER JOIN users u
        ON a.user_id = u.user_id
    ORDER BY a.anak_id ASC, p.tanggal_catat DESC
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

    echo json_encode([
        "status" => "success",
        "total_data" => 0,
        "data" => []
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
