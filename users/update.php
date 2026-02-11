<?php
include '../db.php';

header('Content-Type: application/json');

$user_id        = $_POST['user_id'];
$nama_lengkap   = $_POST['nama_lengkap'];
$email          = $_POST['email'];
$provinsi_id    = $_POST['provinsi_id'];
$tanggal_lahir  = $_POST['tanggal_lahir'];

$stmt = $conn->prepare("
    UPDATE users 
    SET nama_lengkap = ?, 
        email = ?, 
        provinsi_id = ?, 
        tanggal_lahir = ?
    WHERE user_id = ?
");

$stmt->bind_param(
    "ssisi",
    $nama_lengkap,
    $email,
    $provinsi_id,
    $tanggal_lahir,
    $user_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data users berhasil diperbarui",
        "data"    => [
            "user_id"        => $user_id,
            "nama_lengkap"   => $nama_lengkap,
            "email"          => $email,
            "provinsi_id"    => $provinsi_id,
            "tanggal_lahir"  => $tanggal_lahir
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
