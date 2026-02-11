<?php
header("Content-Type: application/json; charset=UTF-8");

include "../db.php";

$sql = "
    SELECT
        rb.resep_id,
        r.nama_resep,
        r.kategori,
        r.estimasi_porsi,
        r.kandungan_gizi,

        rb.bahan_id,
        b.nama_bahan,
        b.satuan,
        b.asal_daerah,

        rb.takaran,
        rb.alternatif

    FROM resep_bahan rb
    INNER JOIN resep r
        ON rb.resep_id = r.resep_id
    INNER JOIN bahan_pangan b
        ON rb.bahan_id = b.bahan_id
    ORDER BY rb.resep_id ASC
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
