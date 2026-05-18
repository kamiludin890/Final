<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$id = $_POST['id'];

$header = $conn->query("
    SELECT 
    po.*,
    cs.nama_customer_supplier,
    cs.tipe
    FROM purchase_order po
    LEFT JOIN customer_supplier cs ON po.id_customer_supplier=cs.id
    WHERE po.id = $id
")->fetch_assoc();


$items = [];
$res = $conn->query("
    SELECT 
        poi.id_material,
        m.kode_material,
        m.nama_material_internal,
        m.harga,
        poi.id,
        poi.nama_material,
        poi.qty,
        poi.total
    FROM purchase_order_item poi
    LEFT JOIN material m ON m.id = poi.id_material
    WHERE poi.id_purchase_order = $id
");

while ($row = $res->fetch_assoc()) {
    $items[] = [
        'id' => $row['id'],
        'id_material' => $row['id_material'],
        'kode_material' => $row['kode_material'],
        'nama_material_internal' => $row['nama_material_internal'],
        'nama_material' => $row['nama_material'],
        'price' => $row['harga'],
        'qty' => $row['qty'],
        'total' => $row['total']
    ];
}

echo json_encode([
    'header' => $header,
    'items' => $items
]);
