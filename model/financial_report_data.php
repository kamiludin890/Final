<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

try {
    $tanggal_mulai = $_POST['tanggal_mulai'] ?? '';
    $tanggal_selesai = $_POST['tanggal_selesai'] ?? '';
    if (empty($tanggal_mulai)) {
        $tanggal_mulai = date('Y-m-01');
    }
    if (empty($tanggal_selesai)) {
        $tanggal_selesai = date('Y-m-t');
    }
    $query = "
        SELECT 
            inv.id,
            inv.no_invoice,
            inv.tanggal_invoice,
            inv.tax_tipe,
            inv.total,
            inv.currency,
            cs.nama_customer_supplier,
            cs.tipe AS cs_tipe
        FROM invoice inv
        JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
        WHERE inv.status = 1 
          AND inv.tanggal_invoice BETWEEN ? AND ?
        ORDER BY inv.tanggal_invoice DESC, inv.id DESC
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $tanggal_mulai, $tanggal_selesai);
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $res = $stmt->get_result();
    $transactions = [];
    $summary = [];

    while ($row = $res->fetch_assoc()) {
        $curr = strtoupper(trim($row['currency']));
        if (empty($curr)) {
            $curr = 'IDR';
        }

        $total = (float)$row['total'];
        $type = $row['cs_tipe'];
        if (!isset($summary[$curr])) {
            $summary[$curr] = [
                'revenue' => 0.0,
                'expense' => 0.0,
                'net_profit' => 0.0
            ];
        }
        if ($type === 'customer') {
            $summary[$curr]['revenue'] += $total;
            $row['transaction_type'] = 'Penjualan';
        } else {
            $summary[$curr]['expense'] += $total;
            $row['transaction_type'] = 'Pembelian';
        }

        $transactions[] = $row;
    }
    foreach ($summary as $curr => &$values) {
        $values['net_profit'] = $values['revenue'] - $values['expense'];
    }

    echo json_encode([
        "status" => "success",
        "filter" => [
            "tanggal_mulai" => $tanggal_mulai,
            "tanggal_selesai" => $tanggal_selesai
        ],
        "summary" => $summary,
        "transactions" => $transactions
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
