<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['edukasi_id'])) {

    $edukasi_id = $_GET['edukasi_id'];
    $stmt = $conn->prepare("SELECT * FROM edukasi_gizi WHERE edukasi_id = ?");
    $stmt->bind_param("i", $edukasi_id);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data
    $sql = "SELECT * FROM edukasi_gizi";
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
