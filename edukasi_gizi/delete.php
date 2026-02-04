<?php
include '../db.php';

header('Content-Type: application/json');

$edukasi_id = $_POST['edukasi_id'];

$stmt = $conn->prepare("DELETE FROM edukasi_gizi WHERE edukasi_id = ?");
$stmt->bind_param("i", $edukasi_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data edukasi gizi berhasil dihapus"
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
