<?php
include_once '../db.php';

header('Content-Type: application/json');

// ambil data dari request
$nama_provinsi = $_POST['nama_provinsi'];

$stmt = $conn->prepare("
    INSERT INTO provinsi (nama_provinsi)
    VALUES (?)
");

$stmt->bind_param(
    "s",
    $nama_provinsi
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data provinsi berhasil ditambahkan",
        "data"    => [
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
