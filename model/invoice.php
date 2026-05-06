<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$conn->begin_transaction();

try {
    $status  = $_POST['status'] ?? '';
    $id      = (int)($_POST['id'] ?? 0);

    $id_cs   = (int)($_POST['id_customer_supplier'] ?? 0);
    $tgl     = $_POST['tanggal_invoice'] ?? null;
    $tax     = $_POST['tax_tipe'] ?? '';
    $curr    = $_POST['currency'] ?? '';
    $total   = (float)($_POST['total'] ?? 0);

    $items   = json_decode($_POST['items'] ?? '[]', true);

    if (!$id_cs && $status !== 'DELETE') throw new Exception("Customer / Supplier kosong");

    if ($status === 'DELETE') {
        if (!$id) throw new Exception("ID Invoice tidak valid untuk dihapus");

        $stmtDel = $conn->prepare("UPDATE invoice SET status = 0 WHERE id = ?");
        $stmtDel->bind_param("i", $id);
        if (!$stmtDel->execute()) throw new Exception("Hapus invoice gagal: " . $stmtDel->error);

        $stmtDelItem = $conn->prepare("UPDATE invoice_item SET status = 0 WHERE id_invoice = ?");
        $stmtDelItem->bind_param("i", $id);
        $stmtDelItem->execute();

        $conn->commit();
        echo json_encode(["status" => "success"]);
        exit;
    }

    if (!$tgl)   throw new Exception("Tanggal invoice kosong");
    if (empty($items)) throw new Exception("Item invoice kosong");

    if ($status === "INSERT") {

        $yearMonth = date("Ym");

        $stmtLast = $conn->prepare("
            SELECT no_invoice
            FROM invoice
            WHERE no_invoice LIKE ?
            ORDER BY id DESC
            LIMIT 1
        ");
        $like = "INV-" . $yearMonth . "-%";
        $stmtLast->bind_param("s", $like);
        $stmtLast->execute();
        $result = $stmtLast->get_result();

        $lastNumber = 0;
        if ($row = $result->fetch_assoc()) {
            $parts      = explode("-", $row['no_invoice']);
            $lastNumber = (int)end($parts);
        }

        $no_invoice = "INV-" . $yearMonth . "-" . str_pad($lastNumber + 1, 5, "0", STR_PAD_LEFT);

        $stmt = $conn->prepare("
            INSERT INTO invoice
            (no_invoice, id_customer_supplier, tanggal_invoice, tax_tipe, total, currency, status)
            VALUES (?, ?, ?, ?, ?, ?, 1)
        ");
        $stmt->bind_param("sissds", $no_invoice, $id_cs, $tgl, $tax, $total, $curr);

        if (!$stmt->execute()) {
            throw new Exception("INSERT invoice gagal: " . $stmt->error);
        }

        $id_invoice = $conn->insert_id;

    } else {

        if (!$id) throw new Exception("ID Invoice tidak valid");

        $stmtGet = $conn->prepare("SELECT no_invoice FROM invoice WHERE id = ?");
        $stmtGet->bind_param("i", $id);
        $stmtGet->execute();
        $rowGet     = $stmtGet->get_result()->fetch_assoc();
        $no_invoice = $rowGet['no_invoice'] ?? '';

        $stmt = $conn->prepare("
            UPDATE invoice
            SET id_customer_supplier=?, tanggal_invoice=?, tax_tipe=?, total=?, currency=?
            WHERE id=?
        ");
        $stmt->bind_param("issdsi", $id_cs, $tgl, $tax, $total, $curr, $id);

        if (!$stmt->execute()) {
            throw new Exception("UPDATE invoice gagal: " . $stmt->error);
        }

        $id_invoice = $id;
    }

    $stmtInsItem = $conn->prepare("
        INSERT INTO invoice_item (id_invoice, id_material, nama_material, qty, total, status)
        VALUES (?, ?, ?, ?, ?, 1)
    ");
    $stmtUpdItem = $conn->prepare("
        UPDATE invoice_item
        SET id_material=?, nama_material=?, qty=?, total=?
        WHERE id=?
    ");

    foreach ($items as $it) {
        $item_id      = (int)($it['id'] ?? 0);
        $id_material  = (int)($it['id_material'] ?? 0);
        $nama_material= $it['nama_material'] ?? '';
        $qty          = (int)($it['qty'] ?? 0);
        $item_total   = (float)($it['total'] ?? 0);

        if (!$id_material) continue;

        if ($item_id > 0) {
            $stmtUpdItem->bind_param("isidi", $id_material, $nama_material, $qty, $item_total, $item_id);
            if (!$stmtUpdItem->execute()) {
                throw new Exception("UPDATE item gagal: " . $stmtUpdItem->error);
            }
        } else {
            $stmtInsItem->bind_param("iisid", $id_invoice, $id_material, $nama_material, $qty, $item_total);
            if (!$stmtInsItem->execute()) {
                throw new Exception("INSERT item gagal: " . $stmtInsItem->error);
            }
        }
    }

    $conn->commit();

    echo json_encode([
        "status"     => "success",
        "no_invoice" => $no_invoice,
        "id"         => $id_invoice
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "status"  => "error",
        "message" => $e->getMessage()
    ]);
}
