<?php
include '../db.php';

header('Content-Type: application/json');

$anak_id      = $_POST['anak_id'];
$usia_bulan   = $_POST['usia_bulan'];
$berat_badan  = $_POST['berat_badan'];
$tinggi_badan = $_POST['tinggi_badan'];
$keterangan   = $_POST['keterangan'];

$stmt = $conn->prepare("
    INSERT INTO pertumbuhan_anak
    (anak_id, usia_bulan, berat_badan, tinggi_badan, tanggal_catat, keterangan)
    VALUES (?, ?, ?, ?, CURDATE(), ?)
");

$stmt->bind_param(
    "iidds",
    $anak_id,
    $usia_bulan,
    $berat_badan,
    $tinggi_badan,
    $keterangan
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data pertumbuhan anak berhasil ditambahkan",
        "data"    => [
            "anak_id"      => $anak_id,
            "usia_bulan"   => $usia_bulan,
            "berat_badan"  => $berat_badan,
            "tinggi_badan" => $tinggi_badan,
            "tanggal_catat"=> date('Y-m-d'),
            "keterangan"   => $keterangan
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
