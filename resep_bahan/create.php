<?php
include_once '../db.php';

header('Content-Type: application/json');

$resep_id   = $_POST['resep_id'];
$bahan_id   = $_POST['bahan_id'];
$takaran    = $_POST['takaran'];
$alternatif = $_POST['alternatif']; // contoh: "tidak" / "tahu"

$stmt = $conn->prepare("
    INSERT INTO resep_bahan
    (resep_id, bahan_id, takaran, alternatif)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "iiss",
    $resep_id,
    $bahan_id,
    $takaran,
    $alternatif
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data resep_bahan berhasil ditambahkan",
        "data"    => [
            "resep_id"   => $resep_id,
            "bahan_id"   => $bahan_id,
            "takaran"    => $takaran,
            "alternatif" => $alternatif
        ]
    ]);

} else {

    echo json_encode([
        "status"  => "error",
        "message" => $stmt->error
    ]);

}

$stmt->close();
$conn->close();
?>
