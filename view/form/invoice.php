<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';

if (isset($_POST['id']) && $_POST['id'] != '') {
    $id     = $_POST['id'];
    $status = "UPDATE";
} else {
    $id     = "";
    $status = "INSERT";
}
?>

<!-- ===== HEADER FORM ===== -->
<div class="row">
    <div class="col-3">
        <label>No Invoice</label>
        <input type="text" id="no_invoice" class="form-control" disabled placeholder="Auto">
    </div>

    <div class="col-5">
        <label>Customer / Supplier</label>
        <select id="id_customer_supplier" class="form-control">
            <option value="">-- Pilih --</option>
        </select>
    </div>

    <div class="col-4">
        <label>Tanggal Invoice</label>
        <input type="date" id="tanggal_invoice" class="form-control" value="<?= date("Y-m-d") ?>">
    </div>
</div>

<div class="row mt-2">
    <div class="col-4">
        <label>Tipe Faktur (Tax)</label>
        <select id="tax_tipe" class="form-control">
            <option value="">-- Pilih --</option>
            <option value="01">01 - Kepada Pihak yang Bukan Pemungut PPN</option>
            <option value="02">02 - Kepada Pemungut Bendaharawan</option>
            <option value="03">03 - Kepada Pemungut Selain Bendaharawan</option>
            <option value="04">04 - DPP Nilai Lain</option>
            <option value="05">05 - Besaran Tertentu</option>
            <option value="06">06 - Penyerahan Lainnya</option>
            <option value="07">07 - PPN Tidak Dipungut</option>
            <option value="08">08 - Dibebaskan dari PPN</option>
            <option value="09">09 - Penyerahan Aktiva Pasal 16D</option>
            <option value="10">10 - Impor BKP / Pemanfaatan JKP dari Luar Daerah</option>
        </select>
    </div>

    <div class="col-4">
        <label>Currency</label>
        <select id="currency" class="form-control">
            <option value="">-- Pilih --</option>
        </select>
    </div>

    <div class="col-4 mt-4">
        <button class="btn btn-primary" id="save-invoice">
            <i class="bi bi-save"></i> Simpan
        </button>
    </div>
</div>

<!-- ===== TABEL ITEM ===== -->
<div class="mt-3 d-flex align-items-center justify-content-between">
    <h6 class="mb-0">Item Invoice</h6>
    <button class="btn btn-success btn-sm" onclick="addItemRow()">+ Tambah Item</button>
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th style="width:160px">Kode Material</th>
            <th>Nama Material</th>
            <th style="width:80px">Qty</th>
            <th style="width:140px">Harga</th>
            <th style="width:140px">Total</th>
            <th style="width:50px">#</th>
        </tr>
    </thead>
    <tbody id="invoice_items"></tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Grand Total</td>
            <td colspan="2">
                <input type="text" id="grand_total" class="form-control" disabled>
            </td>
        </tr>
    </tfoot>
</table>

<datalist id="material-list-inv"></datalist>

