<div id="second-content">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body" style="height: 90vh;">
                    <h6 class="mb-3">Penjualan per Bulan</h6>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body" style="height: 90vh;">
                    <h6 class="mb-3">Kategori Penjualan</h6>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body" style="height: 90vh;">
                    <h6 class="mb-3">Trend Penjualan</h6>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="third-content"></div>
<script>
    $(document).ready(function() {

        $.post("controller/DashboardController.php", function(res) {

            let data = JSON.parse(res);
            new Chart(document.getElementById("barChart"), {
                type: "bar",
                data: {
                    labels: data.bulan,
                    datasets: [{
                        label: "Jumlah Penjualan",
                        data: data.jumlah
                    }]
                }
            });

            new Chart(document.getElementById("pieChart"), {
                type: "pie",
                data: {
                    labels: data.kategori,
                    datasets: [{
                        data: data.kategori_jumlah
                    }]
                }
            });

            new Chart(document.getElementById("lineChart"), {
                type: "line",
                data: {
                    labels: data.bulan,
                    datasets: [{
                        label: "Trend",
                        data: data.jumlah,
                        fill: false,
                        tension: 0.3
                    }]
                }
            });

        });

    });
</script>

<script src="/public/js/chart.js"></script>