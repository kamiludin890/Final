<?php
include $_SERVER['DOCUMENT_ROOT'] . "/database/koneksi.php";
$status_form = $_POST['status'];
$status = 1; // Default status aktif
if ($status_form == "INSERT") {
    $pengkodean = $conn->query("SELECT pengkodean FROM tipe_material WHERE id = " . $_POST['tipe_material']);
    $pengkodean = $pengkodean->fetch_assoc()['pengkodean'];
    $kode_material = $conn->query("SELECT MAX(kode_material) AS max_kode FROM material WHERE kode_material LIKE '$pengkodean%'");
    $kode_material = $kode_material->fetch_assoc()['max_kode'];
    if ($kode_material) {
        $nomor_urut = (int) substr($kode_material, strlen($pengkodean)) + 1;
    } else {
        $nomor_urut = 1;
    }
    $kode_material = $pengkodean . str_pad($nomor_urut, 4, '0', STR_PAD_LEFT);
    $stmt = $conn->prepare("INSERT INTO material (kode_material, nama_material_internal, tipe_material, harga, currency, satuan, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $kode_material, $_POST['nama_material'], $_POST['tipe_material'], $_POST['harga'], $_POST['currency'], $_POST['satuan'], $status);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Material berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan material: ' . $stmt->error]);
    }
} elseif ($status_form == "UPDATE") {
    $id = $_POST['id'];
    $stmt = $conn->prepare("UPDATE material SET nama_material_internal = ?, tipe_material = ?, harga = ?, currency = ?, satuan = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $_POST['nama_material'], $_POST['tipe_material'], $_POST['harga'], $_POST['currency'], $_POST['satuan'], $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Material berhasil diupdate']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate material: ' . $stmt->error]);
    }
}
