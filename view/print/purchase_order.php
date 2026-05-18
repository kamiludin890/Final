<?php

$file = $_SERVER['DOCUMENT_ROOT'] . '/database/company.php';

if (file_exists($file)) {
    include $file;
} else {
    $company_name = 'Isi data company di pengaturan';
    $company_code = '';
    $email = '';
    $tax_number = '';
}

$id = $_POST['id'];

ob_start();

$_POST['id'] = $id;

include $_SERVER['DOCUMENT_ROOT'] . '/model/get_purchase_order.php';

$json = ob_get_clean();

$data = json_decode($json, true);

$header = $data['header'];
$items  = $data['items'];

if (isset($_POST['excel'])) {

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=purchase_order.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
} elseif (isset($_POST['print'])) {

    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/header.php';
} else {

    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';
?>

    <div class="mt-2 mb-3">
        <button class="btn btn-success" id="excel">
            Excel
        </button>

        <button class="btn btn-warning" id="print">
            Print
        </button>
    </div>

<?php
}
?>

<style>
    .company-name {
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .info-table td {
        padding: 5px;
    }

    .po-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    .po-table th,
    .po-table td {
        border: 1px solid #000;
        padding: 8px;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }
</style>

<div class="company-name">
    <?= $company_name ?>
</div>

<table width="100%" class="info-table">

    <tr>

        <td width="20%">
            PO Number
        </td>

        <td width="2%">
            :
        </td>

        <td>
            <?= $header['no_purchase_order'] ?? '-' ?>
        </td>

    </tr>

    <tr>

        <td>
            Tanggal
        </td>

        <td>
            :
        </td>

        <td>
            <?= $header['tanggal_purchase_order'] ?? '-' ?>
        </td>

    </tr>

    <tr>

        <td>
            <?= ucfirst($header['tipe']) ?? 'Customer/Supplier' ?>
        </td>

        <td>
            :
        </td>

        <td>
            <?= $header['nama_customer_supplier'] ?? '-' ?>
        </td>

    </tr>

</table>

<table width="100%" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin-top:20px;">

    <thead>

        <tr>

            <th style="border:1px solid black;">
                No
            </th>

            <th style="border:1px solid black;">
                Kode Material
            </th>

            <th style="border:1px solid black;">
                Nama Material
            </th>

            <th style="border:1px solid black;">
                Qty
            </th>

            <th style="border:1px solid black;">
                Harga
            </th>

            <th style="border:1px solid black;">
                Total
            </th>

        </tr>

    </thead>

    <tbody>

        <?php
        $no = 1;
        $grand_total = 0;

        foreach ($items as $item):

            $grand_total += $item['total'];
        ?>

            <tr>

                <td align="center" style="border:1px solid black;">
                    <?= $no++ ?>
                </td>

                <td style="border:1px solid black;">
                    <?= $item['kode_material'] ?>
                </td>

                <td style="border:1px solid black;">
                    <?= $item['nama_material'] ?>
                </td>

                <td align="right" style="border:1px solid black;">
                    <?= number_format($item['qty']) ?>
                </td>

                <td align="right" style="border:1px solid black;">
                    <?= number_format($item['price']) ?>
                </td>

                <td align="right" style="border:1px solid black;">
                    <?= number_format($item['total']) ?>
                </td>

            </tr>

        <?php endforeach; ?>

        <tr>

            <td colspan="5"
                align="right"
                style="border:1px solid black;">

                <strong>Grand Total</strong>

            </td>

            <td align="right"
                style="border:1px solid black;">

                <strong>
                    <?= number_format($grand_total) ?>
                </strong>

            </td>

        </tr>

    </tbody>

</table>
<script>
    <?php
    if (!isset($_POST['excel']) && !isset($_POST['print'])) {
    ?>

        function exportExcel() {

            let form = $('<form>', {
                method: 'POST',
                action: '/view/print/purchase_order.php'
            });

            form.append($('<input>', {
                type: 'hidden',
                name: 'id',
                value: '<?= $id ?>'
            }));

            form.append($('<input>', {
                type: 'hidden',
                name: 'excel',
                value: 1
            }));

            $('body').append(form);

            form.submit();

            form.remove();
        }

        function printData() {

            window.open(
                '',
                'popupWindow',
                'width=1000,height=700,left=100,top=50'
            );

            let form = $('<form>', {
                method: 'POST',
                action: '/view/print/purchase_order.php',
                target: 'popupWindow'
            });

            form.append($('<input>', {
                type: 'hidden',
                name: 'id',
                value: '<?= $id ?>'
            }));

            form.append($('<input>', {
                type: 'hidden',
                name: 'print',
                value: 1
            }));

            $('body').append(form);

            form.submit();

            form.remove();
        }

        $("#excel").click(function() {
            exportExcel();
        });

        $("#print").click(function() {
            printData();
        });

    <?php
    } elseif (isset($_POST['print'])) {
    ?>

        window.onload = function() {
            window.print();
        }

    <?php
    }
    ?>
</script>