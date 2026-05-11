<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_third.php';

$id = $_POST['id'] ?? null;
$status = $id ? "UPDATE" : "INSERT";
?>
<div>
    <div class="mb-3">
        <label for="tipe-currency" class="form-label">Mata Uang</label>
        <input type="text" class="form-control" id="tipe-currency">
    </div>
    <div class="mb-3">
        <label for="deskripsi-currency" class="form-label">Deskripsi</label>
        <input type="text" class="form-control" id="deskripsi-currency" aria-describedby="kodeHelp">
        <div id="kodeHelp" class="form-text">Harap isi negara asal mata uang</div>
    </div>
    <button type="submit" id="submit-tipe-currency" class="btn btn-primary">Submit</button>
</div>
<script>
    if ("<?= $id ?>" != "") {

        $.post('/model/list_currency.php', {
            id: "<?= $id ?>"
        }, function(data) {

            // ambil data pertama
            let d = data[0]

            if (d) {

                $("#tipe-currency").val(d.currency)
                $("#deskripsi-currency").val(d.deskripsi)

            }

        }, "json")

    }
    $("#submit-tipe-currency").click(function() {
        var currency = $("#tipe-currency").val()
        var deskripsi = $("#deskripsi-currency").val()
        $.post("model/mata_uang.php", {
                id: <?= $id ?>,
                currency: currency,
                deskripsi: deskripsi
            },
            function(data) {
                if (data.status) {
                    alert(data.message)
                }
            }, "json")
    })
</script>