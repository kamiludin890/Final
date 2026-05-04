<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';
$stmt = $conn->prepare("SELECT * FROM currency_list");
$stmt->execute();
$result = $stmt->get_result();
$currencies = [];
while ($row = $result->fetch_assoc()) {
    $currencies[] = $row;
}
echo json_encode($currencies);
