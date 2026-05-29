<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>

<div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-2">
    <h5 class="m-0 fw-bold">
        <i class="bi bi-people-fill me-2"></i>
        Manajemen Akun & Akses
    </h5>

    <div class="d-flex gap-2">

        <input
            type="text"
            id="searchAkun"
            class="form-control form-control-sm"
            placeholder="Cari username / nama..."
            style="width:220px">

        <button class="btn btn-success btn-sm" id="btnTambahAkun">
            <i class="bi bi-person-plus-fill me-1"></i>
            Tambah Akun
        </button>

    </div>
</div>

<div class="table-responsive">

    <table class="table table-bordered table-hover align-middle">

        <thead class="table-primary">
            <tr>

                <th style="width:40px">No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Department</th>
                <th>Akses Menu</th>
                <th style="width:80px">Status</th>
                <th style="width:130px">Aksi</th>

            </tr>
        </thead>

        <tbody id="tabelAkun">

            <tr>
                <td colspan="7" class="text-center text-muted py-3">
                    Memuat data...
                </td>
            </tr>

        </tbody>

    </table>

</div>

<div class="modal fade" id="modalAkun" tabindex="-1">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title" id="modalAkunLabel">
                    <i class="bi bi-person-fill me-2"></i>
                    Form Akun
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form id="formAkun">

                    <input type="hidden" id="akunId" name="id">

                    <div class="row g-3">

                        <!-- LEFT -->
                        <div class="col-md-5">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Username
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="akunUsername"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="akunNama"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Department
                                </label>

                                <input
                                    type="text"
                                    id="akunDepartment"
                                    class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="akunEmail"
                                    class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    No. Telepon
                                </label>

                                <input
                                    type="text"
                                    id="akunNoTelp"
                                    class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Password
                                    <span class="text-danger" id="passRequired">*</span>
                                </label>

                                <div class="input-group">

                                    <input
                                        type="password"
                                        id="akunPassword"
                                        class="form-control">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        id="togglePass">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                                <small class="text-muted" id="passHint"></small>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select id="akunStatus" class="form-select">

                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>

                                </select>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-7">

                            <label class="form-label fw-semibold">
                                Hak Akses Menu
                            </label>

                            <div
                                class="border rounded p-3 bg-light"
                                style="max-height:460px;overflow-y:auto;">

                                <!-- CHECK ALL -->
                                <div class="form-check mb-2 pb-2 border-bottom">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="checkAllAkses">

                                    <label
                                        class="form-check-label fw-bold"
                                        for="checkAllAkses">
                                        Pilih Semua
                                    </label>

                                </div>

                                <!-- DASHBOARD -->
                                <div class="form-check mb-3">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="akses[]"
                                        value="dashboard"
                                        id="chkDashboard">

                                    <label
                                        class="form-check-label fw-semibold"
                                        for="chkDashboard">
                                        <i class="bi bi-speedometer2 me-1 text-primary"></i>
                                        Dashboard
                                    </label>

                                </div>

                                <!-- DATA -->
                                <div class="mb-3">

                                    <!-- hidden parent -->
                                    <input
                                        type="checkbox"
                                        class="d-none akses-parent"
                                        name="akses[]"
                                        value="data"
                                        id="toggleData">

                                    <div class="fw-semibold mb-2">
                                        <i class="bi bi-folder me-1 text-warning"></i>
                                        Data
                                    </div>

                                    <div class="ms-4">

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="data_material"
                                                id="chkDataMaterial"
                                                data-group="data">

                                            <label
                                                class="form-check-label"
                                                for="chkDataMaterial">
                                                Material
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="data_purchase_order"
                                                id="chkDataPO"
                                                data-group="data">

                                            <label
                                                class="form-check-label"
                                                for="chkDataPO">
                                                Purchase Order
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="data_invoice"
                                                id="chkDataInvoice"
                                                data-group="data">

                                            <label
                                                class="form-check-label"
                                                for="chkDataInvoice">
                                                Invoice
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="data_customer_supplier"
                                                id="chkDataCS"
                                                data-group="data">

                                            <label
                                                class="form-check-label"
                                                for="chkDataCS">
                                                Customer & Supplier
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="data_in_out_material"
                                                id="chkDataInOut"
                                                data-group="data">

                                            <label
                                                class="form-check-label"
                                                for="chkDataInOut">
                                                In Out Material
                                            </label>

                                        </div>

                                    </div>

                                </div>

                                <!-- LAPORAN -->
                                <div class="mb-3">

                                    <input
                                        type="checkbox"
                                        class="d-none akses-parent"
                                        name="akses[]"
                                        value="laporan"
                                        id="toggleLaporan">

                                    <div class="fw-semibold mb-2">
                                        <i class="bi bi-graph-up me-1 text-success"></i>
                                        Laporan
                                    </div>

                                    <div class="ms-4">

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="laporan_keuangan"
                                                id="chkLaporanKeu"
                                                data-group="laporan">

                                            <label
                                                class="form-check-label"
                                                for="chkLaporanKeu">
                                                Laporan Keuangan
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="laporan_stok"
                                                id="chkLaporanStok"
                                                data-group="laporan">

                                            <label
                                                class="form-check-label"
                                                for="chkLaporanStok">
                                                Laporan Stok
                                            </label>

                                        </div>

                                    </div>

                                </div>

                                <!-- PENGATURAN -->
                                <div class="mb-1">

                                    <input
                                        type="checkbox"
                                        class="d-none akses-parent"
                                        name="akses[]"
                                        value="pengaturan"
                                        id="togglePengaturan">

                                    <div class="fw-semibold mb-2">
                                        <i class="bi bi-gear me-1 text-secondary"></i>
                                        Pengaturan
                                    </div>

                                    <div class="ms-4">

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="pengaturan_akun"
                                                id="chkPengAkun"
                                                data-group="pengaturan">

                                            <label
                                                class="form-check-label"
                                                for="chkPengAkun">
                                                Pengguna
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="pengaturan_tipe_material"
                                                id="chkPengTipe"
                                                data-group="pengaturan">

                                            <label
                                                class="form-check-label"
                                                for="chkPengTipe">
                                                Tipe Material
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="pengaturan_mata_uang"
                                                id="chkPengMataUang"
                                                data-group="pengaturan">

                                            <label
                                                class="form-check-label"
                                                for="chkPengMataUang">
                                                Mata Uang
                                            </label>

                                        </div>

                                        <div class="form-check mb-1">

                                            <input
                                                class="form-check-input akses-child"
                                                type="checkbox"
                                                name="akses[]"
                                                value="pengaturan_company"
                                                id="chkPengCompany"
                                                data-group="pengaturan">

                                            <label
                                                class="form-check-label"
                                                for="chkPengCompany">
                                                Company
                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Batal
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="btnSimpanAkun">
                    <i class="bi bi-floppy me-1"></i>
                    Simpan
                </button>

            </div>

        </div>

    </div>

