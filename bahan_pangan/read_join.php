<?php
header("Content-Type: application/json; charset=UTF-8");

include "../db.php";

$sql = "
    SELECT
        b.bahan_id,
        b.nama_bahan,
        b.satuan,
        b.asal_daerah,

        rb.resep_id,
        rb.takaran,
        rb.alternatif,

        r.nama_resep,
        r.kategori,
        r.estimasi_porsi,
        r.kandungan_gizi

    FROM bahan_pangan b
    INNER JOIN resep_bahan rb
        ON b.bahan_id = rb.bahan_id
    INNER JOIN resep r
        ON rb.resep_id = r.resep_id
    ORDER BY b.bahan_id ASC
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
