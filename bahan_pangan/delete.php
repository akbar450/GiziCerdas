<?php
include '../db.php';

header('Content-Type: application/json');

$bahan_id = $_POST['bahan_id'];

$stmt = $conn->prepare("DELETE FROM bahan_pangan WHERE bahan_id = ?");
$stmt->bind_param("i", $bahan_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data bahan pangan berhasil dihapus"
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
