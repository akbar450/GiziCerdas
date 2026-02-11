<?php
include '../db.php';

header('Content-Type: application/json');

$bahan_id    = $_POST['bahan_id'];
$nama_bahan  = $_POST['nama_bahan'];
$satuan      = $_POST['satuan'];
$asal_daerah = $_POST['asal_daerah'];

$stmt = $conn->prepare("
    UPDATE bahan_pangan
    SET nama_bahan = ?,
        satuan = ?,
        asal_daerah = ?
    WHERE bahan_id = ?
");

$stmt->bind_param(
    "sssi",
    $nama_bahan,
    $satuan,
    $asal_daerah,
    $bahan_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data bahan pangan berhasil diperbarui",
        "data"    => [
            "bahan_id"    => $bahan_id,
            "nama_bahan"  => $nama_bahan,
            "satuan"      => $satuan,
            "asal_daerah" => $asal_daerah
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
