<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';

$id = isset($_POST['id'])
    ? intval($_POST['id'])
    : 0;

$status = $id > 0
    ? "UPDATE"
    : "INSERT";
?>

<div class="card p-3">

    <div class="row mb-3">

        <div class="col-4">

            <label>No Dokumen</label>

            <input type="text"
                class="form-control"
                id="no_doc"
                disabled>

        </div>

        <div class="col-4">

            <label>Jenis Dokumen</label>

            <input type="text"
                class="form-control"
                id="jenis_doc">

        </div>

        <div class="col-4">

            <label>Tipe</label>

            <select class="form-control"
                id="tipe_doc">

                <option value="IN">IN</option>
                <option value="OUT">OUT</option>
                <option value="IMPORT">IMPORT</option>
                <option value="EXPORT">EXPORT</option>

            </select>

        </div>

    </div>

    <div class="row mb-3">

        <div class="col-6">

            <label>Tanggal Dokumen</label>

            <input type="date"
                class="form-control"
                id="tanggal_doc"
                value="<?= date('Y-m-d') ?>">

        </div>

        <div class="col-6">

            <label>Tanggal IN/OUT</label>

            <input type="date"
                class="form-control"
                id="tanggal_in_out"
                value="<?= date('Y-m-d') ?>">

        </div>

    </div>

    <div class="mb-3">

        <label>Customer / Supplier</label>

        <select class="form-control"
            id="customer_supplier_id">
        </select>

    </div>

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-2">

        <h5>Item Material</h5>

        <button type="button"
            class="btn btn-success btn-sm"
            id="add-item">

            Tambah Item

        </button>

    </div>

    <table class="table table-bordered">

        <thead class="table-warning">

            <tr>

                <th width="25%">
                    Material
                </th>

                <th width="10%">
                    Qty
                </th>

                <th width="10%">
                    Satuan
                </th>

                <th width="25%">
                    Nama Material
                </th>

                <th width="20%">
                    Kode Customer
                </th>

                <th width="10%">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody id="item-body"></tbody>

    </table>

    <button class="btn btn-primary"
        id="submit-in-out">

        Submit

    </button>

</div>

<script>
    var id = <?= $id ?>;

    var status = "<?= $status ?>";

    var materialOption = '';
    loadCustomer();

    loadMaterial(function() {

        if (status == "UPDATE") {

            loadEditData();

        } else {

            generateNoDoc();

        }

    });

    function generateNoDoc() {

        $.post('/model/generate_no_doc.php', {

            tipe_doc: $("#tipe_doc").val()

        }, function(res) {

            $("#no_doc").val(res.no_doc);

        }, 'json');

    }

    $("#tipe_doc").change(function() {

        if (status == "INSERT") {

            generateNoDoc();

        }

    });

    function loadCustomer() {

        $.post('/model/list_customer_supplier.php', {}, function(data) {

            if (typeof data === 'string') {

                data = JSON.parse(data);

            }

            let html = `
                <option value="">
                    Pilih Customer/Supplier
                </option>
            `;

            data.forEach(d => {

                html += `
                    <option value="${d.id}">
                        ${d.nama_customer_supplier}
                    </option>
                `;

            });

            $("#customer_supplier_id").html(html);

        });

    }

    function loadMaterial(callback = null) {

        $.post('/model/list_material.php', {}, function(data) {

            if (typeof data === 'string') {

                data = JSON.parse(data);

            }

            materialOption = `
                <option value="">
                    Pilih Material
                </option>
            `;

            data.forEach(d => {

                materialOption += `
                    <option
                        value="${d.id}"
                        data-satuan="${d.satuan}">

                        ${d.kode_material}
                        -
                        ${d.nama_material_internal}

                    </option>
                `;

            });

            if (callback) {

                callback();

            }

        });

    }

    function appendItem(item = {}) {

        let html = `
        <tr>

            <input type="hidden"
                class="item-id"
                value="${item.id ?? ''}">

            <td>

                <select class="form-control item-material">

                    ${materialOption}

                </select>

            </td>

            <td>

                <input type="number"
                    class="form-control item-qty"
                    value="${item.qty ?? ''}">

            </td>

            <td>

                <input type="text"
                    class="form-control item-satuan"
                    disabled
                    value="${item.satuan ?? ''}">

            </td>

            <td>

                <input type="text"
                    class="form-control item-nama-material"
                    value="${item.nama_material ?? ''}">

            </td>

            <td>

                <input type="text"
                    class="form-control item-kode-cs"
                    value="${item.kode_material_customer_supplier ?? ''}">

            </td>

            <td>

                <button type="button"
                    class="btn btn-danger btn-sm remove-item">

                    Hapus

                </button>

            </td>

        </tr>
        `;

        $("#item-body").append(html);

        let row = $("#item-body tr:last");

        row.find('.item-material')
            .val(item.id_material ?? '');

    }

    function loadEditData() {

        $.post('/model/detail_in_out_material.php', {

            id: id

        }, function(res) {

            if (typeof res === 'string') {

                res = JSON.parse(res);

            }

            let d = res.document;

            $("#no_doc").val(d.no_doc);

            $("#jenis_doc").val(d.jenis_doc);

            $("#tipe_doc").val(d.tipe_doc);

            $("#tanggal_doc").val(d.tanggal_doc);

            $("#tanggal_in_out").val(d.tanggal_in_out);

            $("#customer_supplier_id")
                .val(d.id_customer_supplier);
            $("#item-body").html('');

            res.items.forEach(item => {

                appendItem(item);

            });

        }, 'json');

    }


    $("#add-item").click(function() {

        appendItem();

    });

    $(document).on('change', '.item-material', function() {

        let satuan = $(this)
            .find(':selected')
            .data('satuan');

        $(this)
            .closest('tr')
            .find('.item-satuan')
            .val(satuan);

    });


    $(document).on('click', '.remove-item', function() {

        $(this)
            .closest('tr')
            .remove();

    });

    $("#submit-in-out").click(function() {

        let items = [];

        $("#item-body tr").each(function() {

            items.push({

                id: $(this)
                    .find('.item-id')
                    .val(),

                id_material: $(this)
                    .find('.item-material')
                    .val(),

                qty: $(this)
                    .find('.item-qty')
                    .val(),

                satuan: $(this)
                    .find('.item-satuan')
                    .val(),

                nama_material: $(this)
                    .find('.item-nama-material')
                    .val(),

                kode_material_customer_supplier: $(this)
                    .find('.item-kode-cs')
                    .val()

            });

        });

        $.post('/model/in_out_material.php', {

            id: id,

            no_doc: $("#no_doc").val(),

            jenis_doc: $("#jenis_doc").val(),

            tipe_doc: $("#tipe_doc").val(),

            tanggal_doc: $("#tanggal_doc").val(),

            tanggal_in_out: $("#tanggal_in_out").val(),

            id_customer_supplier: $("#customer_supplier_id").val(),

            items: JSON.stringify(items),

            status: status

        }, function(res) {

            if (typeof res === 'string') {

                res = JSON.parse(res);

            }

            console.log(res);

            alert(res.message);

            if (res.status == 'success') {

                $("#fourth-content").html("");

                $("#third-content").show();

                loadDataInOut();

            }

        }, 'json');

    });
</script>