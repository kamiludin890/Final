<?php

$file = $_SERVER['DOCUMENT_ROOT'] . '/database/company.php';

if (file_exists($file)) {
    include $file;
} else {
    $company_name = 'Isi data company di pengaturan';
    $company_code = '';
    $address      = '';
    $email        = '';
    $tax_number   = '';
}

$id = (int)($_POST['id'] ?? 0);

ob_start();

$_POST['id'] = $id;

include $_SERVER['DOCUMENT_ROOT'] . '/model/get_invoice.php';

$json = ob_get_clean();

$data   = json_decode($json, true);
$header = $data['header'] ?? [];
$items  = $data['items']  ?? [];

if (isset($_POST['excel'])) {

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=invoice_" . ($header['no_invoice'] ?? 'export') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $gt = 0;
    foreach ($items as $row) { $gt += (float)($row['total'] ?? 0); }
    $tp     = $header['tax_tipe'] ?? '-';
    $curr   = $header['currency'] ?? '';
    $taxAmt = 0; $taxLbl = '';
    $afterTax = $gt;
    if (strtolower($tp) === 'ppn')    { $taxAmt = $gt * 0.11; $taxLbl = 'PPN 11%';    $afterTax = $gt + $taxAmt; }
    if (strtolower($tp) === 'ppn_bm') { $taxAmt = $gt * 0.20; $taxLbl = 'PPnBM 20%'; $afterTax = $gt + $taxAmt; }
    ?>
    <html><head><meta charset="UTF-8"></head><body>
    <table border="0" cellpadding="4" cellspacing="0" style="font-family:Arial;font-size:12px;">
        <tr><td colspan="6" style="font-size:20px;font-weight:bold;"><?= htmlspecialchars($company_name) ?></td></tr>
        <tr><td colspan="6" style="font-size:11px;color:#555;"><?= htmlspecialchars($address ?? '') ?> &nbsp;|&nbsp; <?= htmlspecialchars($email ?? '') ?> &nbsp;|&nbsp; NPWP: <?= htmlspecialchars($tax_number ?? '') ?></td></tr>
        <tr><td colspan="6">&nbsp;</td></tr>
        <tr>
            <td colspan="3"><b>No Invoice</b></td>
            <td colspan="3"><?= htmlspecialchars($header['no_invoice'] ?? '-') ?></td>
        </tr>
        <tr>
            <td colspan="3"><b>Tanggal Invoice</b></td>
            <td colspan="3"><?= htmlspecialchars($header['tanggal_invoice'] ?? '-') ?></td>
        </tr>
        <tr>
            <td colspan="3"><b><?= ucfirst($header['tipe'] ?? 'Customer/Supplier') ?></b></td>
            <td colspan="3"><?= htmlspecialchars($header['nama_customer_supplier'] ?? '-') ?></td>
        </tr>
        <tr>
            <td colspan="3"><b>Mata Uang</b></td>
            <td colspan="3"><?= htmlspecialchars($curr) ?></td>
        </tr>
        <tr>
            <td colspan="3"><b>Tipe Pajak</b></td>
            <td colspan="3"><?= htmlspecialchars($tp) ?></td>
        </tr>
        <tr><td colspan="6">&nbsp;</td></tr>
        <tr style="background:#1a1a2e;color:#fff;">
            <th style="border:1px solid #000;padding:8px;text-align:center;">No</th>
            <th style="border:1px solid #000;padding:8px;">Kode Material</th>
            <th style="border:1px solid #000;padding:8px;">Nama Material</th>
            <th style="border:1px solid #000;padding:8px;text-align:center;">Qty</th>
            <th style="border:1px solid #000;padding:8px;text-align:right;">Harga Satuan (<?= htmlspecialchars($curr) ?>)</th>
            <th style="border:1px solid #000;padding:8px;text-align:right;">Total (<?= htmlspecialchars($curr) ?>)</th>
        </tr>
        <?php $no = 1; foreach ($items as $row):
            $qty   = (int)($row['qty'] ?? 0);
            $tot   = (float)($row['total'] ?? 0);
            $harga = $qty > 0 ? $tot / $qty : 0;
        ?>
        <tr>
            <td style="border:1px solid #ccc;padding:6px;text-align:center;"><?= $no++ ?></td>
            <td style="border:1px solid #ccc;padding:6px;"><?= htmlspecialchars($row['kode_material'] ?? '-') ?></td>
            <td style="border:1px solid #ccc;padding:6px;"><?= htmlspecialchars($row['nama_material'] ?? '-') ?></td>
            <td style="border:1px solid #ccc;padding:6px;text-align:center;"><?= number_format($qty) ?></td>
            <td style="border:1px solid #ccc;padding:6px;text-align:right;"><?= number_format($harga, 2) ?></td>
            <td style="border:1px solid #ccc;padding:6px;text-align:right;"><?= number_format($tot, 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" style="border:1px solid #ccc;padding:6px;text-align:right;"><b>Sub Total</b></td>
            <td style="border:1px solid #ccc;padding:6px;text-align:right;"><?= number_format($gt, 2) ?></td>
        </tr>
        <?php if ($taxAmt > 0): ?>
        <tr>
            <td colspan="5" style="border:1px solid #ccc;padding:6px;text-align:right;"><b><?= $taxLbl ?></b></td>
            <td style="border:1px solid #ccc;padding:6px;text-align:right;"><?= number_format($taxAmt, 2) ?></td>
        </tr>
        <?php endif; ?>
        <tr style="background:#1a1a2e;color:#fff;">
            <td colspan="5" style="border:1px solid #000;padding:8px;text-align:right;"><b>GRAND TOTAL (<?= htmlspecialchars($curr) ?>)</b></td>
            <td style="border:1px solid #000;padding:8px;text-align:right;"><b><?= number_format($afterTax, 2) ?></b></td>
        </tr>
        <tr><td colspan="6">&nbsp;</td></tr>
        <tr><td colspan="3">&nbsp;</td><td colspan="3" style="text-align:center;">Hormat Kami,<br><br><br><?= htmlspecialchars($company_name) ?></td></tr>
    </table>
    </body></html>
    <?php
    exit;

} elseif (isset($_POST['print'])) {

    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/header.php';

} else {

    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';
?>

    <div class="mt-2 mb-3 d-flex gap-2">
        <button class="btn btn-success" id="excel">
            <i class="bi bi-file-earmark-excel me-1"></i> Excel
        </button>
        <button class="btn btn-warning" id="print">
            <i class="bi bi-printer me-1"></i> Print
        </button>
    </div>

<?php
}
?>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #1a1a2e;
    }
    .inv-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 10px 20px 30px;
        background: #fff;
    }

    .inv-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 3px solid #1a1a2e;
        padding-bottom: 14px;
        margin-bottom: 18px;
    }

    .inv-company-name {
        font-size: 26px;
        font-weight: 800;
        color: #1a1a2e;
        letter-spacing: 1px;
        text-transform: uppercase;
        line-height: 1.1;
    }

    .inv-company-sub {
        font-size: 11px;
        color: #555;
        margin-top: 4px;
    }

    .inv-title-block {
        text-align: right;
    }

    .inv-title {
        font-size: 28px;
        font-weight: 900;
        color: #c0392b;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .inv-no {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a2e;
        margin-top: 4px;
    }

    .inv-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 20px;
    }

    .inv-meta-box {
        flex: 1;
    }

    .inv-meta-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: #888;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .inv-meta-value {
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .inv-meta-sub {
        font-size: 11px;
        color: #555;
        line-height: 1.6;
    }

    .inv-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 0;
    }

    .inv-table thead tr {
        background: #1a1a2e;
        color: #fff;
    }

    .inv-table th {
        padding: 9px 10px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: 1px solid #1a1a2e;
    }

    .inv-table td {
        padding: 8px 10px;
        border: 1px solid #ccc;
        font-size: 12px;
        vertical-align: middle;
    }

    .inv-table tbody tr:nth-child(even) {
        background: #f8f9fa;
    }

    .inv-table tfoot tr {
        background: #f0f0f0;
    }

    .inv-table tfoot td {
        border: 1px solid #aaa;
        font-weight: 700;
        font-size: 12px;
    }

    .text-right  { text-align: right; }
    .text-center { text-align: center; }

    .grand-total-row td {
        background: #1a1a2e !important;
        color: #fff !important;
        font-size: 13px !important;
        border-color: #1a1a2e !important;
    }

    .inv-footer-info {
        margin-top: 0;
        border-top: 2px solid #1a1a2e;
    }

    .inv-footer-info table td {
        padding: 4px 6px;
        font-size: 12px;
    }

    .inv-sign {
        display: flex;
        justify-content: flex-end;
        margin-top: 36px;
    }

    .inv-sign-box {
        text-align: center;
        width: 180px;
    }

    .inv-sign-line {
        border-top: 1px solid #1a1a2e;
        margin-top: 50px;
        padding-top: 4px;
        font-size: 11px;
        color: #555;
    }

    @media print {
        .btn, .btn-group, nav, #btn-kembali {
            display: none !important;
        }
        .inv-wrapper {
            max-width: 100%;
            padding: 0;
        }
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<?php
$grand_total = 0;
foreach ($items as $item) {
    $grand_total += (float)($item['total'] ?? 0);
}

