<div id="second-content">
    <div class="d-flex flex-column m-1 text-center">
        <div class="row ">
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="akun">
                        <i class="bi bi-person fs-1"></i>
                        <h5 class="card-title">Pengguna</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="akun_akses">
                        <i class="bi bi-people fs-1"></i>
                        <h5 class="card-title">Akun & Akses</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="info-pengguna">
                        <i class="bi bi-info-square fs-1"></i>
                        <h5 class="card-title">Info Pengguna</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="tipe_material">
                        <i class="bi bi-box-seam-fill fs-1"></i>
                        <h5 class="card-title">Tipe Material</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="mata_uang">
                        <i class="bi bi-currency-exchange fs-1"></i>
                        <h5 class="card-title">Mata uang</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="">
                        <i class="bi bi-clock fs-1"></i>
                        <h5 class="card-title">Coming soon</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="database">
                        <i class="bi bi-database fs-1"></i>
                        <h5 class="card-title">Konfigurasi Database</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="import_db">
                        <i class="bi bi-database-gear fs-1"></i>
                        <h5 class="card-title">Import Skema Database</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
            </div>
        </div>
    </div>
</div>
<div id="third-content"></div>
<div id="fourth-content"></div>
<script>
    $("#akun").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/akun.php");
    });
    $("#akun_akses").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/akun_akses.php");
    });
    $("#tipe_material").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/tipe_material.php");
    });
    $("#mata_uang").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/mata_uang.php");
    });
    $("#database").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/koneksi_database.php");
    });

    $("#import_db").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/import_databse.php");
    });
</script>