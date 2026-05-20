    <?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$id = (int)($_POST['id'] ?? 0);

if (!$id) {
    echo json_encode(['header' => null, 'items' => []]);
    exit;
}

$stmt = $conn->prepare("
    SELECT 
        inv.*,
        cs.nama_customer_supplier,
        cs.alamat,
        cs.phone,
        cs.email AS email_cs,
        cs.tipe
    FROM invoice inv
    LEFT JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
    WHERE inv.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$header = $stmt->get_result()->fetch_assoc();

$items = [];
$stmtItems = $conn->prepare("
    SELECT 
        ii.*,
        m.kode_material,
        m.nama_material_internal
    FROM invoice_item ii
    LEFT JOIN material m ON ii.id_material = m.id
    WHERE ii.id_invoice = ? AND ii.status = 1
");
$stmtItems->bind_param("i", $id);
$stmtItems->execute();
$res = $stmtItems->get_result();

while ($row = $res->fetch_assoc()) {
    $items[] = [
        'id'                   => $row['id'],
        'id_material'          => $row['id_material'],
        'kode_material'        => $row['kode_material'] ?? '-',
        'nama_material'        => $row['nama_material'],
        'nama_material_internal' => $row['nama_material_internal'] ?? '',
        'qty'                  => $row['qty'],
        'total'                => $row['total'],
    ];
}

echo json_encode([
    'header' => $header,
    'items'  => $items
]);
