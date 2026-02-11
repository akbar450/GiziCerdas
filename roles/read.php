<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['role_id'])) {

    $role_id = $_GET['role_id'];
    $stmt = $conn->prepare("SELECT * FROM roles WHERE role_id = ?");
    $stmt->bind_param("i", $role_id);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data roles
    $sql = "SELECT * FROM roles ORDER BY role_id ASC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode([
    "status"  => "success",
    "message" => count($data) > 0 ? "Data ditemukan" : "Data kosong",
    "data"    => $data
]);

$conn->close();
?>
