<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$tipe_doc = $_POST['tipe_doc'];

$prefix = $tipe_doc . '-' . date('Ym') . '-';

$query = "
SELECT MAX(no_doc) as nomor
FROM in_out_material
WHERE no_doc LIKE '$prefix%'
";

$res = $conn->query($query);

$row = $res->fetch_assoc();

$last = $row['nomor'];

if ($last) {

    $urut = (int) substr($last, -4);

    $urut++;
} else {

    $urut = 1;
}

$no_doc = $prefix . str_pad($urut, 4, '0', STR_PAD_LEFT);

echo json_encode([
    "no_doc" => $no_doc
]);
