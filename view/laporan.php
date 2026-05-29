<?php
session_start();

$aksesUser  = $_SESSION['user']['akses'] ?? null;
$semuaAkses = ($aksesUser === null);

function bolehMenu($menu, $aksesUser, $semuaAkses)
{
    return $semuaAkses || in_array($menu, (array)$aksesUser, true);
}
?>
<div id="second-content">
    <div class="d-flex flex-column m-1 text-center">
        <div class="row ">
            <div class="col mt-2">
                <div class="card card-hov <?= !bolehMenu('laporan_keuangan', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('laporan_keuangan', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="laporan-keuangan" data-akses="laporan_keuangan">
                        <i class="bi bi-clipboard-data fs-1"></i>
                        <i class="bi bi-cash fs-1"></i>
                        <h5 class="card-title">Laporan Keuangan</h5>
                    </div>
                </div>
            </div>

            <div class="col mt-2">
                <div class="card card-hov <?= !bolehMenu('laporan_stok', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('laporan_stok', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="laporan-stok" data-akses="laporan_stok">
                        <i class="bi bi-clipboard-data fs-1"></i>
                        <i class="bi bi-box2 fs-1"></i>
                        <h5 class="card-title">Laporan Stok</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="third-content"></div>
<script>
    if (!document.getElementById('custom-style-laporan')) {
        const customStyleLaporan = document.createElement('style');
        customStyleLaporan.textContent = `
        .card-hov.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .card-body.disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
        }
    `;
        document.head.appendChild(customStyleLaporan);
    }

    $("#laporan-keuangan").click(function() {
        if ($(this).hasClass('disabled')) {
            alert('❌ Anda tidak memiliki akses ke fitur ini.');
            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/financial_report.php");
    })
    $("#laporan-stok").click(function() {
        if ($(this).hasClass('disabled')) {
            alert('❌ Anda tidak memiliki akses ke fitur ini.');
            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/material_stock_report.php");
    })
</script>