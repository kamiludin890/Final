<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$search = $_POST['search'] ?? '';

$query = "
SELECT
    a.*,
    cs.nama_customer_supplier
FROM in_out_material a

LEFT JOIN customer_supplier cs
ON a.id_customer_supplier = cs.id

WHERE a.status = 1
";

if ($search != '') {

    $query .= "
        AND (
            a.no_doc LIKE ?
            OR a.jenis_doc LIKE ?
            OR cs.nama_customer_supplier LIKE ?
        )
    ";

    $stmt = $conn->prepare($query);

    $search = "%$search%";

    $stmt->bind_param(
        "sss",
        $search,
        $search,
        $search
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
