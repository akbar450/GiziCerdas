<?php
include '../db.php';

header('Content-Type: application/json');

$provinsi_id   = $_POST['provinsi_id'];
$nama_provinsi = $_POST['nama_provinsi'];

$stmt = $conn->prepare("
    UPDATE provinsi
    SET nama_provinsi = ?
    WHERE provinsi_id = ?
");

$stmt->bind_param(
    "si",
    $nama_provinsi,
    $provinsi_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data provinsi berhasil diperbarui",
        "data"    => [
            "provinsi_id"   => $provinsi_id,
            "nama_provinsi" => $nama_provinsi
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
