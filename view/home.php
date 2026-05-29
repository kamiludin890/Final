<?php
$user        = $_SESSION['user']['nama'];
$namaDepan   = explode(' ', trim($user))[0];
$profile_img = $_SESSION['user']['foto'];

$aksesUser  = $_SESSION['user']['akses'] ?? null;
$semuaAkses = ($aksesUser === null);

function bolehMenu($menu, $aksesUser, $semuaAkses)
{
    return $semuaAkses || in_array($menu, (array)$aksesUser, true);
}

function bolehMenuGroup($group, $aksesUser, $semuaAkses)
{
    if ($semuaAkses) return true;
    $groupMenus = [
        'data' => ['data_material', 'data_purchase_order', 'data_invoice', 'data_customer_supplier', 'data_in_out_material'],
        'laporan' => ['laporan_keuangan', 'laporan_stok'],
        'pengaturan' => ['pengaturan_akun', 'pengaturan_tipe_material', 'pengaturan_mata_uang', 'pengaturan_company']
    ];
    if (!isset($groupMenus[$group])) return false;
    foreach ($groupMenus[$group] as $menu) {
        if (in_array($menu, (array)$aksesUser, true)) return true;
    }
    return false;
}
?>
<div id="wrapper">

    <div id="sidebar" class="bg-primary text-white p-3">
        <div class="text-center">
            <div class="d-flex align-items-center justify-content-center gap-2">
                <img src="public/icon/Final.png" class="logo-final">
                <h4 class="m-0 fw-bold">Final</h4>
            </div>
            <p>Financial Analysis</p>
        </div>
        <hr>

        <ul class="nav flex-column">

            <li class="nav-item">
                <label class="nav-link text-white active menu-item <?= !bolehMenu('dashboard', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="dashboard" data-akses="dashboard">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </label>
            </li>

            <li class="nav-item">
                <label class="nav-link text-white menu-item <?= !bolehMenuGroup('data', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="data" data-akses="data">
                    <i class="bi bi-folder"></i> Data
                </label>
            </li>

            <li class="nav-item">
                <label class="nav-link text-white menu-item <?= !bolehMenuGroup('laporan', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="laporan" data-akses="laporan">
                    <i class="bi bi-graph-up"></i> Laporan
                </label>
            </li>

            <li class="nav-item">
                <label class="nav-link text-white menu-item <?= !bolehMenuGroup('pengaturan', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="pengaturan" data-akses="pengaturan">
                    <i class="bi bi-gear"></i> Pengaturan
                </label>
            </li>

        </ul>
    </div>

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
            <div class="container-fluid">
                <button class="btn btn-primary" id="toggleSidebar"><i class="bi bi-x-lg"></i>
                </button>
                <label class="navbar-brand ms-2"><img src="<?= $profile_img ?>" alt="Profile Image" class="rounded-circle" width="30" height="30"> <?= $namaDepan ?></label>
            </div>
        </nav>
        <div class="container-fluid p-4" id="main-content">

        </div>

    </div>

</div>
<script>
    var aksesUser = <?= json_encode($aksesUser) ?>;

    const style = document.createElement('style');
    style.textContent = `
        .nav-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
        .card-hov.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .card-body.disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
        }
    `;
    document.head.appendChild(style);

    $(document).on('click', '.nav-link.disabled', function(e) {
        e.preventDefault();
        alert('❌ Anda tidak memiliki akses ke menu ini.');
    });

    $(document).on('click', '.card-body.disabled', function(e) {
        e.preventDefault();
        alert('❌ Anda tidak memiliki akses ke fitur ini.');
    });
</script>