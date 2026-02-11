<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['resep_id']) || isset($_GET['bahan_id'])) {

    if (isset($_GET['resep_id'])) {

        $resep_id = $_GET['resep_id'];
        $stmt = $conn->prepare(
            "SELECT * FROM resep_bahan WHERE resep_id = ?"
        );
        $stmt->bind_param("i", $resep_id);

    } else {

        $bahan_id = $_GET['bahan_id'];
        $stmt = $conn->prepare(
            "SELECT * FROM resep_bahan WHERE bahan_id = ?"
        );
        $stmt->bind_param("i", $bahan_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data resep_bahan
    $sql = "SELECT * FROM resep_bahan ORDER BY resep_id, bahan_id";
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
