<?php
include '../db.php';

header('Content-Type: application/json');

$pertumbuhan_id = $_POST['pertumbuhan_id'];

$stmt = $conn->prepare("DELETE FROM pertumbuhan_anak WHERE pertumbuhan_id = ?");
$stmt->bind_param("i", $pertumbuhan_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data pertumbuhan anak berhasil dihapus"
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