</div>
<script>
    (function() {

        const MENU_LABELS = {
            dashboard: '<span class="badge bg-primary me-1">Dashboard</span>',

            data: '<span class="badge bg-warning text-dark me-1">Data</span>',
            data_material: '<span class="badge bg-warning text-dark me-1">Material</span>',
            data_purchase_order: '<span class="badge bg-warning text-dark me-1">Purchase Order</span>',
            data_invoice: '<span class="badge bg-warning text-dark me-1">Invoice</span>',
            data_customer_supplier: '<span class="badge bg-warning text-dark me-1">Customer & Supplier</span>',
            data_in_out_material: '<span class="badge bg-warning text-dark me-1">In Out Material</span>',

            laporan: '<span class="badge bg-success me-1">Laporan</span>',
            laporan_keuangan: '<span class="badge bg-success me-1">Lap. Keuangan</span>',
            laporan_stok: '<span class="badge bg-success me-1">Lap. Stok</span>',

            pengaturan: '<span class="badge bg-secondary me-1">Pengaturan</span>',
            pengaturan_akun: '<span class="badge bg-secondary me-1">Pengguna</span>',
            pengaturan_tipe_material: '<span class="badge bg-secondary me-1">Tipe Material</span>',
            pengaturan_mata_uang: '<span class="badge bg-secondary me-1">Mata Uang</span>',
            pengaturan_company: '<span class="badge bg-secondary me-1">Company</span>',
        };

        const PARENT_GROUPS = ['data', 'laporan', 'pengaturan'];

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD DATA
        |--------------------------------------------------------------------------
        */

        function loadAkun(search = '') {

            $('#tabelAkun').html(`
            <tr>
                <td colspan="7" class="text-center text-muted py-3">
                    Memuat data...
                </td>
            </tr>
        `);

            $.ajax({
                url: '/model/user_akses_model.php',
                type: 'POST',
                dataType: 'json',
                cache: false,

                data: {
                    action: 'list',
                    search: search
                },

                success: function(res) {

                    if (!res.success) {

                        $('#tabelAkun').html(`
                        <tr>
                            <td colspan="7" class="text-center text-danger py-3">
                                ${res.message}
                            </td>
                        </tr>
                    `);

                        return;
                    }

                    let html = '';

                    if (res.data.length === 0) {

                        html = `
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Belum ada akun.
                            </td>
                        </tr>
                    `;
                    }

                    res.data.forEach((u, i) => {

                        const aksesBadge =
                            (u.akses && u.akses.length > 0) ?
                            u.akses.map(k =>
                                MENU_LABELS[k] ||
                                `<span class="badge bg-light text-dark border me-1">${k}</span>`
                            ).join('') :
                            '<span class="text-muted fst-italic">Semua akses (Admin)</span>';

                        const statusBadge =
                            u.status == 1 ?
                            '<span class="badge bg-success">Aktif</span>' :
                            '<span class="badge bg-danger">Nonaktif</span>';

                        html += `
                        <tr>

                            <td>${i + 1}</td>

                            <td>
                                <strong>${u.username}</strong>
                            </td>

                            <td>${u.nama || '-'}</td>

                            <td>${u.department || '-'}</td>

                            <td>${aksesBadge}</td>

                            <td>${statusBadge}</td>

                            <td>

                                <button
                                    class="btn btn-sm btn-primary btn-edit-akun me-1"
                                    data-id="${u.id}"
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button
                                    class="btn btn-sm btn-danger btn-hapus-akun"
                                    data-id="${u.id}"
                                    data-nama="${u.nama}"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>

                            </td>

                        </tr>
                    `;
                    });

                    $('#tabelAkun').html(html);
                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                    $('#tabelAkun').html(`
                    <tr>
                        <td colspan="7" class="text-center text-danger py-3">
                            Gagal memuat data.
                        </td>
                    </tr>
                `);
                }
            });
        }

        loadAkun();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        let searchTimer;

        $(document)
            .off('input', '#searchAkun')
            .on('input', '#searchAkun', function() {

                clearTimeout(searchTimer);

                searchTimer = setTimeout(() => {
                    loadAkun($(this).val());
                }, 400);

            });

        /*
        |--------------------------------------------------------------------------
        | PARENT AUTO CHECK
        |--------------------------------------------------------------------------
        */

        function syncParentToggle(group) {

            const checked =
                $(`.akses-child[data-group="${group}"]:checked`).length;

            const $toggle =
                $(`#toggle${capitalize(group)}`);

            // hidden parent ikut checked
            $toggle.prop('checked', checked > 0);

        }

        function syncAllParents() {

            PARENT_GROUPS.forEach(group => {
                syncParentToggle(group);
            });

        }

        /*
        |--------------------------------------------------------------------------
        | CHECK ALL
        |--------------------------------------------------------------------------
        */

        function syncCheckAll() {

            const total =
                $('.akses-child, #chkDashboard').length;

            const checked =
                $('.akses-child:checked, #chkDashboard:checked').length;

            $('#checkAllAkses')
                .prop('checked', checked === total && total > 0)
                .prop('indeterminate', checked > 0 && checked < total);

        }

        /*
        |--------------------------------------------------------------------------
        | RESET MODAL
        |--------------------------------------------------------------------------
        */

        function resetModal(isEdit = false) {

            $('#formAkun')[0].reset();

            $('#akunId').val('');

            $('input[name="akses[]"]')
                .prop('checked', false)
                .prop('indeterminate', false);

            if (isEdit) {

                $('#modalAkunLabel').html(`
                <i class="bi bi-person-gear me-2"></i>
                Edit Akun
            `);

                $('#passHint')
                    .text('Kosongkan jika tidak ingin mengganti password.');

                $('#passRequired').hide();

            } else {

                $('#modalAkunLabel').html(`
                <i class="bi bi-person-plus-fill me-2"></i>
                Tambah Akun Baru
            `);

                $('#passHint').text('');

                $('#passRequired').show();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | TAMBAH AKUN
        |--------------------------------------------------------------------------
        */

        $(document)
            .off('click', '#btnTambahAkun')
            .on('click', '#btnTambahAkun', function() {

                resetModal(false);

                new bootstrap.Modal($('#modalAkun')[0]).show();

            });

        /*
        |--------------------------------------------------------------------------
        | EDIT AKUN
        |--------------------------------------------------------------------------
        */

        $(document)
            .off('click', '.btn-edit-akun')
            .on('click', '.btn-edit-akun', function() {

                const id = $(this).data('id');

                resetModal(true);

                $.post('/model/user_akses_model.php', {

                    action: 'get',
                    id: id

                }, function(res) {

                    if (!res.success) {
                        alert(res.message);
                        return;
                    }

                    const u = res.data;

                    $('#akunId').val(u.id);
                    $('#akunUsername').val(u.username);
                    $('#akunNama').val(u.nama);
                    $('#akunDepartment').val(u.department);
                    $('#akunEmail').val(u.email);
                    $('#akunNoTelp').val(u.no_telp);
                    $('#akunStatus').val(u.status);

                    $('input[name="akses[]"]')
                        .prop('checked', false);

                    if (u.akses && u.akses.length > 0) {

                        u.akses.forEach(function(akses) {

                            $(`input[name="akses[]"][value="${akses}"]`)
                                .prop('checked', true);

                        });

                    }

                    syncAllParents();
                    syncCheckAll();

                    new bootstrap.Modal($('#modalAkun')[0]).show();

                }, 'json');

            });

        /*
        |--------------------------------------------------------------------------
        | HAPUS AKUN
        |--------------------------------------------------------------------------
        */

        $(document)
            .off('click', '.btn-hapus-akun')
            .on('click', '.btn-hapus-akun', function() {

                const id = $(this).data('id');
                const nama = $(this).data('nama');

                if (!confirm(`Yakin ingin menghapus akun "${nama}"?`)) {
                    return;
                }

                $.post('/model/user_akses_model.php', {

                    action: 'delete',
                    id: id

                }, function(res) {

                    alert(res.message);

                    if (res.success) {
                        loadAkun($('#searchAkun').val());
                    }

                }, 'json');

            });

        /*
        |--------------------------------------------------------------------------
        | SIMPAN AKUN
        |--------------------------------------------------------------------------
        */

        $('#btnSimpanAkun')
            .off('click')
            .on('click', function() {

                const id = $('#akunId').val();

                const akses =
                    $('input[name="akses[]"]:checked')
                    .map(function() {
                        return this.value.trim();
                    })
                    .get();

                console.log('AKSES FINAL:', akses);

                const data = {

                    action: id ? 'update' : 'create',

                    id: id,

                    username: $('#akunUsername').val().trim(),
                    nama: $('#akunNama').val().trim(),
                    department: $('#akunDepartment').val().trim(),
                    email: $('#akunEmail').val().trim(),
                    no_telp: $('#akunNoTelp').val().trim(),
                    password: $('#akunPassword').val(),
                    status: $('#akunStatus').val(),

                    akses: akses
                };

                $(this)
                    .prop('disabled', true)
                    .html(`
                    <i class="bi bi-hourglass-split me-1"></i>
                    Menyimpan...
                `);

                $.post('/model/user_akses_model.php', data, function(res) {

                        alert(res.message);

                        if (res.success) {

                            bootstrap.Modal
                                .getInstance($('#modalAkun')[0])
                                .hide();

                            loadAkun($('#searchAkun').val());
                        }

                    }, 'json')

                    .always(function() {

                        $('#btnSimpanAkun')
                            .prop('disabled', false)
                            .html(`
                        <i class="bi bi-floppy me-1"></i>
                        Simpan
                    `);

                    });

            });

        /*
        |--------------------------------------------------------------------------
        | TOGGLE PASSWORD
        |--------------------------------------------------------------------------
        */

        $('#togglePass')
            .off('click')
            .on('click', function() {

                const inp = $('#akunPassword');

                const isPass =
                    inp.attr('type') === 'password';

                inp.attr('type', isPass ? 'text' : 'password');

                $(this)
                    .find('i')
                    .toggleClass('bi-eye bi-eye-slash');

            });

        /*
        |--------------------------------------------------------------------------
        | CHILD CHECK
        |--------------------------------------------------------------------------
        */

        $(document)
            .off('change', '.akses-child')
            .on('change', '.akses-child', function() {

                const group = $(this).data('group');

                syncParentToggle(group);

                syncCheckAll();

            });

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        $(document)
            .off('change', '#chkDashboard')
            .on('change', '#chkDashboard', function() {

                syncCheckAll();

            });

        /*
        |--------------------------------------------------------------------------
        | CHECK ALL
        |--------------------------------------------------------------------------
        */

        $(document)
            .off('change', '#checkAllAkses')
            .on('change', '#checkAllAkses', function() {

                const isChecked = $(this).is(':checked');

                $('.akses-child, #chkDashboard')
                    .prop('checked', isChecked);

                PARENT_GROUPS.forEach(group => {
                    syncParentToggle(group);
                });

            });

    })();
</script>