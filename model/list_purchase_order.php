<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$search = $_POST['search'] ?? '';

$query = "SELECT 
            po.*, 
            cs.nama_customer_supplier,
            cs.alamat,
            cs.phone,
            cs.email
          FROM purchase_order po
          JOIN customer_supplier cs 
            ON po.id_customer_supplier = cs.id
          WHERE 1=1";

if ($search) {
    $query .= " AND (
        po.no_purchase_order LIKE ? OR
        po.tanggal_purchase_order LIKE ? OR
        po.tanggal_due_date LIKE ? OR
        cs.nama_customer_supplier LIKE ? OR
        cs.alamat LIKE ? OR
        cs.phone LIKE ? OR
        cs.email LIKE ?
    )";

    $stmt = $conn->prepare($query);

    $searchParam = "%$search%";

    $stmt->bind_param(
        "sssssss",
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
    $res = $conn->query($query);
}

$data = [];
while ($r = $res->fetch_assoc()) {
    $data[] = $r;
}

echo json_encode($data);
