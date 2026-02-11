<?php
include_once '../db.php';

header('Content-Type: application/json');

// ambil data dari request
$nama_lengkap  = $_POST['nama_lengkap'];
$email         = $_POST['email'];
$password      = $_POST['password'];        
$provinsi_id   = $_POST['provinsi_id'];     
$tanggal_lahir = $_POST['tanggal_lahir'];   

// default role: orang tua (role_id = 1)
$role_id = 1;

$stmt = $conn->prepare("
    INSERT INTO users 
    (role_id, nama_lengkap, email, password, provinsi_id, tanggal_lahir, tanggal_daftar)
    VALUES (?, ?, ?, ?, ?, ?, NOW())
");

$stmt->bind_param(
    "isssis",
    $role_id,
    $nama_lengkap,
    $email,
    $password,
    $provinsi_id,
    $tanggal_lahir
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data user berhasil ditambahkan",
        "data"    => [
            "nama_lengkap"  => $nama_lengkap,
            "email"         => $email,
            "role"          => "orang_tua",
            "provinsi_id"   => $provinsi_id,
            "tanggal_lahir" => $tanggal_lahir
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
