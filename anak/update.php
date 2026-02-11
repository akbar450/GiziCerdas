<?php
include '../db.php';

header('Content-Type: application/json');

$anak_id        = $_POST['anak_id'];
$nama_anak      = $_POST['nama_anak'];
$tanggal_lahir  = $_POST['tanggal_lahir'];   // YYYY-MM-DD
$jenis_kelamin  = $_POST['jenis_kelamin'];   // L / P

$stmt = $conn->prepare("
    UPDATE anak 
    SET nama_anak = ?, 
        tanggal_lahir = ?, 
        jenis_kelamin = ?
    WHERE anak_id = ?
");

$stmt->bind_param(
    "sssi",
    $nama_anak,
    $tanggal_lahir,
    $jenis_kelamin,
    $anak_id
);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data anak berhasil diperbarui",
        "data"    => [
            "anak_id"       => $anak_id,
            "nama_anak"     => $nama_anak,
            "tanggal_lahir" => $tanggal_lahir,
            "jenis_kelamin" => $jenis_kelamin
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
