<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div class="mt-2 d-flex gap-2">
    <label class="btn btn-success" id="add-customer-supplier">Tambah</label>
    <input type="text" id="search" class="form-control w-25" placeholder="Cari customer supplier...">
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Kode Customer/Supplier</th>
            <th>Nama Customer/Supplier</th>
            <th>Alamat</th>
            <th>Tlpn</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Tax Number</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-isi"></tbody>
</table>

<script>
    function loadData(search = '') {
        $.post('/model/list_customer_supplier.php', {
            search: search
        }, function(res) {
            let html = '';
            res.forEach((d, i) => {
                html += `
            <tr>
                <td>${i+1}</td>
                <td>${d.kode_customer_supplier}</td>
                <td>${d.nama_customer_supplier}</td>
                <td>${d.alamat}</td>
                <td>${d.tlpn}</td>
                <td>${d.phone}</td>
                <td>${d.email}</td>
                <td>${d.tax_number}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-cus-sup" data-id='${d.id}'>Edit</button>
                    <button class="btn btn-sm btn-danger delete-cus-sup" data-id="${d.id}">Hapus</button>
                </td>
            </tr>`;
            });
            $('#tabel-isi').html(html);
        }, 'json');
    }

    $(document).ready(function() {
        loadData();

        $('#search').keyup(function() {
            loadData($(this).val());
        });

        $("#add-customer-supplier").click(function() {
            $("#third-content").hide();
            $("#fourth-content").load("view/form/customer_supplier.php");
        });

        $(document).on('click', '.delete-cus-sup    ', function() {
            if (confirm('Hapus data?')) {
                $.post('/model/customer_supplier.php', {
                    id: $(this).data('id'),
                    status: "DELETE"
                }, function() {
                    loadData();
                });
            }
        });
    });
    $(document).on('click', '.edit-cus-sup', function() {
        $.post('view/form/customer_supplier.php', {
            id: $(this).data('id')
        }, function(data) {
            $("#third-content").hide();
            $("#fourth-content").html(data);
        });
    });
</script>