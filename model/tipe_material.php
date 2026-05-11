<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$id                  = $_POST['id'] ?? '';
$status_form         = $_POST['status'] ?? 'INSERT';
$nama_tipe_material  = $_POST['nama_tipe_material'] ?? '';
$pengkodean          = $_POST['pengkodean'] ?? '';
$status              = 1;

if (trim($nama_tipe_material) == '') {

    echo json_encode([
        'status'  => 'error',
        'message' => 'Nama tipe material wajib diisi'
    ]);

    exit;
}

if ($status_form == "UPDATE" && $id != '') {

    $stmt = $conn->prepare("
        UPDATE tipe_material
        SET 
            nama_tipe_material = ?,
            pengkodean = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssi",
        $nama_tipe_material,
        $pengkodean,
        $id
    );

    if ($stmt->execute()) {

        echo json_encode([
            'status'  => 'success',
            'message' => 'Tipe material berhasil diupdate'
        ]);
    } else {

        echo json_encode([
            'status'  => 'error',
            'message' => 'Gagal update tipe material : ' . $stmt->error
        ]);
    }
} else {
    $stmt = $conn->prepare("
        INSERT INTO tipe_material (
            nama_tipe_material,
            pengkodean,
            status
        ) VALUES (?, ?, ?)
    ");

    $stmt->bind_param(
        "ssi",
        $nama_tipe_material,
        $pengkodean,
        $status
    );

    if ($stmt->execute()) {

        echo json_encode([
            'status'  => 'success',
            'message' => 'Tipe material berhasil ditambahkan'
        ]);
    } else {

        echo json_encode([
            'status'  => 'error',
            'message' => 'Gagal menambahkan tipe material : ' . $stmt->error
        ]);
    }
}
