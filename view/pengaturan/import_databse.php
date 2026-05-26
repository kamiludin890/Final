<?php
$folder = $_SERVER['DOCUMENT_ROOT'] . '/database/skema';
$files = glob($folder . '/*.php');
// $files = array_filter($files, function ($file) {
//     return basename($file) !== 'user.php';
// });
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div>
    <div>
        <h1 class="text-left">Import Skema Database</h1>
    </div>

    <div>
        <label>Pilih File SQL</label>
        <select id="sql_file" class="form-control mb-2">
            <option value="">-- Pilih File --</option>
            <?php foreach ($files as $file): ?>
                <option value="<?= basename($file) ?>">
                    <?= basename($file) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button class="btn btn-primary" id="import_sql">Import Database</button>
    </div>
    <script>
        $("#import_sql").click(function() {
            var tabel_name = $("#sql_file").val();
            if (tabel_name) {
                $.post(
                    "model/import_database.php", {
                        tabel_name: tabel_name,
                    },
                    function(data) {
                        alert(data);
                    },
                );
            } else {
                alert("Silakan pilih file SQL.");
            }
        });
    </script>
</div>