<?php
include '../db.php';

header('Content-Type: application/json');

$user_id      = $_POST['user_id'];
$nama_lengkap = $_POST['nama_lengkap'];
$email        = $_POST['email'];
$usia         = $_POST['usia'];
$provinsi     = $_POST['provinsi'];

$stmt = $conn->prepare("
    UPDATE users 
    SET nama_lengkap = ?, email = ?, usia = ?, provinsi = ?
    WHERE user_id = ?
");
$stmt->bind_param(
    "ssdsi",
    $nama_lengkap,
    $email,
    $usia,
    $provinsi,
    $user_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data users berhasil diperbarui",
        "data"    => [
            "user_id"      => $user_id,
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
