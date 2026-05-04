<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';
$nama_tipe_material = $_POST['nama_tipe_material'];
$pengkodean = $_POST['pengkodean'];
$status = 1;
$stmt = $conn->prepare("INSERT INTO tipe_material (nama_tipe_material, pengkodean, status) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $nama_tipe_material, $pengkodean, $status);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Tipe material berhasil ditambahkan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan tipe material: ' . $stmt->error]);
}
