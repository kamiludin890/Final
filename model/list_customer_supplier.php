<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

$search = $_POST['search'] ?? '';

$query = "SELECT * FROM customer_supplier WHERE 1=1";

if ($search) {
    $query .= " AND (nama_customer_supplier LIKE ? OR alamat LIKE ? OR tipe LIKE ? OR phone LIKE ? OR email LIKE ? OR tax_number LIKE ?)";
    $stmt = $conn->prepare($query);
    $search = "%$search%";
    $stmt->bind_param("ssssss", $search, $search, $search, $search, $search, $search);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = $conn->query($query);
}
$data = [];
while ($r = $res->fetch_assoc()) $data[] = $r;

echo json_encode($data);
