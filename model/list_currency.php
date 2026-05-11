<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$id = $_POST['id'] ?? '';
$search = $_POST['search'] ?? '';
if ($id != '') {

    $stmt = $conn->prepare("
        SELECT *
        FROM currency_list
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
} else {
    $search = "%$search%";

    $stmt = $conn->prepare("
        SELECT *
        FROM currency_list
        WHERE currency LIKE ?
        OR deskripsi LIKE ?
    ");

    $stmt->bind_param("ss", $search, $search);
}

$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {

    $data[] = $row;
}

echo json_encode($data);
