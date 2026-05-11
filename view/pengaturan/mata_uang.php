<?php
include $_SERVER["DOCUMENT_ROOT"] . "/view/template/btn_kembali_second.php";
?>
<div class="mt-2 d-flex gap-2">
    <label class="btn btn-success" id="add-currency">Tambah</label>
    <input type="text" id="search" class="form-control w-25" placeholder="Cari mata uang...">
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Mata Uang</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-currency"></tbody>
</table>
<script>
    function loadCurrency(search = '') {

        $.post('/model/list_currency.php', {
            search: search
        }, function(res) {

            let html = '';

            res.forEach((d, i) => {

                html += `
            <tr>
                <td>${i + 1}</td>
                <td>${d.currency}</td>
                <td>${d.deskripsi}</td>
                <td>
                    <button 
                        class="btn btn-sm btn-primary edit-currency"
                        data-id="${d.id}">
                        Edit
                    </button>

                    <button 
                        class="btn btn-sm btn-danger edit-currency"
                        data-id="${d.id}">
                        Hapus
                    </button>
                </td>
            </tr>
            `;
            });

            $("#tabel-currency").html(html);

        }, 'json');
    }

    loadCurrency();

    $("#search").keyup(function() {
        loadCurrency($(this).val());
    });
    $("#add-currency").click(function() {
        $("#third-content").hide()
        $("#fourth-content").load("view/form/mata_uang.php");
    })
    $(document).on('click', '.edit-currency', function() {

        let id = $(this).data('id');

        $("#third-content").hide();

        $("#fourth-content").load(
            "view/form/mata_uang.php", {
                id: id
            }
        );
    });
    $(document).on('click', '.delete-currency', function() {

        let id = $(this).data('id');

        if (confirm("Yakin ingin menghapus data ini?")) {

            $.post('/model/delete_currency.php', {
                id: id
            }, function(res) {

                alert(res.message);

                loadCurrency($("#search").val());

            }, 'json');
        }
    });
</script>