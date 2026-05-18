<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';

if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];
    $status = "UPDATE";
} else {
    $id = "";
    $status = "INSERT";
}
?>

<div class="row">
    <div class="col-4">
        <label>No PO</label>
        <input type="text" id="no_po" class="form-control" disabled>
    </div>

    <div class="col-8">
        <label>Perusahaan</label>
        <select id="customer" class="form-control">
            <option value="">-- Pilih --</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-3">
        <label>Tanggal Order</label>
        <input type="date" id="tanggal_order" class="form-control" value="<?= date("Y-m-d") ?>">
    </div>

    <div class="col-3">
        <label>Due Date</label>
        <input type="date" id="tanggal_due_date" class="form-control" value="<?= date("Y-m-d") ?>">
    </div>

    <div class="col mt-4">
        <button class="btn btn-primary" id="save-po">Simpan</button>
    </div>
</div>

<button class="btn btn-success mt-3" onclick="addItemRow()">+ Add Item</button>

<table class="table mt-2">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name Internal</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody id="po_items"></tbody>
</table>
<datalist id="material-list"></datalist>
<script>
    var no_urut = 1;

    function loadMaterialDataList(search) {
        $.post('model/list_material.php', {
            search: search
        }, function(data) {

            let options = '';

            data.forEach(d => {
                options += `
                <option 
                    value="${d.kode_material}" 
                    data-id="${d.id}"
                    data-name-internal="${d.nama_material_internal}" 
                    data-price="${d.harga}">
                    ${d.nama_material_internal}
                </option>
            `;
            });

            $("#material-list").html(options);

        }, 'json');
    }
    $(document).on('input', '.material-code', function() {
        const value = $(this).val();
        loadMaterialDataList(value);
    });
    $(document).on('change', '.material-code', function() {

        const listId = $(this).attr('list');
        const row = $(this).closest('tr');
        const selected = $("#" + listId + " option[value='" + $(this).val() + "']");

        row.find('.material_item-id').val(selected.data('id') || 0);
        row.find('.nama_material_internal').val(selected.data('name-internal') || '');
        row.find('.price').val(selected.data('price') || 0);
    });

    function loadDataPO(id) {
        $.post('model/get_purchase_order.php', {
            id: id
        }, function(res) {

            $("#po_items").html("");

            $("#no_po").val(res.header.no_purchase_order);
            $("#customer").val(res.header.id_customer_supplier);
            $("#tanggal_order").val(res.header.tanggal_purchase_order);
            $("#tanggal_due_date").val(res.header.tanggal_due_date);

            res.items.forEach(item => {
                addItemRow(item);
            });

        }, 'json');
    }

    $(document).ready(function() {
        loadMaterialDataList()
        $.post('model/list_customer_supplier.php', {
            search: ''
        }, function(data) {
            let options = '';

            data.forEach(d => {
                options += `<option value="${d.id}">${d.nama_customer_supplier}</option>`;
            });

            $('#customer').html(options);

            <?php if ($status == "UPDATE") { ?>
                loadDataPO(<?= $id ?>);
            <?php } ?>

        }, 'json');
    });

    function addItemRow(item = null) {

        let idRow = no_urut++;

        $('#po_items').append(`
        <tr>
            <td>
                <input type="text" class="item-id" hidden>
                <input type="text" class="form-control material-code" list="material-list">
            </td>
            <td>
                <input type="text" class="material_item-id" hidden>
                <input type="text" class="form-control nama_material_internal" disabled>
                </td>
            <td><input type="text" class="form-control nama_material"></td>
            <td><input type="number" class="form-control price" disabled></td>
            <td><input type="number" class="form-control qty"></td>
            <td><input type="number" class="form-control total" disabled></td>
        </tr>
    `);

        let row = $('#po_items tr').last();

        if (item) {
            row.find('.item-id').val(item.id);
            row.find('.material_item-id').val(item.id_material)
            row.find('.nama_material_internal').val(item.nama_material_internal);
            row.find('.nama_material').val(item.nama_material);
            row.find('.material-code').val(item.kode_material);
            row.find('.price').val(item.price);
            row.find('.qty').val(item.qty);
            row.find('.total').val(item.total);
        }
    }

    $(document).on('input', '.qty', function() {
        let row = $(this).closest('tr');
        let price = row.find('.price').val() || 0;
        let qty = $(this).val() || 0;

        row.find('.total').val(price * qty);
    });

    $("#save-po").click(function() {

        let items = [];

        $("#po_items tr").each(function() {

            let row = $(this);

            let item = {
                id: row.find('.item-id').val(),
                id_material: row.find('.material_item-id').val(),
                nama_material: row.find('.nama_material').val(),
                qty: row.find('.qty').val(),
                total: row.find('.total').val()
            };

            if (item.id_material) {
                items.push(item);
            }
        });

        $.post("model/purchase_order.php", {
            id: "<?= $id ?>",
            status: "<?= $status ?>",
            no_po: $("#no_po").val(),
            id_customer_supplier: $("#customer").val(),
            tanggal_purchase_order: $("#tanggal_order").val(),
            tanggal_due_date: $("#tanggal_due_date").val(),
            items: JSON.stringify(items)
        }, function(res) {

            if (res.status == "success") {
                $("#no_po").val(res.no_po);
                alert("Saved!");
                loadData()
                $("#kembali-2").click()
            }

        }, "json");
    });
</script>