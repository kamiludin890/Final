<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$stmt = $conn->prepare("SELECT * FROM tipe_material WHERE status = 1");
$stmt->execute();
$result = $stmt->get_result();

$tipe_materials = [];
while ($row = $result->fetch_assoc()) {
    $tipe_materials[] = $row;
}

echo json_encode($tipe_materials);
