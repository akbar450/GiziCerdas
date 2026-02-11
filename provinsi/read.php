<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['provinsi_id'])) {

    $provinsi_id = $_GET['provinsi_id'];
    $stmt = $conn->prepare("SELECT * FROM provinsi WHERE provinsi_id = ?");
    $stmt->bind_param("i", $provinsi_id);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data provinsi
    $sql = "SELECT * FROM provinsi ORDER BY provinsi_id ASC";
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
