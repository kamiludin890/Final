<?php
$tabel_name = $_POST['tabel_name'];
$folder = $_SERVER['DOCUMENT_ROOT'] . '/database/skema';
$file = $folder . '/' . $tabel_name;

include $file;
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';
if ($conn->multi_query($skema) === TRUE) {
    echo "✅ Skema database berhasil diimpor.";
} else {
    echo "❌ Gagal mengimpor skema database: " . $conn->error;
}
