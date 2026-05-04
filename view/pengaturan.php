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
<script>
    $("#akun").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/akun.php");
    });
    $("#akun_akses").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/pengaturan/akun_akses.php");
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