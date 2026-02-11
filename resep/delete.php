<?php
include '../db.php';

header('Content-Type: application/json');

$resep_id = $_POST['resep_id'];

$stmt = $conn->prepare("DELETE FROM resep WHERE resep_id = ?");
$stmt->bind_param("i", $resep_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data resep berhasil dihapus"
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
