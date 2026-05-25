<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

try {
    $tanggal_mulai = $_POST['tanggal_mulai'] ?? '';
    $tanggal_selesai = $_POST['tanggal_selesai'] ?? '';
    $id_tipe_material = $_POST['id_tipe_material'] ?? '';

    // Default to current month if dates are empty
    if (empty($tanggal_mulai)) {
        $tanggal_mulai = date('Y-m-01');
    }
    if (empty($tanggal_selesai)) {
        $tanggal_selesai = date('Y-m-t');
    }

    // Base query utilizing the brilliant mutasi stok logic
    $query = "
        SELECT 
            m.id,
            m.kode_material,
            m.nama_material_internal,
            m.satuan,
            m.harga,
            m.currency,
            tm.nama_tipe_material,
            
            -- Stok Awal (before start date)
            COALESCE((
                SELECT SUM(CASE WHEN doc.tipe_doc IN ('IN', 'IMPORT') THEN mi.qty ELSE -mi.qty END)
                FROM in_out_material_item mi
                JOIN in_out_material doc ON mi.id_document = doc.id
                WHERE mi.id_material = m.id AND mi.status = 1 AND doc.status = 1
                  AND doc.tanggal_in_out < ?
            ), 0) AS stok_awal,
            
            -- Barang Masuk (within date range)
            COALESCE((
                SELECT SUM(mi.qty)
                FROM in_out_material_item mi
                JOIN in_out_material doc ON mi.id_document = doc.id
                WHERE mi.id_material = m.id AND mi.status = 1 AND doc.status = 1
                  AND doc.tipe_doc IN ('IN', 'IMPORT')
                  AND doc.tanggal_in_out BETWEEN ? AND ?
            ), 0) AS qty_masuk,
            
            -- Barang Keluar (within date range)
            COALESCE((
                SELECT SUM(mi.qty)
                FROM in_out_material_item mi
                JOIN in_out_material doc ON mi.id_document = doc.id
                WHERE mi.id_material = m.id AND mi.status = 1 AND doc.status = 1
                  AND doc.tipe_doc IN ('OUT', 'EXPORT')
                  AND doc.tanggal_in_out BETWEEN ? AND ?
            ), 0) AS qty_keluar

        FROM material m
        LEFT JOIN tipe_material tm ON m.tipe_material = tm.id
        WHERE m.status = 1
    ";

    // Append filter for material type if supplied
    if (!empty($id_tipe_material)) {
        $query .= " AND m.tipe_material = ? ";
    }

    $query .= " ORDER BY m.kode_material ASC ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    // Bind parameters conditionally
    if (!empty($id_tipe_material)) {
        $id_tipe_material = (int)$id_tipe_material;
        $stmt->bind_param("ssssssi", 
            $tanggal_mulai, 
            $tanggal_mulai, $tanggal_selesai, 
            $tanggal_mulai, $tanggal_selesai, 
            $id_tipe_material
        );
    } else {
        $stmt->bind_param("sssss", 
            $tanggal_mulai, 
            $tanggal_mulai, $tanggal_selesai, 
            $tanggal_mulai, $tanggal_selesai
        );
    }

    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $res = $stmt->get_result();
    $reportData = [];

    // Summary aggregates
    $totalAssetValuationIDR = 0;
    $totalUniqueMaterials = 0;
    
    // Fallback convert helper to calculate total asset valuation in IDR
    $fallbacks = [
        'USD' => 16000.0,
        'SGD' => 11800.0,
        'EUR' => 17200.0,
        'JPY' => 102.0,
        'IDR' => 1.0
    ];

    while ($row = $res->fetch_assoc()) {
        $stok_awal = (int)$row['stok_awal'];
        $qty_masuk = (int)$row['qty_masuk'];
        $qty_keluar = (int)$row['qty_keluar'];
        $stok_akhir = $stok_awal + $qty_masuk - $qty_keluar;
        
        $harga = (float)$row['harga'];
        $asset_value = $stok_akhir * $harga;
        
        $row['stok_awal'] = $stok_awal;
        $row['qty_masuk'] = $qty_masuk;
        $row['qty_keluar'] = $qty_keluar;
        $row['stok_akhir'] = $stok_akhir;
        $row['asset_value'] = $asset_value;

        // Calculate Asset Value in IDR for summary
        $curr = strtoupper(trim($row['currency']));
        if (empty($curr)) $curr = 'IDR';
        $rate = $fallbacks[$curr] ?? 1.0;
        
        // Also look up latest currency_rate from DB
        $stmtRate = $conn->prepare("SELECT rate FROM currency_rate WHERE UPPER(currency) = ? ORDER BY tanggal DESC LIMIT 1");
        if ($stmtRate) {
            $stmtRate->bind_param("s", $curr);
            if ($stmtRate->execute()) {
                $resRate = $stmtRate->get_result();
                if ($rowRate = $resRate->fetch_assoc()) {
                    $rate = (float)$rowRate['rate'];
                }
            }
        }
        
        $totalAssetValuationIDR += ($asset_value * $rate);
        $totalUniqueMaterials++;

        $reportData[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "filter" => [
            "tanggal_mulai" => $tanggal_mulai,
            "tanggal_selesai" => $tanggal_selesai,
            "id_tipe_material" => $id_tipe_material
        ],
        "summary" => [
            "total_items" => $totalUniqueMaterials,
            "total_asset_valuation_idr" => $totalAssetValuationIDR
        ],
        "data" => $reportData
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
