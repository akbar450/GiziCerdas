<?php
include_once '../db.php';

header('Content-Type: application/json');

$user_id        = $_POST['user_id'];
$nama_anak      = $_POST['nama_anak'];
$tanggal_lahir  = $_POST['tanggal_lahir'];   // format: YYYY-MM-DD
$jenis_kelamin  = $_POST['jenis_kelamin'];   // L / P

$stmt = $conn->prepare("
    INSERT INTO anak 
    (user_id, nama_anak, tanggal_lahir, jenis_kelamin)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "isss",
    $user_id,
    $nama_anak,
    $tanggal_lahir,
    $jenis_kelamin
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data anak berhasil ditambahkan",
        "data"    => [
            "user_id"       => $user_id,
            "nama_anak"     => $nama_anak,
            "tanggal_lahir" => $tanggal_lahir,
            "jenis_kelamin" => $jenis_kelamin
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
