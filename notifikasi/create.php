<?php
include_once '../db.php';

header('Content-Type: application/json');

$user_id = $_POST['user_id'];
$judul   = $_POST['judul'];
$pesan   = $_POST['pesan'];
$status  = $_POST['status'];

$stmt = $conn->prepare("
    INSERT INTO notifikasi 
    (user_id, judul, pesan, status, tanggal_kirim)
    VALUES (?, ?, ?, ?, NOW())
");
$stmt->bind_param(
    "isss",
    $user_id,
    $judul,
    $pesan,
    $status
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data notifikasi berhasil ditambahkan",
        "data"    => [
            "user_id" => $user_id,
            "judul"   => $judul,
            "pesan"   => $pesan,
            "status"  => $status
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
