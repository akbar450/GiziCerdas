<?php
include '../db.php';

header('Content-Type: application/json');

$notifikasi_id = $_POST['notifikasi_id'];

$stmt = $conn->prepare("DELETE FROM notifikasi WHERE notifikasi_id = ?");
$stmt->bind_param("i", $notifikasi_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data notifikasi berhasil dihapus"
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
