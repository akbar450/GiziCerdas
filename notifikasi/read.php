<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['user_id']) || isset($_GET['notifikasi_id'])) {

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $stmt = $conn->prepare("SELECT * FROM notifikasi WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
    } else {
        $notifikasi_id = $_GET['notifikasi_id'];
        $stmt = $conn->prepare("SELECT * FROM notifikasi WHERE notifikasi_id = ?");
        $stmt->bind_param("i", $notifikasi_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data
    $sql = "SELECT * FROM notifikasi";
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