<script>
    var noUrut = 1;
    var materialMap = {}; 
    function loadMaterialDatalist() {
        $.post('/model/list_material.php', {}, function (data) {
            let opts = '';
            data.forEach(d => {
                materialMap[d.kode_material] = {
                    id   : d.id,
                    nama : d.nama_material_internal,
                    harga: parseFloat(d.harga || 0)
                };
                opts += `<option value="${d.kode_material}">${d.nama_material_internal}</option>`;
            });
            $('#material-list-inv').html(opts);
        }, 'json');
    }

    $(document).on('change', '.inv-material-code', function () {
        const kode = $(this).val().trim();
        const row  = $(this).closest('tr');
        const mat  = materialMap[kode];

        if (mat) {
            const qty = parseFloat(row.find('.inv-qty').val() || 0);
            row.find('.inv-material-id').val(mat.id);
            row.find('.inv-nama-material').val(mat.nama);
            row.find('.inv-harga').val(mat.harga.toFixed(2));
            row.find('.inv-total').val((qty * mat.harga).toFixed(2));
        } else {
            row.find('.inv-material-id').val('');
            row.find('.inv-harga').val('0.00');
            row.find('.inv-total').val('0.00');
        }
        hitungGrandTotal();
    });

    function hitungGrandTotal() {
        let grandTotal = 0;
        $('#invoice_items tr').each(function () {
            grandTotal += parseFloat($(this).find('.inv-total').val() || 0);
        });
        $('#grand_total').val(grandTotal.toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
    }

    $(document).on('input', '.inv-qty', function () {
        const row   = $(this).closest('tr');
        const qty   = parseFloat($(this).val() || 0);
        const harga = parseFloat(row.find('.inv-harga').val() || 0);
        row.find('.inv-total').val((qty * harga).toFixed(2));
        hitungGrandTotal();
    });

    function addItemRow(item = null) {
        const rowId = noUrut++;
        $('#invoice_items').append(`
            <tr id="inv-row-${rowId}">
                <td>
                    <input type="hidden" class="inv-item-id" value="">
                    <input type="hidden" class="inv-material-id" value="">
                    <input type="text"   class="form-control inv-material-code" list="material-list-inv" placeholder="Kode...">
                </td>
                <td>
                    <input type="text"   class="form-control inv-nama-material" placeholder="Nama material">
                </td>
                <td>
                    <input type="number" class="form-control inv-qty" min="0" value="0">
                </td>
                <td>
                    <input type="number" class="form-control inv-harga" min="0" value="0" disabled>
                </td>
                <td>
                    <input type="number" class="form-control inv-total" min="0" value="0" disabled>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger" onclick="hapusRow(${rowId})">
                        &times;
                    </button>
                </td>
            </tr>
        `);

        if (item) {
            const row   = $(`#inv-row-${rowId}`);
            const qty   = parseFloat(item.qty   || 0);
            const total = parseFloat(item.total || 0);
            const harga = qty > 0 ? (total / qty) : 0;

            row.find('.inv-item-id').val(item.id || '');
            row.find('.inv-material-id').val(item.id_material || '');
            row.find('.inv-material-code').val(item.kode_material || '');
            row.find('.inv-nama-material').val(item.nama_material || '');
            row.find('.inv-qty').val(qty);
            row.find('.inv-harga').val(harga.toFixed(2));
            row.find('.inv-total').val(total.toFixed(2));
        }

        hitungGrandTotal();
    }

    function hapusRow(rowId) {
        $(`#inv-row-${rowId}`).remove();
        hitungGrandTotal();
    }

    function loadDataInvoice(id) {
        $.post('/model/list_invoice.php', { id: id }, function (res) {
            if (!res) return;

            $('#no_invoice').val(res.no_invoice);
            $('#id_customer_supplier').val(res.id_customer_supplier);
            $('#tanggal_invoice').val(res.tanggal_invoice);
            $('#tax_tipe').val(res.tax_tipe);
            $('#currency').val(res.currency);

            $.post('/model/get_invoice_items.php', { id_invoice: id }, function (items) {
                $('#invoice_items').html('');
                items.forEach(it => addItemRow(it));
                hitungGrandTotal();
            }, 'json');

        }, 'json');
    }

    $(document).ready(function () {
        loadMaterialDatalist();
        $.post('/model/list_customer_supplier.php', { search: '' }, function (data) {
            let opts = '<option value="">-- Pilih --</option>';
            data.forEach(d => {
                opts += `<option value="${d.id}">${d.nama_customer_supplier} (${d.tipe})</option>`;
            });
            $('#id_customer_supplier').html(opts);

            <?php if ($status === "UPDATE") { ?>
                loadDataInvoice(<?= $id ?>);
            <?php } ?>
        }, 'json');
        $.post('/model/list_currency.php', {}, function (data) {
            let opts = '<option value="">-- Pilih --</option>';
            data.forEach(d => {
                opts += `<option value="${d.currency}">${d.currency} - ${d.deskripsi}</option>`;
            });
            $('#currency').html(opts);
        }, 'json');
    });
    $('#save-invoice').click(function () {

        const id_cs  = $('#id_customer_supplier').val();
        const tgl    = $('#tanggal_invoice').val();
        const tax    = $('#tax_tipe').val();
        const curr   = $('#currency').val();

        if (!id_cs || !tgl || !tax || !curr) {
            alert('Harap lengkapi semua field header terlebih dahulu.');
            return;
        }

        let items = [];
        $('#invoice_items tr').each(function () {
            const matId = $(this).find('.inv-material-id').val();
            if (!matId) return;
            items.push({
                id          : $(this).find('.inv-item-id').val(),
                id_material : matId,
                nama_material: $(this).find('.inv-nama-material').val(),
                qty         : $(this).find('.inv-qty').val(),
                total       : $(this).find('.inv-total').val()
            });
        });

        if (items.length === 0) {
            alert('Minimal satu item harus diisi.');
            return;
        }
        let grandTotal = items.reduce((sum, it) => sum + parseFloat(it.total || 0), 0);

        $.post('/model/invoice.php', {
            id                  : '<?= $id ?>',
            status              : '<?= $status ?>',
            id_customer_supplier: id_cs,
            tanggal_invoice     : tgl,
            tax_tipe            : tax,
            currency            : curr,
            total               : grandTotal,
            items               : JSON.stringify(items)
        }, function (res) {
            if (res.status === 'success') {
                $('#no_invoice').val(res.no_invoice);
                alert('Invoice berhasil disimpan! No: ' + res.no_invoice);
            } else {
                alert('Error: ' + res.message);
            }
        }, 'json');
    });
</script>
