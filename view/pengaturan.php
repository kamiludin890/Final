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
                <div class="card card-hov <?= !bolehMenu('pengaturan_akun', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('pengaturan_akun', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="akun" data-akses="pengaturan_akun">
                        <i class="bi bi-person fs-1"></i>
                        <h5 class="card-title">Pengguna</h5>
                    </div>
                </div>
            </div>

            <div class="col mt-2">
                <div class="card card-hov <?= !$semuaAkses ? 'disabled' : '' ?>">
                    <div class="card-body <?= !$semuaAkses ? 'disabled' : '' ?>" id="akun_akses" data-akses="akun_akses">
                        <i class="bi bi-people fs-1"></i>
                        <h5 class="card-title">Akun &amp; Akses</h5>
                    </div>
                </div>
            </div>

            <div class="col mt-2">
                <div class="card card-hov <?= !bolehMenu('pengaturan', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('pengaturan', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="info-pengguna" data-akses="pengaturan">
                        <i class="bi bi-info-square fs-1"></i>
                        <h5 class="card-title">Info Pengguna</h5>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col mt-2">
                <div class="card card-hov <?= !bolehMenu('pengaturan_tipe_material', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('pengaturan_tipe_material', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="tipe_material" data-akses="pengaturan_tipe_material">
                        <i class="bi bi-box-seam-fill fs-1"></i>
                        <h5 class="card-title">Tipe Material</h5>
                    </div>
                </div>
            </div>

            <div class="col mt-2">
                <div class="card card-hov <?= !bolehMenu('pengaturan_mata_uang', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('pengaturan_mata_uang', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="mata_uang" data-akses="pengaturan_mata_uang">
                        <i class="bi bi-currency-exchange fs-1"></i>
                        <h5 class="card-title">Mata uang</h5>
                    </div>
                </div>
            </div>

            <div class="col mt-2">
                <div class="card card-hov <?= !bolehMenu('pengaturan_company', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                    <div class="card-body <?= !bolehMenu('pengaturan_company', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="company" data-akses="pengaturan_company">
                        <i class="bi bi-building fs-1"></i>
                        <h5 class="card-title">Company</h5>
                    </div>
                </div>
            </div>

        </div>
        <div class="row ">

            <div class="col mt-2">
                <div class="card card-hov <?= !$semuaAkses ? 'disabled' : '' ?>">
                    <div class="card-body <?= !$semuaAkses ? 'disabled' : '' ?>" id="database" data-akses="database">
                        <i class="bi bi-database fs-1"></i>
                        <h5 class="card-title">Konfigurasi Database</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov <?= !$semuaAkses ? 'disabled' : '' ?>">
                    <div class="card-body <?= !$semuaAkses ? 'disabled' : '' ?>" id="import_db" data-akses="import_db">
                        <i class="bi bi-database-gear fs-1"></i>
                        <h5 class="card-title">Import Skema Database</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2"></div>

        </div>
    </div>
</div>
<div id="third-content"></div>
<div id="fourth-content"></div>
<script>
    $(document).on("click", "#akun", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/akun.php");
    });
    $(document).on("click", "#akun_akses", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/akun_akses.php");
    });
    $(document).on("click", "#info-pengguna", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/info_pengguna.php");
    });
    $(document).on("click", "#tipe_material", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/tipe_material.php");
    });
    $(document).on("click", "#mata_uang", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/mata_uang.php");
    });
    $(document).on("click", "#company", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/company.php");
    });
    $(document).on("click", "#database", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/koneksi_database.php");
    });
    $(document).on("click", "#import_db", function() {
        if ($(this).hasClass('disabled')) {

            return;
        }
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/import_databse.php");
    });
</script>