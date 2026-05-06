<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$id_invoice = (int)($_POST['id_invoice'] ?? 0);

if (!$id_invoice) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT 
        ii.*,
        m.kode_material
    FROM invoice_item ii
    LEFT JOIN material m ON ii.id_material = m.id
    WHERE ii.id_invoice = ? AND ii.status = 1
");
$stmt->bind_param("i", $id_invoice);
$stmt->execute();
$res = $stmt->get_result();

$data = [];
while ($r = $res->fetch_assoc()) {
    $data[] = $r;
}

echo json_encode($data);
