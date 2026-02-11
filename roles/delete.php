<?php
include '../db.php';

header('Content-Type: application/json');

$role_id = $_POST['role_id'];

$stmt = $conn->prepare("DELETE FROM roles WHERE role_id = ?");
$stmt->bind_param("i", $role_id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data roles berhasil dihapus"
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
