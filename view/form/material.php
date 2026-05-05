<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';

$id = $_POST['id'] ?? null;
$status = $id ? "UPDATE" : "INSERT";
?>

<div>
    <div class="mb-3">
        <label class="form-label">Nama Material</label>
        <input type="text" class="form-control" id="nama-material">
    </div>

    <div class="mb-3">
        <label class="form-label">Tipe Material</label>
        <select class="form-control" id="tipe-material"></select>
    </div>

    <div class="row">
        <div class="col-5">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga">
        </div>

        <div class="col-5">
            <label class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan">
        </div>

        <div class="col-2">
            <label class="form-label">Currency</label>
            <select class="form-control" id="currency"></select>
        </div>
    </div>

    <button id="submit-material" class="btn btn-primary mt-2">Submit</button>
</div>

<script>
    var id = "<?= $id ?>";
    var status = "<?= $status ?>";

    $(document).ready(function() {

        // LOAD TIPE MATERIAL
        $.get("model/list_tipe_material.php", function(data) {
            if (typeof data === "string") data = JSON.parse(data);

            data.forEach(tipe => {
                $("#tipe-material").append(
                    `<option value="${tipe.id}">${tipe.nama_tipe_material}</option>`
                );
            });

            loadMaterialIfEdit();
        });

        // LOAD CURRENCY
        $.get("model/list_currency.php", function(data) {
            if (typeof data === "string") data = JSON.parse(data);

            data.forEach(cur => {
                $("#currency").append(
                    `<option value="${cur.currency}">${cur.currency}</option>`
                );
            });
        });
    });

    function loadMaterialIfEdit() {
        if (!id) return;

        $.post("model/list_material.php", {
            id: id
        }, function(data) {

            if (typeof data === "string") data = JSON.parse(data);

            if (data.length === 0) return;

            let m = data[0];

            $("#nama-material").val(m.nama_material_internal);
            $("#tipe-material").val(m.tipe_material);
            $("#harga").val(m.harga);
            $("#satuan").val(m.satuan);
            $("#currency").val(m.currency);

        });
    }

    // SUBMIT
    $("#submit-material").click(function() {

        $.post("model/material.php", {
            id: id,
            nama_material: $("#nama-material").val(),
            tipe_material: $("#tipe-material").val(),
            harga: $("#harga").val(),
            satuan: $("#satuan").val(),
            currency: $("#currency").val(),
            status: status
        }, function(res) {

            if (typeof res === "string") res = JSON.parse(res);

            alert(res.message);

            if (res.success) {
                $("#fourth-content").html("");
                $("#third-content").show();
            }

        }, "json");
    });
</script>