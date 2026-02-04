<?php
include '../db.php';

header('Content-Type: application/json');

$anak_id        = $_POST['anak_id'];
$berat_badan    = $_POST['berat_badan'];
$tinggi_badan   = $_POST['tinggi_badan'];
$tanggal_catat  = $_POST['tanggal_catat'];
$keterangan     = $_POST['keterangan'];

$stmt = $conn->prepare("
    INSERT INTO pertumbuhan_anak
    (anak_id, berat_badan, tinggi_badan, tanggal_catat, keterangan)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "iddss",
    $anak_id,
    $berat_badan,
    $tinggi_badan,
    $tanggal_catat,
    $keterangan
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data pertumbuhan anak berhasil ditambahkan",
        "data"    => [
            "anak_id"       => $anak_id,
            "berat_badan"   => $berat_badan,
            "tinggi_badan"  => $tinggi_badan,
            "tanggal_catat" => $tanggal_catat,
            "keterangan"    => $keterangan
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
