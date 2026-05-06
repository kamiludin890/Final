<?php
include $_SERVER['DOCUMENT_ROOT'] . "/database/koneksi.php";

header('Content-Type: application/json');

$status_form = $_POST['status'] ?? '';
$status = 1;

if ($status_form == "DELETE") {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $conn->prepare("UPDATE customer_supplier SET status = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);
    echo json_encode(['status' => $stmt->execute() ? 'success' : 'error', 'message' => $stmt->error]);
    exit;
}

if ($status_form == "INSERT") {


    $tipe   = $_POST['tipe'] ?? '';
    $nama   = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $email  = $_POST['email'] ?? '';
    $phone  = $_POST['phone'] ?? '';
    $tlpn   = $_POST['tlpn'] ?? '';
    $tax    = $_POST['taxNumber'] ?? '';

    if ($tipe == "customer") {
        $prefix = "CS";
    } else {
        $prefix = "SP";
    }

    $query = "SELECT MAX(kode_customer_supplier) AS max_kode 
              FROM customer_supplier 
              WHERE kode_customer_supplier LIKE ?";

    $stmt = $conn->prepare($query);
    $like = $prefix . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $max_kode = $result['max_kode'];

    if ($max_kode) {
        $angka = (int) substr($max_kode, 2); 
        $angka++;
    } else {
        $angka = 1;
    }

    $kode_baru = str_pad($angka, 4, '0', STR_PAD_LEFT);
    $kode_customer_supplier = $prefix . $kode_baru;

    $sql = "INSERT INTO customer_supplier 
            (kode_customer_supplier, tipe, nama_customer_supplier, alamat, email, phone, tlpn, tax_number, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssi",
        $kode_customer_supplier,
        $tipe,
        $nama,
        $alamat,
        $email,
        $phone,
        $tlpn,
        $tax,
        $status
    );

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message'   => $kode_customer_supplier . " berhasil ditambahkan"
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => $stmt->error
        ]);
    }
} elseif ($status_form == "UPDATE") {

    $id     = $_POST['id'] ?? 0;
    $tipe   = $_POST['tipe'] ?? '';
    $nama   = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $email  = $_POST['email'] ?? '';
    $phone  = $_POST['phone'] ?? '';
    $tlpn   = $_POST['tlpn'] ?? '';
    $tax    = $_POST['taxNumber'] ?? '';

    if (!$id) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID tidak ditemukan'
        ]);
        exit;
    }

    $sql = "UPDATE customer_supplier SET
                tipe = ?,
                nama_customer_supplier = ?,
                alamat = ?,
                email = ?,
                phone = ?,
                tlpn = ?,
                tax_number = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssi",
        $tipe,
        $nama,
        $alamat,
        $email,
        $phone,
        $tlpn,
        $tax,
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
            'message' => $stmt->error
        ]);
    }
}
