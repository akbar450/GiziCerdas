<?php
include '../db.php';

header('Content-Type: application/json');

$resep_id   = $_POST['resep_id'];
$bahan_id   = $_POST['bahan_id'];
$takaran    = $_POST['takaran'];
$alternatif = $_POST['alternatif']; // contoh: "tidak" / "tahu"

$stmt = $conn->prepare("
    UPDATE resep_bahan
    SET takaran = ?,
        alternatif = ?
    WHERE resep_id = ?
      AND bahan_id = ?
");

$stmt->bind_param(
    "ssii",
    $takaran,
    $alternatif,
    $resep_id,
    $bahan_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data resep_bahan berhasil diperbarui",
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
