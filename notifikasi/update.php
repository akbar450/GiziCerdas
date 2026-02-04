<?php
include '../db.php';

header('Content-Type: application/json');

$notifikasi_id = $_POST['notifikasi_id'];
$judul         = $_POST['judul'];
$pesan         = $_POST['pesan'];
$status        = $_POST['status'];

$stmt = $conn->prepare("
    UPDATE notifikasi 
    SET judul = ?, pesan = ?, status = ?
    WHERE notifikasi_id = ?
");
$stmt->bind_param(
    "sssi",
    $judul,
    $pesan,
    $status,
    $notifikasi_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data notifikasi berhasil diperbarui",
        "data"    => [
            "notifikasi_id" => $notifikasi_id,
            "judul"         => $judul,
            "pesan"         => $pesan,
            "status"        => $status
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
