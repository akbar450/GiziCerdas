<?php
include '../db.php';

header('Content-Type: application/json');

$user_id = $_POST['user_id'];

$stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data users berhasil dihapus"
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
