<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['bahan_id'])) {

    $bahan_id = $_GET['bahan_id'];
    $stmt = $conn->prepare("SELECT * FROM bahan_pangan WHERE bahan_id = ?");
    $stmt->bind_param("i", $bahan_id);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data bahan pangan
    $sql = "SELECT * FROM bahan_pangan ORDER BY bahan_id ASC";
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
