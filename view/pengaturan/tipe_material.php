<?php
include $_SERVER["DOCUMENT_ROOT"] . "/view/template/btn_kembali_second.php";
?>
<div class="mt-2 d-flex gap-2">
    <label class="btn btn-success" id="add-tipe-material">Tambah</label>
    <input type="text" id="search" class="form-control w-25" placeholder="Cari material...">
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Tipe</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-isi-tipe-material"></tbody>
</table>
<script>
    function loadDataTipeMaterial(search = '') {

        $.post('/model/list_tipe_material.php', {
            search: search
        }, function(res) {

            let html = '';

            res.forEach((d, i) => {

                html += `
            <tr>
                <td>${i + 1}</td>

                <td>${d.nama_tipe_material ?? '-'}</td>

                <td>${d.pengkodean ?? '-'}</td>

                <td>
                    <button 
                        class="btn btn-sm btn-primary edit-tipe-material"
                        data-id="${d.id}">
                        Edit
                    </button>

                    <button 
                        class="btn btn-sm btn-danger delete-tipe-material"
                        data-id="${d.id}">
                        Hapus
                    </button>
                </td>
            </tr>
            `;
            });

            $("#tabel-isi-tipe-material").html(html);

        }, 'json');
    }
    loadDataTipeMaterial()
    $("#search").keyup(function() {
        loadDataTipeMaterial($(this).val());
    });
    $("#add-tipe-material").click(function() {
        $("#third-content").hide()
        $("#fourth-content").load("view/form/tipe_material.php");
    })
    $(document).on("click", ".edit-tipe-material", function() {

        let id = $(this).data("id");

        $("#third-content").hide();

        $("#fourth-content").load(
            "/view/form/tipe_material.php", {
                id: id
            }
        );
    });

    // DELETE
    $(document).on("click", ".delete-tipe-material", function() {

        let id = $(this).data("id");

        if (confirm("Yakin ingin menghapus data ini?")) {

            $.post("/model/delete_tipe_material.php", {
                id: id
            }, function(res) {

                if (res.success) {

                    alert("Data berhasil dihapus");

                    loadDataTipeMaterial($("#search").val());

                } else {

                    alert("Gagal menghapus data");

                }

            }, "json");

        }
    });
</script>