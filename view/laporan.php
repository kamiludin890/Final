<div id="second-content">
    <div class="d-flex flex-column m-1 text-center">
        <div class="row ">
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="laporan-keuangan">
                        <i class="bi bi-clipboard-data fs-1"></i>
                        <i class="bi bi-cash fs-1"></i>
                        <h5 class="card-title">Laporan Keuangan</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="laporan-stok">
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
    $("#laporan-keuangan").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/financial_report.php");
    })
    $("#laporan-stok").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/material_stock_report.php");
    })
</script>