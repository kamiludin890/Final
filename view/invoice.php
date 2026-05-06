<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div class="mt-2 d-flex gap-2">
    <label class="btn btn-success" id="add-invoice">Tambah</label>
    <input type="text" id="search" class="form-control w-25" placeholder="Cari invoice...">
</div>

<table class="table table-bordered mt-2">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No Invoice</th>
            <th>Perusahaan</th>
            <th>Tipe Faktur</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-isi"></tbody>
</table>

<script>
    function loadInvoice(search = '') {
        $.post('/model/list_invoice.php', {
            search: search
        }, function (res) {

            let html = '';

            if (!res || res.length === 0) {
                html = `<tr>
                            <td colspan="7" class="text-center text-muted">
                                Tidak ada data invoice
                            </td>
                        </tr>`;
            } else {
                res.forEach((d, i) => {

                    const total = parseFloat(d.total || 0).toLocaleString('id-ID', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    html += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${d.tanggal_invoice ?? '-'}</td>
                        <td>${d.no_invoice ?? '-'}</td>
                        <td>${d.nama_customer_supplier ?? '-'}</td>
                        <td>${d.tax_tipe ?? '-'}</td>
                        <td>${d.currency ?? ''} ${total}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-invoice" data-id="${d.id}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger delete-invoice" data-id="${d.id}">
                                Hapus
                            </button>
                        </td>
                    </tr>`;
                });
            }

            $('#tabel-isi').html(html);

        }, 'json');
    }

    function initInvoicePage() {
        loadInvoice();

        let searchTimer;

        $('#search').off('input').on('input', function () {
            clearTimeout(searchTimer);

            const keyword = $(this).val();

            searchTimer = setTimeout(function () {
                loadInvoice(keyword);
            }, 400);
        });
    }
    initInvoicePage();

    $('#add-invoice').off('click').on('click', function () {
        $("#third-content").hide();
        $("#fourth-content").load("view/form/invoice.php");
    });
    $(document).on('click', '.edit-invoice', function () {
        const id = $(this).data('id');

        $.post('view/form/invoice.php', { id: id }, function (data) {
            $("#third-content").hide();
            $("#fourth-content").html(data);
        });
    });

    $(document).on('click', '.delete-invoice', function () {
        const id = $(this).data('id');

        if (confirm('Yakin ingin menghapus invoice ini?')) {
            $.post('/model/invoice.php', {
                id: id,
                status: 'DELETE'
            }, function (res) {
                if (res.status === 'success') {
                    loadInvoice($('#search').val());
                } else {
                    alert('Gagal hapus: ' + res.message);
                }
            }, 'json');
        }
    });

</script>