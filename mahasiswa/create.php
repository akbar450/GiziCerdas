<?php
include_once '../db.php';

header('Content-Type: application/json');

$user_id      = $_POST['user_id'];
$nama_anak    = $_POST['nama_anak'];
$usia_bulan   = $_POST['usia_bulan'];
$berat_badan  = $_POST['berat_badan'];
$tinggi_badan = $_POST['tinggi_badan'];

$stmt = $conn->prepare("
    INSERT INTO anak (user_id, nama_anak, usia_bulan, berat_badan, tinggi_badan, tanggal_input)
    VALUES (?, ?, ?, ?, ?, NOW())
");
$stmt->bind_param(
    "isidd",
    $user_id,
    $nama_anak,
    $usia_bulan,
    $berat_badan,
    $tinggi_badan
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil ditambahkan",
        "data"    => [
            "user_id"      => $user_id,
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
