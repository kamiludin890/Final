<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div class="mt-2 d-flex gap-2">
    <label class="btn btn-success" id="add-in-out">Tambah</label>
    <input type="text" id="search-in-out" class="form-control w-25"
        placeholder="Cari dokumen/customer...">
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>No Dokumen</th>
            <th>Customer/Supplier</th>
            <th>Jenis Dokumen</th>
            <th>Tanggal Dokumen</th>
            <th>Tipe</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody id="tabel-isi-in-out"></tbody>
</table>

<script>
    function loadDataInOut(search = '') {

        $.post('/model/list_in_out_material.php', {
            search: search
        }, function(res) {

            let html = '';

            res.forEach((d, i) => {

                let badgeClass =
                    d.tipe_doc === 'IN' || d.tipe_doc === 'IMPORT' ?
                    'bg-success' :
                    'bg-danger';

                html += `
                <tr>
                    <td>${i+1}</td>

                    <td>
                        <span class="badge ${badgeClass}">
                            ${d.tipe_doc}
                        </span>
                        ${d.no_doc}
                    </td>

                    <td>${d.nama_customer_supplier ?? '-'}</td>

                    <td>${d.jenis_doc}</td>

                    <td>${d.tanggal_doc}</td>

                    <td>${d.tipe_doc}</td>

                    <td>
                        <button class="btn btn-sm btn-primary edit-in-out"
                            data-id="${d.id}">
                            Edit
                        </button>

                        <button class="btn btn-sm btn-danger delete-in-out"
                            data-id="${d.id}">
                            Hapus
                        </button>
                    </td>
                </tr>
                `;
            });

            $("#tabel-isi-in-out").html(html);

        }, 'json');
    }

    $(document).ready(function() {

        loadDataInOut();

        $("#search-in-out").keyup(function() {
            loadDataInOut($(this).val());
        });

        $("#add-in-out").click(function() {

            $("#third-content").hide();

            $("#fourth-content")
                .load("view/form/in_out_material.php");
        });

        $(document).on('click', '.edit-in-out', function() {

            $.post(
                'view/form/in_out_material.php', {
                    id: $(this).data('id')
                },

                function(data) {

                    $("#third-content").hide();

                    $("#fourth-content").html(data);
                }
            );
        });

        $(document).on('click', '.delete-in-out', function() {

            if (!confirm("Hapus data?")) return;

            $.post('/model/in_out_material.php', {
                id: $(this).data('id'),
                status: "DELETE"
            }, function(res) {

                alert(res.message);

                loadDataInOut();

            }, 'json');
        });

    });
</script>