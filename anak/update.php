<?php
include '../db.php';

header('Content-Type: application/json');

$anak_id      = $_POST['anak_id'];
$nama_anak    = $_POST['nama_anak'];
$usia_bulan   = $_POST['usia_bulan'];
$berat_badan  = $_POST['berat_badan'];
$tinggi_badan = $_POST['tinggi_badan'];

$stmt = $conn->prepare("
    UPDATE anak 
    SET nama_anak = ?, usia_bulan = ?, berat_badan = ?, tinggi_badan = ?
    WHERE anak_id = ?
");
$stmt->bind_param("siddi", $nama_anak, $usia_bulan, $berat_badan, $tinggi_badan, $anak_id);


if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data anak berhasil diperbarui",
        "data"    => [
            "anak_id"      => $anak_id,
            "nama_anak"    => $nama_anak,
            "usia_bulan"   => $usia_bulan,
            "berat_badan"  => $berat_badan,
            "tinggi_badan" => $tinggi_badan
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
