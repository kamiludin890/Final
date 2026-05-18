    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
    ?>

    <div class="mt-2 d-flex gap-2">
        <label class="btn btn-success" id="add-purchase-order">Tambah</label>
        <input type="text" id="search" class="form-control w-25" placeholder="Cari purchase order...">
    </div>

    <table class="table table-bordered mt-2">
        <thead class="table-warning">
            <tr>
                <th>No</th>
                <th>No Purchase Order</th>
                <th>Nama Customer</th>
                <th>Tanggal Order</th>
                <th>Due Date</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tabel-isi"></tbody>
    </table>

    <script>
        function loadData(search = '') {
            $.post('/model/list_purchase_order.php', {
                search: search
            }, function(res) {
                let html = '';
                res.forEach((d, i) => {
                    html += `
                <tr>
                    <td>${i+1}</td>
                    <td>${d.no_purchase_order}</td>
                    <td>${d.nama_customer_supplier}</td>
                    <td>${d.tanggal_purchase_order}</td>
                    <td>${d.tanggal_due_date}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-po" data-id='${d.id}'>Edit</button>
                        <button class="btn btn-sm btn-danger delete-po" data-id="${d.id}">Hapus</button>
                        <button class="btn btn-sm btn-warning view-po" data-id="${d.id}">View</button>
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

            $("#add-purchase-order").click(function() {
                $("#third-content").hide();
                $("#fourth-content").load("view/form/purchase_order.php");
            });

            $(document).on('click', '.delete-po', function() {
                if (confirm('Hapus data?')) {
                    $.post('/model/purchase_order.php', {
                        id: $(this).data('id'),
                        status: "DELETE"
                    }, function() {
                        loadData();
                    });
                }
            });
        });
        $(document).on('click', '.edit-po', function() {
            $.post('view/form/purchase_order.php', {
                id: $(this).data('id')
            }, function(data) {
                $("#third-content").hide();
                $("#fourth-content").html(data);
            });
        });
        $(document).on('click', '.view-po', function() {
            $.post('view/print/purchase_order.php', {
                id: $(this).data('id')
            }, function(data) {
                $("#third-content").hide();
                $("#fourth-content").html(data);
            });
        });
    </script>