<?php
include '../db.php';

header('Content-Type: application/json');

$pertumbuhan_id = $_POST['pertumbuhan_id'];
$tanggal_catat  = $_POST['tanggal_catat'];
$berat_badan    = $_POST['berat_badan'];
$tinggi_badan   = $_POST['tinggi_badan'];
$keterangan     = $_POST['keterangan'];

$stmt = $conn->prepare("
    UPDATE pertumbuhan_anak 
    SET tanggal_catat = ?, 
        berat_badan = ?, 
        tinggi_badan = ?, 
        keterangan = ?
    WHERE pertumbuhan_id = ?
");

$stmt->bind_param(
    "sddsi",
    $tanggal_catat,
    $berat_badan,
    $tinggi_badan,
    $keterangan,
    $pertumbuhan_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data pertumbuhan anak berhasil diperbarui",
        "data"    => [
            "pertumbuhan_id" => $pertumbuhan_id,
            "tanggal_catat"  => $tanggal_catat,
            "berat_badan"    => $berat_badan,
            "tinggi_badan"   => $tinggi_badan,
            "keterangan"     => $keterangan
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
