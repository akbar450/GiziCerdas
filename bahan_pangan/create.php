<?php
include_once '../db.php';

header('Content-Type: application/json');

// ambil data dari request
$nama_bahan  = $_POST['nama_bahan'];
$satuan      = $_POST['satuan'];
$asal_daerah = $_POST['asal_daerah'];

$stmt = $conn->prepare("
    INSERT INTO bahan_pangan 
    (nama_bahan, satuan, asal_daerah)
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "sss",
    $nama_bahan,
    $satuan,
    $asal_daerah
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data bahan pangan berhasil ditambahkan",
        "data"    => [
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
