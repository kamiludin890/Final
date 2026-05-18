<?php
$file =  $_SERVER['DOCUMENT_ROOT'] . '/database/company.php';
if (file_exists($file)) {
    include $file;
} else {
    $company_name = '';
    $company_code = '';
    $address = '';
    $email = '';
    $tax_number = '';
}
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div>
    <div>
        <h1 class="text-left">Pengaturan Perusahaan</h1>
    </div>
    <div>
        <label for="company_name">Nama Perusahaan</label>
        <input type="text" name="company_name" id="company_name" class="form-control mb-2" value="<?= $company_name ?>">
        <label for="company_code">Kode Perusahaan</label>
        <input type="text" name="company_code" id="company_code" class="form-control mb-2" value="<?= $company_code ?>">
        <label for="address">Alamat Perusahaan</label>
        <textarea name="address" id="address" class="form-control mb-2"><?= $address ?></textarea>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="email@domain.com" class="form-control mb-2" value="<?= $email ?>">
        <label for="tax_number">Tax Number</label>
        <input type="text" name="tax_number" id="tax_number" class="form-control mb-2" value="<?= $tax_number ?>">
        <button class="btn btn-primary" id="save_company_config">Simpan Konfigurasi</button>
    </div>
</div>
<script>
    $("#save_company_config").click(function() {
        $.post("model/company.php", {
            company_name: $("#company_name").val(),
            company_code: $("#company_code").val(),
            email: $("#email").val(),
            tax_number: $("#tax_number").val(),
            address: $("#address").val(),
        }, function(data) {
            alert(data)
        })
    })
</script>