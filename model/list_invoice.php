<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$id     = $_POST['id'] ?? null;
$search = $_POST['search'] ?? '';

// Ambil satu invoice berdasarkan ID
if ($id) {
    $stmt = $conn->prepare("
        SELECT 
            inv.*,
            cs.nama_customer_supplier,
            cs.alamat,
            cs.phone,
            cs.email,
            cs.tipe
        FROM invoice inv
        LEFT JOIN customer_supplier cs 
            ON inv.id_customer_supplier = cs.id
        WHERE inv.id = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    echo json_encode($res->fetch_assoc());
    exit;
}

// Ambil semua invoice
$query = "
    SELECT 
        inv.*,
        cs.nama_customer_supplier,
        cs.alamat,
        cs.phone,
        cs.email,
        cs.tipe
    FROM invoice inv
    LEFT JOIN customer_supplier cs 
        ON inv.id_customer_supplier = cs.id
    WHERE inv.status = 1
";

if ($search) {
    $query .= " AND (
        inv.no_invoice           LIKE ? OR
        inv.tanggal_invoice      LIKE ? OR
        inv.tax_tipe             LIKE ? OR
        inv.currency             LIKE ? OR
        cs.nama_customer_supplier LIKE ? OR
        cs.alamat                LIKE ? OR
        cs.phone                 LIKE ? OR
        cs.email                 LIKE ?
    )
    ORDER BY inv.tanggal_invoice DESC";

    $stmt = $conn->prepare($query);

    $searchParam = "%$search%";

    $stmt->bind_param(
        "ssssssss",
        $searchParam,
        $searchParam,
        $searchParam,
        $searchParam,
        $searchParam,
        $searchParam,
        $searchParam,
        $searchParam
    );

    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = $conn->query($query . " ORDER BY inv.tanggal_invoice DESC");
}

$data = [];
while ($r = $res->fetch_assoc()) {
    $data[] = $r;
}

echo json_encode($data);
