<?php
include_once '../db.php';

header('Content-Type: application/json');

$nama_lengkap = $_POST['nama_lengkap'];
$email        = $_POST['email'];
$password     = $_POST['password'];
$usia         = $_POST['usia'];
$provinsi     = $_POST['provinsi'];

$stmt = $conn->prepare("
    INSERT INTO users 
    (nama_lengkap, email, password, usia, provinsi, tanggal_daftar)
    VALUES (?, ?, ?, ?, ?, NOW())
");

$stmt->bind_param(
    "sssds",
    $nama_lengkap,
    $email,
    $password,
    $usia,
    $provinsi
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil ditambahkan",
        "data"    => [
            "nama_lengkap" => $nama_lengkap,
            "email"        => $email,
            "usia"         => $usia,
            "provinsi"     => $provinsi
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
