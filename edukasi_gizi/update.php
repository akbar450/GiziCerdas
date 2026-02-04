<?php
include '../db.php';

header('Content-Type: application/json');

$edukasi_id = $_POST['edukasi_id'];
$judul      = $_POST['judul'];
$kategori   = $_POST['kategori'];
$isi        = $_POST['isi'];

$stmt = $conn->prepare("
    UPDATE edukasi_gizi 
    SET judul = ?, kategori = ?, isi = ?
    WHERE edukasi_id = ?
");
$stmt->bind_param(
    "sssi",
    $judul,
    $kategori,
    $isi,
    $edukasi_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data edukasi gizi berhasil diperbarui",
        "data"    => [
            "edukasi_id" => $edukasi_id,
            "judul"      => $judul,
            "kategori"   => $kategori,
            "isi"        => $isi
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
