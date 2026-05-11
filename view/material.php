<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div class="mt-2 d-flex gap-2">
    <label class="btn btn-success" id="add-material">Tambah</label>
    <input type="text" id="search" class="form-control w-25" placeholder="Cari material...">
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Currency</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-isi"></tbody>
</table>

<script>
    function loadData(search = '') {
        $.post('/model/list_material.php', {
            search: search
        }, function(res) {
            let html = '';
            res.forEach((d, i) => {
                html += `
            <tr>
                <td>${i+1}</td>
                <td>${d.kode_material}</td>
                <td>${d.nama_material_internal}</td>
                <td>${d.tipe_material}</td>
                <td>${d.satuan}</td>
                <td>${d.harga}</td>
                <td>${d.currency}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-material" data-id='${d.id}'>Edit</button>
                    <button class="btn btn-sm btn-danger delete-material" data-id="${d.id}">Hapus</button>
                </td>
            </tr>`;
            });
            $('#tabel-isi').html(html);
        }, 'json');
    }

    function loadTipe() {
        $.post('/model/list_tipe_material.php', function(res) {
            let opt = '';
            res.forEach(d => {
                opt += `<option value="${d.id}">${d.nama_tipe_material}</option>`;
            });
            $('#tipe').html(opt);
        }, 'json');
    }

    $(document).ready(function() {
        loadData();
        loadTipe();

        $('#search').keyup(function() {
            loadData($(this).val());
        });

        $("#add-material").click(function() {
            $("#third-content").hide();
            $("#fourth-content").load("view/form/material.php");
        });

        $(document).on('click', '.delete-material', function() {
            if (confirm('Hapus data?')) {
                $.post('/model/material.php', {
                    id: $(this).data('id'),
                    status: "DELETE"
                }, function() {
                    loadData();
                });
            }
        });
    });
    $(document).on('click', '.edit-material', function() {
        $.post('view/form/material.php', {
            id: $(this).data('id')
        }, function(data) {
            $("#third-content").hide();
            $("#fourth-content").html(data);
        });
    });
</script>