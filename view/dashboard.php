<div id="second-content" class="fade-in-up">
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm dashboard-card h-100 card-gradient-blue">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small text-uppercase mb-1 fw-bold tracking-wider">Jenis Material</p>
                            <h2 class="mb-0 text-white fw-bold" id="card-total-materials">-</h2>
                        </div>
                        <div class="icon-circle bg-white-20 text-white">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-white-50">
                        <span class="text-white fw-bold"><i class="bi bi-check-circle-fill me-1"></i>Aktif</span> dalam database
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm dashboard-card h-100 card-gradient-purple">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small text-uppercase mb-1 fw-bold tracking-wider">Total Invoice</p>
                            <h2 class="mb-0 text-white fw-bold" id="card-total-invoices">-</h2>
                        </div>
                        <div class="icon-circle bg-white-20 text-white">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-white-50">
                        <span class="text-white fw-bold"><i class="bi bi-journal-check me-1"></i>Transaksi</span> tercatat resmi
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm dashboard-card h-100 card-gradient-green">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small text-uppercase mb-1 fw-bold tracking-wider">Total Penjualan</p>
                            <h4 class="mb-0 text-white fw-bold truncate-card-text" id="card-total-revenue">-</h4>
                        </div>
                        <div class="icon-circle bg-white-20 text-white">
                            <i class="bi bi-graph-up-arrow fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-white-50">
                        <span class="text-white fw-bold"><i class="bi bi-arrow-up-right-circle me-1"></i>Pendapatan</span> dari Customer
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm dashboard-card h-100 card-gradient-orange">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small text-uppercase mb-1 fw-bold tracking-wider">Total Pembelian</p>
                            <h4 class="mb-0 text-white fw-bold truncate-card-text" id="card-total-expense">-</h4>
                        </div>
                        <div class="icon-circle bg-white-20 text-white">
                            <i class="bi bi-cart-check fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-white-50">
                        <span class="text-white fw-bold"><i class="bi bi-arrow-down-right-circle me-1"></i>Pengeluaran</span> kepada Supplier
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 col-lg-6 mb-4">
            <div class="card border-0 shadow-sm card-chart h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="m-0 fw-bold text-dark-blue">Arus Finansial per Bulan (<?= date('Y') ?>)</h6>
                        <span class="badge bg-light text-primary border border-primary-subtle px-2.5 py-1.5 fw-semibold small">IDR Converted</span>
                    </div>
                    <div class="chart-container position-relative" style="height: 380px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-6 mb-4">
            <div class="card border-0 shadow-sm card-chart h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="m-0 fw-bold text-dark-blue">Kategori Material Terlaris</h6>
                        <span class="badge bg-light text-success border border-success-subtle px-2.5 py-1.5 fw-semibold small">Qty Terjual</span>
                    </div>
                    <div class="chart-container position-relative d-flex align-items-center justify-content-center" style="height: 380px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm card-chart">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="m-0 fw-bold text-dark-blue">Tren Kinerja Penjualan Bulanan (<?= date('Y') ?>)</h6>
                        <span class="badge bg-primary-subtle text-primary border-0 px-3 py-1.5 rounded-pill fw-semibold text-uppercase font-size-xs">Line Chart</span>
                    </div>
                    <div class="chart-container position-relative" style="height: 300px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="third-content"></div>
<style>
    .text-dark-blue {
        color: #1e293b;
        font-size: 1.1rem;
        letter-spacing: -0.01em;
    }

    .tracking-wider {
        letter-spacing: 0.05em;
    }

    .bg-white-20 {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .dashboard-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.15) !important;
    }

    .dashboard-card:hover .icon-circle {
        transform: scale(1.1) rotate(5deg);
    }

    .card-chart {
        border-radius: 16px;
        transition: box-shadow 0.3s ease;
    }

    .card-chart:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04) !important;
    }

    .truncate-card-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }

    .card-gradient-blue {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
    }

    .card-gradient-purple {
        background: linear-gradient(135deg, #7c3aed, #a78bfa);
    }

    .card-gradient-green {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .card-gradient-orange {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }

    .fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script src="/public/js/chart.js"></script>
<script>
    $(document).ready(function() {
        $.post("controller/DashboardController.php", function(res) {
            let data = res;
            if (typeof res === 'string') {
                data = JSON.parse(res);
            }
            $("#card-total-materials").text(data.total_materials ?? 0);
            $("#card-total-invoices").text(data.total_invoices ?? 0);
            $("#card-total-revenue").text(data.total_revenue ?? 'IDR 0,00');
            $("#card-total-expense").text(data.total_expense ?? 'IDR 0,00');
            const formatCurrency = (val) => {
                return parseFloat(val || 0).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
            };
            const months = data.bulan;
            const sales = data.penjualan_bulanan ?? [];
            const purchases = data.pembelian_bulanan ?? [];
            const categories = data.kategori ?? [];
            const categoryCounts = data.kategori_jumlah ?? [];
            new Chart(document.getElementById("barChart"), {
                type: "bar",
                data: {
                    labels: months,
                    datasets: [{
                            label: "Penjualan (IDR)",
                            data: sales,
                            backgroundColor: "rgba(16, 185, 129, 0.85)", // Modern Emerald
                            borderColor: "rgb(16, 185, 129)",
                            borderWidth: 1.5,
                            borderRadius: 6,
                            barPercentage: 0.6,
                            categoryPercentage: 0.7
                        },
                        {
                            label: "Pembelian (IDR)",
                            data: purchases,
                            backgroundColor: "rgba(239, 68, 68, 0.85)", // Modern Red
                            borderColor: "rgb(239, 68, 68)",
                            borderWidth: 1.5,
                            borderRadius: 6,
                            barPercentage: 0.6,
                            categoryPercentage: 0.7
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: "top",
                            labels: {
                                boxWidth: 12,
                                usePointStyle: true,
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 12,
                                    weight: 500
                                }
                            }
                        },
                        tooltip: {
                            padding: 12,
                            fontFamily: "'Inter', sans-serif",
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + formatCurrency(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                borderDash: [5, 5],
                                color: "#e2e8f0"
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 10
                                },
                                callback: function(value) {
                                    return 'Rp' + (value / 1e6) + 'jt';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById("pieChart"), {
                type: "doughnut",
                data: {
                    labels: categories,
                    datasets: [{
                        data: categoryCounts,
                        backgroundColor: [
                            "#3b82f6",
                            "#10b981",
                            "#f59e0b",
                            "#ec4899",
                            "#8b5cf6"
                        ],
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: "65%",
                    plugins: {
                        legend: {
                            position: "bottom",
                            labels: {
                                boxWidth: 10,
                                usePointStyle: true,
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11
                                }
                            }
                        },
                        tooltip: {
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': ' + context.raw + ' qty';
                                }
                            }
                        }
                    }
                }
            });
            new Chart(document.getElementById("lineChart"), {
                type: "line",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Trend Penjualan Bulanan (IDR)",
                        data: sales,
                        borderColor: "#3b82f6",
                        backgroundColor: "rgba(59, 130, 246, 0.05)",
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3.5,
                        pointBackgroundColor: "#3b82f6",
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return ' Penjualan: ' + formatCurrency(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                borderDash: [5, 5],
                                color: "#e2e8f0"
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 10
                                },
                                callback: function(value) {
                                    return 'Rp' + (value / 1e6) + 'jt';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

        });
    });
</script>