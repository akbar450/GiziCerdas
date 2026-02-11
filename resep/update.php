<?php
include '../db.php';

header('Content-Type: application/json');

$resep_id       = $_POST['resep_id'];
$nama_resep     = $_POST['nama_resep'];
$kategori       = $_POST['kategori'];
$estimasi_porsi = $_POST['estimasi_porsi'];
$kandungan_gizi = $_POST['kandungan_gizi'];

$stmt = $conn->prepare("
    UPDATE resep 
    SET nama_resep = ?, 
        kategori = ?, 
        estimasi_porsi = ?, 
        kandungan_gizi = ?
    WHERE resep_id = ?
");

$stmt->bind_param(
    "ssssi",
    $nama_resep,
    $kategori,
    $estimasi_porsi,
    $kandungan_gizi,
    $resep_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data resep berhasil diperbarui",
        "data"    => [
            "resep_id"       => $resep_id,
            "nama_resep"     => $nama_resep,
            "kategori"       => $kategori,
            "estimasi_porsi" => $estimasi_porsi,
            "kandungan_gizi" => $kandungan_gizi
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
