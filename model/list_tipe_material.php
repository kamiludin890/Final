<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$id     = $_POST['id'] ?? null;
$search = $_POST['search'] ?? '';

if ($id) {
    $stmt = $conn->prepare("
        SELECT *
        FROM tipe_material
        WHERE id = ? ORDER BY id ASC
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();

    echo json_encode($res->fetch_assoc());
    exit;
}

$query = "
    SELECT *
    FROM tipe_material
    WHERE status = 1 
";

if ($search) {

    $query .= "
        AND (
            nama_tipe_material LIKE ? OR
            pengkodean         LIKE ?
        )
        ORDER BY nama_tipe_material ASC
    ";

    $stmt = $conn->prepare($query);

    $searchParam = "%$search%";

    $stmt->bind_param(
        "ss",
        $searchParam,
        $searchParam
    );

    $stmt->execute();

    $res = $stmt->get_result();
} else {

    $res = $conn->query($query . " ORDER BY nama_tipe_material ASC");
}

$data = [];

while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
