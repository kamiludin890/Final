<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$id = $_POST['id'] ?? null;
$search = $_POST['search'] ?? '';

$query = "SELECT * FROM material WHERE status = 1";

if ($id) {
    $query .= " AND id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
} elseif ($search) {
    $query .= " AND (kode_material LIKE ? OR nama_material_internal LIKE ?)";
    $stmt = $conn->prepare($query);
    $search = "%$search%";
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = $conn->query($query);
}

$data = [];
while ($r = $res->fetch_assoc()) {
    $data[] = $r;
}

echo json_encode($data);
