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
        <label for="tipe">Tipe</label>
        <select class="form-control" id="tipe">
            <option value="customer">Customer</option>
            <option value="supplier">Supplier</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="nama-customer-supplier" class="form-label">Nama Customer Supplier</label>
        <input type="text" class="form-control" id="nama-customer-supplier">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email">
    </div>
    <div class="mb-3 row">
        <div class="col-4">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone">
        </div>
        <div class="col-4">
            <label for="tlpn" class="form-label">Tlpn</label>
            <input type="text" class="form-control" id="tlpn">
        </div>
        <div class="col-4">
            <label for="tax-number" class="form-label">Tax Number</label>
            <input type="text" class="form-control" id="tax-number">
        </div>
    </div>
    <button type="submit" id="submit-customer-supplier" class="btn btn-primary">Submit</button>
</div>
<script>
    $("#submit-customer-supplier").click(function() {
        var id = "<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>";
        var tipe = $("#tipe").val();
        var nama = $("#nama-customer-supplier").val();
        var alamat = $("#alamat").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var tlpn = $("#tlpn").val();
        var taxNumber = $("#tax-number").val();
        var status = "<?= $status ?>";
        $.post('/model/customer_supplier.php', {
            id: id,
            tipe: tipe,
            nama: nama,
            alamat: alamat,
            email: email,
            phone: phone,
            tlpn: tlpn,
            taxNumber: taxNumber,
            status: status
        }, function(data) {
            alert(data.message);
            if (data.success) {
                $("#nama-customer-supplier").val('');
                $("#alamat").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#tlpn").val('');
                $("#tax-number").val('');
                loadData();
            }
        }, "json");
    });
</script>