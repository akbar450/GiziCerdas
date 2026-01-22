<?php
include '../db.php';

header('Content-Type: application/json');

$anak_id = $_POST['anak_id'];

$stmt = $conn->prepare("DELETE FROM anak WHERE anak_id = ?");
$stmt->bind_param("i", $anak_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data anak berhasil dihapus"
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
