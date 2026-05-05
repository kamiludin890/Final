<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$conn->begin_transaction();

try {

    $status = $_POST['status'] ?? '';
    $id = (int)($_POST['id'] ?? 0);

    $customer = (int)($_POST['id_customer_supplier'] ?? 0);
    $tgl = $_POST['tanggal_purchase_order'] ?? null;
    $due = $_POST['tanggal_due_date'] ?? null;

    $items = json_decode($_POST['items'] ?? '[]', true);

    if (!$customer) {
        throw new Exception("Customer kosong");
    }

    if (empty($items)) {
        throw new Exception("Item kosong");
    }

    // ================= HEADER =================
    if ($status === "INSERT") {

        $no_po = "PO-" . date("Y") . "-" . rand(10000, 99999);

        $stmt = $conn->prepare("
            INSERT INTO purchase_order
            (no_purchase_order, id_customer_supplier, tanggal_purchase_order, tanggal_due_date)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param("siss", $no_po, $customer, $tgl, $due);

        if (!$stmt->execute()) {
            throw new Exception("INSERT HEADER ERROR: " . $stmt->error);
        }

        $id_po = $conn->insert_id;
    } else {

        if (!$id) {
            throw new Exception("ID PO tidak valid");
        }

        $stmt = $conn->prepare("
            UPDATE purchase_order
            SET id_customer_supplier=?, tanggal_purchase_order=?, tanggal_due_date=?
            WHERE id=?
        ");

        $stmt->bind_param("issi", $customer, $tgl, $due, $id);

        if (!$stmt->execute()) {
            throw new Exception("UPDATE HEADER ERROR: " . $stmt->error);
        }

        $id_po = $id;
    }

    // ================= ITEM =================

    $insert = $conn->prepare("
        INSERT INTO purchase_order_item
        (id_purchase_order, id_material, nama_material, qty, total, status)
        VALUES (?, ?, ?, ?, ?, 1)
    ");

    $update = $conn->prepare("
        UPDATE purchase_order_item
        SET id_material=?, nama_material=?, qty=?, total=?
        WHERE id=?
    ");

    foreach ($items as $it) {

        $item_id = (int)($it['id'] ?? 0);
        $mat = (int)($it['id_material'] ?? 0);
        $nama_material = $it['nama_material'] ?? '';
        $qty = (int)($it['qty'] ?? 0);
        $total = (float)($it['total'] ?? 0);

        if (!$mat) continue;

        // ================= UPDATE ITEM =================
        if ($item_id > 0) {

            $update->bind_param(
                "isidi",
                $mat,
                $nama_material,
                $qty,
                $total,
                $item_id
            );

            if (!$update->execute()) {
                throw new Exception("UPDATE ITEM ERROR: " . $update->error);
            }
        }
        // ================= INSERT ITEM =================
        else {

            $insert->bind_param(
                "iisid",
                $id_po,
                $mat,
                $nama_material,
                $qty,
                $total
            );

            if (!$insert->execute()) {
                throw new Exception("INSERT ITEM ERROR: " . $insert->error);
            }
        }
    }

    $conn->commit();

    echo json_encode([
        "status" => "success",
        "no_po" => ($status === "INSERT") ? $no_po : $_POST['no_po'],
        "id" => $id_po
    ]);
} catch (Exception $e) {

    $conn->rollback();

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
