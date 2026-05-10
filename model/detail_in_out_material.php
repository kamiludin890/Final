<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$id = $_POST['id'];

$query = "
SELECT *
FROM in_out_material
WHERE id = ?
";

$stmt = $conn->prepare($query);

$stmt->bind_param("i", $id);

$stmt->execute();

$document = $stmt
    ->get_result()
    ->fetch_assoc();

$query2 = "
SELECT *
FROM in_out_material_item
WHERE id_document = ?
AND status = 1
";

$stmt2 = $conn->prepare($query2);

$stmt2->bind_param("i", $id);

$stmt2->execute();

$res2 = $stmt2->get_result();

$items = [];

while ($row = $res2->fetch_assoc()) {

    $items[] = $row;
}

echo json_encode([
    "document" => $document,
    "items" => $items
]);
