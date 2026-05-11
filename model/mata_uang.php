<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$id         = isset($_POST['id']) ? trim($_POST['id']) : '';
$currency   = isset($_POST['currency']) ? trim($_POST['currency']) : '';
$deskripsi  = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';

if ($currency == '' || $deskripsi == '') {

    echo json_encode([
        'status' => 'error',
        'message' => 'Data wajib diisi'
    ]);
    exit;
}
if ($id != '') {

    $stmt = $conn->prepare("
        UPDATE currency_list
        SET 
            currency = ?,
            deskripsi = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssi",
        $currency,
        $deskripsi,
        $id
    );

    if ($stmt->execute()) {

        echo json_encode([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ]);
    } else {

        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal update data'
        ]);
    }

    exit;
}

$stmt = $conn->prepare("
    INSERT INTO currency_list (
        currency,
        deskripsi
    ) VALUES (?, ?)
");

$stmt->bind_param(
    "ss",
    $currency,
    $deskripsi
);

if ($stmt->execute()) {

    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil ditambahkan'
    ]);
} else {

    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal menambahkan data'
    ]);
}
