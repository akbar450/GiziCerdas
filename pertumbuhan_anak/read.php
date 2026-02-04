<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['anak_id']) || isset($_GET['pertumbuhan_id'])) {

    if (isset($_GET['anak_id'])) {
        $anak_id = $_GET['anak_id'];
        $stmt = $conn->prepare("SELECT * FROM pertumbuhan_anak WHERE anak_id = ?");
        $stmt->bind_param("i", $anak_id);
    } else {
        $pertumbuhan_id = $_GET['pertumbuhan_id'];
        $stmt = $conn->prepare("SELECT * FROM pertumbuhan_anak WHERE pertumbuhan_id = ?");
        $stmt->bind_param("i", $pertumbuhan_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data
    $sql = "SELECT * FROM pertumbuhan_anak";
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
