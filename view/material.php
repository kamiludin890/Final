<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>
<div class="mt-1">
    <label class="btn btn-success" id="add-material"><i class="bi bi-plus-square"></i></label>
    <label class="btn btn-warning" id="config-material"><i class="bi bi-wrench"></i></label>
</div>
<div id="tabel-purchase-order" class="mt-1">
    <table class="table table-bordered border-dark table-hover">
        <thead>
            <tr class="table-warning">
                <th>No</th>
                <th>Kode Material</th>
                <th>Tipe Material</th>
                <th>Nama Material</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Mata Uang</th>
            </tr>
        </thead>
        <tbody id="tabel-isi">
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/model/list_material.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var tabelIsi = $('#tabel-isi');
                tabelIsi.empty();
                data.forEach(function(item, index) {
                    var totalHarga = item.qty * item.harga;
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + item.kode_material + '</td>' +
                        '<td>' + item.nama_material_internal + '</td>' +
                        '<td>' + item.tipe_material + '</td>' +
                        '<td>' + item.satuan + '</td>' +
                        '<td>' + item.harga + '</td>' +
                        '<td>' + item.currency + '</td>' +
                        '</tr>';
                    tabelIsi.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching purchase order data:', error);
            }
        });
    });
    $("#add-material").click(function() {
        $("#third-content").hide();
        $("#fourth-content").load("view/form/material.php");
    });
    $("#config-material").click(function() {
        $("#third-content").hide();
        $("#fourth-content").load("view/form/tipe_material.php");
    });
</script>