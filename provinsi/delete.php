<?php
include '../db.php';

header('Content-Type: application/json');

$provinsi_id = $_POST['provinsi_id'];

$stmt = $conn->prepare("DELETE FROM provinsi WHERE provinsi_id = ?");
$stmt->bind_param("i", $provinsi_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data provinsi berhasil dihapus"
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
