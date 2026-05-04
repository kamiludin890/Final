<?php
$file =  $_SERVER['DOCUMENT_ROOT'] . '/database/config.php';
if (file_exists($file)) {
    include $file;
} else {
    $host = '';
    $dbname = '';
    $username = '';
    $password = '';
    $port = '';
}
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div>
    <div>
        <h1 class="text-left">Pengaturan Database</h1>
    </div>
    <div>
        <label for="db_host">Host Database</label>
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" name="db_host" id="db_host" class="form-control mb-2" value="<?= $host ?>">
            </div>
            <div class="col-md-6">
                <input type="text" name="db_port" id="db_port" placeholder="Default: 3306" class="form-control mb-2" value="<?= $port ?>">
            </div>
        </div>
        <label for="db_name">Nama Database</label>
        <input type="text" name="db_name" id="db_name" class="form-control mb-2" value="<?= $dbname ?>">
        <label for="db_user">Username Database</label>
        <input type="text" name="db_user" id="db_user" placeholder="Default: root" class="form-control mb-2" value="<?= $username ?>">
        <label for="db_pass">Password Database</label>
        <input type="password" name="db_pass" id="db_pass" class="form-control mb-2" value="<?= $password ?>">
        <button class="btn btn-primary" id="save_db_config">Simpan Konfigurasi</button>
    </div>
</div>
<script>
    $("#save_db_config").click(function() {
        const dbHost = $("#db_host").val();
        const dbPort = $("#db_port").val();
        const dbName = $("#db_name").val();
        const dbUser = $("#db_user").val();
        const dbPass = $("#db_pass").val();

        $.post("model/config_db.php", {
            submit: true,
            host: dbHost,
            port: dbPort,
            name: dbName,
            user: dbUser,
            pass: dbPass
        }, function(response) {
            alert(response);
        });
    });
</script>