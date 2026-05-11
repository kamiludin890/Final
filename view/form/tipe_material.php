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

<div>
    <div class="mb-3">
        <label for="tipe-material" class="form-label">Tipe Material</label>
        <input type="text" class="form-control" id="tipe-material">
    </div>

    <div class="mb-3">
        <label for="pengkodean" class="form-label">Pengkodean</label>
        <input type="text" class="form-control" id="pengkodean" aria-describedby="kodeHelp">

        <div id="kodeHelp" class="form-text">
            Jika tidak diisi maka pengkodean akan diatur default oleh sistem.
            <br>
            Harap setting untuk memudahkan klasifikasi
        </div>
    </div>

    <button type="submit" id="submit-tipe-material" class="btn btn-primary">
        Submit
    </button>
</div>

<script>
    var id = "<?= $id ?>";
    var status = "<?= $status ?>";

    if (status === "UPDATE") {

        $.post("/model/list_tipe_material.php", {
            id: id
        }, function(res) {

            $("#tipe-material").val(res.nama_tipe_material);
            $("#pengkodean").val(res.pengkodean);

        }, "json");
    }

    $("#submit-tipe-material").click(function() {

        var nama_tipe_material = $("#tipe-material").val();
        var pengkodean = $("#pengkodean").val();

        if (nama_tipe_material.trim() === "") {
            alert("Tipe material harus diisi.");
            return;
        }

        $.post("/model/tipe_material.php", {

            id: id,
            status: status,
            nama_tipe_material: nama_tipe_material,
            pengkodean: pengkodean

        }, function(response) {

            alert(response.message);
            $("#kembali-2").click();

        }, "json");

    });
</script>