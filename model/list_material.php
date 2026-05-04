<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';
$stmt = $conn->prepare("SELECT * FROM material");
$stmt->execute();
$result = $stmt->get_result();
$materials = [];
while ($row = $result->fetch_assoc()) {
    $materials[] = $row;
}
echo json_encode($materials);
