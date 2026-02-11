<?php
include_once '../db.php';

header('Content-Type: application/json');

$nama_resep     = $_POST['nama_resep'];
$kategori       = $_POST['kategori'];
$estimasi_porsi = $_POST['estimasi_porsi'];
$kandungan_gizi = $_POST['kandungan_gizi'];

$stmt = $conn->prepare("
    INSERT INTO resep 
    (nama_resep, kategori, estimasi_porsi, kandungan_gizi)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "ssss",
    $nama_resep,
    $kategori,
    $estimasi_porsi,
    $kandungan_gizi
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data resep berhasil ditambahkan",
        "data"    => [
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
