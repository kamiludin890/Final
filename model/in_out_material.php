<?php

include $_SERVER['DOCUMENT_ROOT'] . '/database/koneksi.php';

header('Content-Type: application/json');

$status = $_POST['status'] ?? '';

try {
    if ($status == "INSERT") {

        $stmt = $conn->prepare("
            INSERT INTO in_out_material
            (
                no_doc,
                tanggal_doc,
                tanggal_in_out,
                jenis_doc,
                tipe_doc,
                id_customer_supplier
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssssi",

            $_POST['no_doc'],
            $_POST['tanggal_doc'],
            $_POST['tanggal_in_out'],
            $_POST['jenis_doc'],
            $_POST['tipe_doc'],
            $_POST['id_customer_supplier']
        );

        if (!$stmt->execute()) {

            throw new Exception($stmt->error);
        }

        $id_document = $conn->insert_id;

        $items = json_decode($_POST['items'], true);

        foreach ($items as $item) {

            $stmtItem = $conn->prepare("
                INSERT INTO in_out_material_item
                (
                    id_document,
                    id_material,
                    nama_material,
                    qty,
                    satuan,
                    kode_material_customer_supplier,
                    status
                )
                VALUES (?, ?, ?, ?, ?, ?, 1)
            ");

            $stmtItem->bind_param(
                "iisiss",

                $id_document,
                $item['id_material'],
                $item['nama_material'],
                $item['qty'],
                $item['satuan'],
                $item['kode_material_customer_supplier']
            );

            if (!$stmtItem->execute()) {

                throw new Exception($stmtItem->error);
            }
        }

        echo json_encode([
            "status" => "success",
            "message" => "Data berhasil disimpan"
        ]);
    } elseif ($status == "UPDATE") {

        $id = $_POST['id'] ?? 0;

        if (!$id) {

            throw new Exception("ID document tidak ditemukan");
        }

        $stmt = $conn->prepare("
            UPDATE in_out_material
            SET
                no_doc = ?,
                tanggal_doc = ?,
                tanggal_in_out = ?,
                jenis_doc = ?,
                tipe_doc = ?,
                id_customer_supplier = ?
            WHERE id = ?
        ");

        $stmt->bind_param(
            "sssssii",

            $_POST['no_doc'],
            $_POST['tanggal_doc'],
            $_POST['tanggal_in_out'],
            $_POST['jenis_doc'],
            $_POST['tipe_doc'],
            $_POST['id_customer_supplier'],
            $id
        );

        if (!$stmt->execute()) {

            throw new Exception($stmt->error);
        }
        $items = json_decode($_POST['items'], true);
        $existingIds = [];

        $queryOld = "
            SELECT id
            FROM in_out_material_item
            WHERE id_document = ?
            AND status = 1
        ";

        $stmtOld = $conn->prepare($queryOld);

        $stmtOld->bind_param("i", $id);

        $stmtOld->execute();

        $resOld = $stmtOld->get_result();

        while ($row = $resOld->fetch_assoc()) {

            $existingIds[] = $row['id'];
        }
        $activeIds = [];

        foreach ($items as $item) {

            $itemId = $item['id'] ?? '';
            if ($itemId != '') {

                $activeIds[] = $itemId;

                $stmtItem = $conn->prepare("
                    UPDATE in_out_material_item
                    SET
                        id_material = ?,
                        nama_material = ?,
                        qty = ?,
                        satuan = ?,
                        kode_material_customer_supplier = ?
                    WHERE id = ?
                ");

                $stmtItem->bind_param(
                    "isissi",

                    $item['id_material'],
                    $item['nama_material'],
                    $item['qty'],
                    $item['satuan'],
                    $item['kode_material_customer_supplier'],
                    $itemId
                );

                if (!$stmtItem->execute()) {

                    throw new Exception($stmtItem->error);
                }
            } else {

                $stmtInsert = $conn->prepare("
                    INSERT INTO in_out_material_item
                    (
                        id_document,
                        id_material,
                        nama_material,
                        qty,
                        satuan,
                        kode_material_customer_supplier,
                        status
                    )
                    VALUES (?, ?, ?, ?, ?, ?, 1)
                ");

                $stmtInsert->bind_param(
                    "iisiss",

                    $id,
                    $item['id_material'],
                    $item['nama_material'],
                    $item['qty'],
                    $item['satuan'],
                    $item['kode_material_customer_supplier']
                );

                if (!$stmtInsert->execute()) {

                    throw new Exception($stmtInsert->error);
                }
            }
        }
        foreach ($existingIds as $oldId) {

            if (!in_array($oldId, $activeIds)) {

                $stmtDelete = $conn->prepare("
                    UPDATE in_out_material_item
                    SET status = 0
                    WHERE id = ?
                ");

                $stmtDelete->bind_param(
                    "i",
                    $oldId
                );

                if (!$stmtDelete->execute()) {

                    throw new Exception($stmtDelete->error);
                }
            }
        }

        echo json_encode([
            "status" => "success",
            "message" => "Data berhasil diupdate"
        ]);
    } elseif ($status == "DELETE") {
        $stmt = $conn->prepare("
            UPDATE in_out_material
            SET status = 0
            WHERE id = ?
        ");

        $stmt->bind_param(
            "i",
            $_POST['id']
        );

        if (!$stmt->execute()) {

            throw new Exception($stmt->error);
        }
        $stmtItem = $conn->prepare("
            UPDATE in_out_material_item
            SET status = 0
            WHERE id_document = ?
        ");

        $stmtItem->bind_param(
            "i",
            $_POST['id']
        );

        if (!$stmtItem->execute()) {

            throw new Exception($stmtItem->error);
        }

        echo json_encode([
            "status" => "success",
            "message" => "Data berhasil dihapus"
        ]);
    }
} catch (Exception $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
