<?php
header("Content-Type: application/json; charset=UTF-8");

include "../db.php";

$sql = "
    SELECT
        r.resep_id,
        r.nama_resep,
        r.kategori,
        r.estimasi_porsi,
        r.kandungan_gizi,

        rb.bahan_id,
        rb.takaran,
        rb.alternatif,

        b.nama_bahan,
        b.satuan,
        b.asal_daerah

    FROM resep r
    INNER JOIN resep_bahan rb
        ON r.resep_id = rb.resep_id
    INNER JOIN bahan_pangan b
        ON rb.bahan_id = b.bahan_id
    ORDER BY r.resep_id ASC
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
