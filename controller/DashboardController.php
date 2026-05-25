<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

function convertToIDR($amount, $currency, $conn)
{
    $currency = strtoupper(trim($currency));
    if ($currency === 'IDR' || $currency === '') {
        return $amount;
    }

    $stmt = $conn->prepare("SELECT rate FROM currency_rate WHERE UPPER(currency) = ? ORDER BY tanggal DESC LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("s", $currency);
        if ($stmt->execute()) {
            $res = $stmt->get_result();
            if ($row = $res->fetch_assoc()) {
                return $amount * (float)$row['rate'];
            }
        }
    }

    $fallbacks = [
        'USD' => 16000.0,
        'SGD' => 11800.0,
        'EUR' => 17200.0,
        'JPY' => 102.0,
    ];

    $rate = $fallbacks[$currency] ?? 1.0;
    return $amount * $rate;
}

try {
    $resMaterial = $conn->query("SELECT COUNT(*) AS total FROM material WHERE status = 1");
    $totalMaterials = $resMaterial ? (int)$resMaterial->fetch_assoc()['total'] : 0;
    $resInvoices = $conn->query("SELECT COUNT(*) AS total FROM invoice WHERE status = 1");
    $totalInvoices = $resInvoices ? (int)$resInvoices->fetch_assoc()['total'] : 0;
    $resRevenue = $conn->query("
        SELECT inv.currency, SUM(inv.total) AS total_val
        FROM invoice inv
        JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
        WHERE inv.status = 1 AND cs.tipe = 'customer'
        GROUP BY inv.currency
    ");
    $revenueList = [];
    $totalRevenueIDR = 0;
    if ($resRevenue) {
        while ($row = $resRevenue->fetch_assoc()) {
            $curr = strtoupper($row['currency']);
            $val = (float)$row['total_val'];
            $revenueList[] = $curr . ' ' . number_format($val, 2, ',', '.');
            $totalRevenueIDR += convertToIDR($val, $curr, $conn);
        }
    }
    $revenueStr = !empty($revenueList) ? implode(' | ', $revenueList) : 'IDR 0,00';
    $resExpense = $conn->query("
        SELECT inv.currency, SUM(inv.total) AS total_val
        FROM invoice inv
        JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
        WHERE inv.status = 1 AND cs.tipe = 'supplier'
        GROUP BY inv.currency
    ");
    $expenseList = [];
    $totalExpenseIDR = 0;
    if ($resExpense) {
        while ($row = $resExpense->fetch_assoc()) {
            $curr = strtoupper($row['currency']);
            $val = (float)$row['total_val'];
            $expenseList[] = $curr . ' ' . number_format($val, 2, ',', '.');
            $totalExpenseIDR += convertToIDR($val, $curr, $conn);
        }
    }
    $expenseStr = !empty($expenseList) ? implode(' | ', $expenseList) : 'IDR 0,00';
    $salesMonthly = array_fill(1, 12, 0);
    $purchasesMonthly = array_fill(1, 12, 0);

    $resMonthlySales = $conn->query("
        SELECT MONTH(inv.tanggal_invoice) AS bln, inv.total, inv.currency
        FROM invoice inv
        JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
        WHERE inv.status = 1 AND cs.tipe = 'customer' AND YEAR(inv.tanggal_invoice) = YEAR(CURDATE())
    ");
    if ($resMonthlySales) {
        while ($row = $resMonthlySales->fetch_assoc()) {
            $bln = (int)$row['bln'];
            $val = (float)$row['total'];
            $curr = $row['currency'];
            $salesMonthly[$bln] += convertToIDR($val, $curr, $conn);
        }
    }

    $resMonthlyPurchases = $conn->query("
        SELECT MONTH(inv.tanggal_invoice) AS bln, inv.total, inv.currency
        FROM invoice inv
        JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
        WHERE inv.status = 1 AND cs.tipe = 'supplier' AND YEAR(inv.tanggal_invoice) = YEAR(CURDATE())
    ");
    if ($resMonthlyPurchases) {
        while ($row = $resMonthlyPurchases->fetch_assoc()) {
            $bln = (int)$row['bln'];
            $val = (float)$row['total'];
            $curr = $row['currency'];
            $purchasesMonthly[$bln] += convertToIDR($val, $curr, $conn);
        }
    }
    $resCategory = $conn->query("
        SELECT tm.nama_tipe_material, SUM(ii.qty) AS total_qty
        FROM invoice_item ii
        JOIN invoice inv ON ii.id_invoice = inv.id
        JOIN customer_supplier cs ON inv.id_customer_supplier = cs.id
        JOIN material m ON ii.id_material = m.id
        JOIN tipe_material tm ON m.tipe_material = tm.id
        WHERE inv.status = 1 AND ii.status = 1 AND cs.tipe = 'customer'
        GROUP BY tm.nama_tipe_material
        ORDER BY total_qty DESC
        LIMIT 5
    ");

    $kategori = [];
    $kategoriJumlah = [];
    if ($resCategory) {
        while ($row = $resCategory->fetch_assoc()) {
            $kategori[] = $row['nama_tipe_material'];
            $kategoriJumlah[] = (int)$row['total_qty'];
        }
    }
    if (empty($kategori)) {
        $kategori = ["Belum Ada Penjualan"];
        $kategoriJumlah = [0];
    }

    $data = [
        "total_materials" => $totalMaterials,
        "total_invoices" => $totalInvoices,
        "total_revenue" => $revenueStr,
        "total_expense" => $expenseStr,
        "total_revenue_idr" => $totalRevenueIDR,
        "total_expense_idr" => $totalExpenseIDR,
        "bulan" => ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        "penjualan_bulanan" => array_values($salesMonthly),
        "pembelian_bulanan" => array_values($purchasesMonthly),
        "kategori" => $kategori,
        "kategori_jumlah" => $kategoriJumlah
    ];

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
