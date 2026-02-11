<?php
include '../db.php';

header('Content-Type: application/json');

// ambil data dari request
$role_name = $_POST['role_name'];

$stmt = $conn->prepare("
    INSERT INTO roles (role_name)
    VALUES (?)
");

$stmt->bind_param(
    "s",
    $role_name
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data role berhasil ditambahkan",
        "data"    => [
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
