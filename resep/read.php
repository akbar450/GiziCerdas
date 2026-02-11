<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['resep_id'])) {

    $resep_id = $_GET['resep_id'];
    $stmt = $conn->prepare("SELECT * FROM resep WHERE resep_id = ?");
    $stmt->bind_param("i", $resep_id);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data resep
    $sql = "SELECT * FROM resep ORDER BY resep_id ASC";
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
