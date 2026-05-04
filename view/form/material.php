<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';
if (isset($_POST['id'])) {
    $status = "UPDATE";
} {
    $status = "INSERT";
}
?>
<div>
    <div class="mb-3">
        <label for="nama-material" class="form-label">Nama Material</label>
        <input type="text" class="form-control" id="nama-material">
    </div>
    <div class="mb-3">
        <label for="tipe-material" class="form-label">Tipe Material</label>
        <select class="form-control" id="tipe-material">
            <option value=""></option>
        </select>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga">
            </div>
        </div>
        <div class="col-5">
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="satuan">
            </div>
        </div>
        <div class="col-2">
            <div class="mb-3">
                <label for="currency" class="form-label">Currency</label>
                <select class="form-control" id="currency">
                </select>
            </div>
        </div>
    </div>
    <button type="submit" id="submit-material" class="btn btn-primary">Submit</button>
</div>
<script>
    $(document).ready(function() {
        $.get("model/list_tipe_material.php", function(data) {

            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            var tipeMaterialSelect = $("#tipe-material");

            data.forEach(function(tipe) {
                tipeMaterialSelect.append(
                    `<option value="${tipe.id}">${tipe.nama_tipe_material}</option>`
                );
            });
        });
        $.get("model/list_currency.php", function(data) {

            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            var currencySelect = $("#currency");

            data.forEach(function(currency) {
                currencySelect.append(
                    `<option value="${currency.currency}">${currency.currency}</option>`
                );
            });
        });
    });
    $("#submit-material").click(function() {
        var namaMaterial = $("#nama-material").val();
        var tipeMaterialId = $("#tipe-material").val();
        var harga = $("#harga").val();
        var satuan = $("#satuan").val();
        var currency = $("#currency").val();
        var status = "<?php echo $status; ?>";

        console.log("Data yang akan dikirim:", {
            namaMaterial: namaMaterial,
            tipe_material: tipeMaterialId,
            harga: harga,
            satuan: satuan,
            currency: currency,
            status: status
        });

        $.post("model/material.php", {
            nama_material: namaMaterial,
            tipe_material: tipeMaterialId,
            harga: harga,
            satuan: satuan,
            currency: currency,
            status: status
        }, function(response) {
            alert(response.message);
            if (response.success) {
                $("#fourth-content").html("");
                $("#third-content").show();
            }
        }, "json");
    });
</script>