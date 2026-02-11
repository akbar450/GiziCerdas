<?php
include '../db.php';

header('Content-Type: application/json');

$role_id   = $_POST['role_id'];
$role_name = $_POST['role_name'];

$stmt = $conn->prepare("
    UPDATE roles
    SET role_name = ?
    WHERE role_id = ?
");

$stmt->bind_param(
    "si",
    $role_name,
    $role_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data role berhasil diperbarui",
        "data"    => [
            "role_id"   => $role_id,
            "role_name" => $role_name
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
