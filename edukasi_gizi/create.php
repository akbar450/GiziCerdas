<?php
include_once '../db.php';

header('Content-Type: application/json');

$judul    = $_POST['judul'];
$kategori = $_POST['kategori'];
$isi      = $_POST['isi'];

$stmt = $conn->prepare("
    INSERT INTO edukasi_gizi 
    (judul, kategori, isi, tanggal_publish)
    VALUES (?, ?, ?, NOW())
");
$stmt->bind_param(
    "sss",
    $judul,
    $kategori,
    $isi
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data edukasi gizi berhasil ditambahkan",
        "data"    => [
            "judul"    => $judul,
            "kategori" => $kategori,
            "isi"      => $isi
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