$tax_tipe = $header['tax_tipe'] ?? '-';
$currency = $header['currency'] ?? '';
$tax_amount    = 0;
$tax_label     = '';
$amount_after_tax = $grand_total;

if (strtolower($tax_tipe) === 'ppn') {
    $tax_amount       = $grand_total * 0.11;
    $tax_label        = 'PPN 11%';
    $amount_after_tax = $grand_total + $tax_amount;
} elseif (strtolower($tax_tipe) === 'ppn_bm') {
    $tax_amount       = $grand_total * 0.20;
    $tax_label        = 'PPnBM 20%';
    $amount_after_tax = $grand_total + $tax_amount;
}
?>

<div class="inv-wrapper">

    <div class="inv-header">
        <div>
            <div class="inv-company-name"><?= htmlspecialchars($company_name) ?></div>
            <div class="inv-company-sub">
                <?= htmlspecialchars($address ?? '') ?><br>
                <?= htmlspecialchars($email ?? '') ?> &nbsp;|&nbsp; NPWP: <?= htmlspecialchars($tax_number ?? '') ?>
            </div>
        </div>
        <div class="inv-title-block">
            <div class="inv-title">Invoice</div>
            <div class="inv-no"><?= htmlspecialchars($header['no_invoice'] ?? '-') ?></div>
        </div>
    </div>

    <div class="inv-meta">

        <div class="inv-meta-box">
            <div class="inv-meta-label">
                <?= ucfirst($header['tipe'] ?? 'Customer / Supplier') ?>
            </div>
            <div class="inv-meta-value">
                <?= htmlspecialchars($header['nama_customer_supplier'] ?? '-') ?>
            </div>
            <div class="inv-meta-sub">
                <?= nl2br(htmlspecialchars($header['alamat'] ?? '')) ?><br>
                <?php if (!empty($header['phone'])): ?>
                    Tel: <?= htmlspecialchars($header['phone']) ?><br>
                <?php endif; ?>
                <?php if (!empty($header['email_cs'])): ?>
                    <?= htmlspecialchars($header['email_cs']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="inv-meta-box" style="text-align:right;">
            <div>
                <div class="inv-meta-label">Tanggal Invoice</div>
                <div class="inv-meta-value">
                    <?= htmlspecialchars($header['tanggal_invoice'] ?? '-') ?>
                </div>
            </div>
            <div style="margin-top:10px;">
                <div class="inv-meta-label">Mata Uang</div>
                <div class="inv-meta-value"><?= htmlspecialchars($currency) ?></div>
            </div>
            <div style="margin-top:10px;">
                <div class="inv-meta-label">Tipe Pajak</div>
                <div class="inv-meta-value"><?= htmlspecialchars($tax_tipe) ?></div>
            </div>
        </div>

    </div>

    <table class="inv-table">
        <thead>
            <tr>
                <th class="text-center" style="width:40px;">No</th>
                <th style="width:110px;">Kode Material</th>
                <th>Nama Material</th>
                <th class="text-center" style="width:70px;">Qty</th>
                <th class="text-right" style="width:140px;">
                    Harga Satuan (<?= htmlspecialchars($currency) ?>)
                </th>
                <th class="text-right" style="width:140px;">
                    Total (<?= htmlspecialchars($currency) ?>)
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($items as $item):
                $qty         = (int)($item['qty'] ?? 0);
                $total_item  = (float)($item['total'] ?? 0);
                $harga_satuan = ($qty > 0) ? $total_item / $qty : 0;
            ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($item['kode_material'] ?? '-') ?></td>
                <td><?= htmlspecialchars($item['nama_material'] ?? '-') ?></td>
                <td class="text-center"><?= number_format($qty) ?></td>
                <td class="text-right"><?= number_format($harga_satuan, 2) ?></td>
                <td class="text-right"><?= number_format($total_item, 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">Sub Total</td>
                <td class="text-right"><?= number_format($grand_total, 2) ?></td>
            </tr>

            <?php if ($tax_amount > 0): ?>
            <tr>
                <td colspan="5" class="text-right"><?= $tax_label ?></td>
                <td class="text-right"><?= number_format($tax_amount, 2) ?></td>
            </tr>
            <?php endif; ?>

            <tr class="grand-total-row">
                <td colspan="5" class="text-right">
                    <strong>GRAND TOTAL (<?= htmlspecialchars($currency) ?>)</strong>
                </td>
                <td class="text-right">
                    <strong><?= number_format($amount_after_tax, 2) ?></strong>
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="inv-sign">
        <div class="inv-sign-box">
            <div class="inv-sign-line">
                Hormat Kami,<br>
                <strong><?= htmlspecialchars($company_name) ?></strong>
            </div>
        </div>
    </div>

</div>

<script>
<?php if (!isset($_POST['excel']) && !isset($_POST['print'])): ?>

    function exportExcel() {
        let form = $('<form>', {
            method: 'POST',
            action: '/view/print/invoice.php'
        });

        form.append($('<input>', { type: 'hidden', name: 'id',    value: '<?= $id ?>' }));
        form.append($('<input>', { type: 'hidden', name: 'excel', value: 1 }));

        $('body').append(form);
        form.submit();
        form.remove();
    }

    function printData() {
        window.open('', 'invPopup', 'width=1050,height=750,left=80,top=40');

        let form = $('<form>', {
            method: 'POST',
            action: '/view/print/invoice.php',
            target: 'invPopup'
        });

        form.append($('<input>', { type: 'hidden', name: 'id',    value: '<?= $id ?>' }));
        form.append($('<input>', { type: 'hidden', name: 'print', value: 1 }));

        $('body').append(form);
        form.submit();
        form.remove();
    }

    $('#excel').off('click').on('click', function () { exportExcel(); });
    $('#print').off('click').on('click',  function () { printData();   });

<?php elseif (isset($_POST['print'])): ?>

    window.onload = function () {
        window.print();
    };

<?php endif; ?>
</script>