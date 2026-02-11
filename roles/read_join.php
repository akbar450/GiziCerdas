<?php
header("Content-Type: application/json; charset=UTF-8");

include "../db.php";

$sql = "
    SELECT
        r.role_id,
        r.role_name,

        u.user_id,
        u.nama_lengkap,
        u.email,
        u.provinsi_id,
        u.tanggal_lahir,
        u.tanggal_daftar

    FROM roles r
    LEFT JOIN users u
        ON r.role_id = u.role_id
    ORDER BY r.role_id ASC
";

$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "total_data" => count($data),
        "data" => $data
    ], JSON_PRETTY_PRINT);

} else {

    echo json_encode([
        "status" => "success",
        "total_data" => 0,
        "data" => []
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
