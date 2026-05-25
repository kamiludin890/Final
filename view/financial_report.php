<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
@include $_SERVER['DOCUMENT_ROOT'] . '/database/company.php';

$compName = isset($company_name) ? $company_name : 'PT AYO BISA SEJAHTERA';
$compAddress = isset($address) ? $address : 'Alamat Perusahaan';
$compEmail = isset($email) ? $email : 'info@company.com';
?>

<div class="financial-report-container fade-in-up mt-3">
    <!-- ===== PRINT HEADER (ONLY VISIBLE ON PRINT) ===== -->
    <div class="print-header d-none">
        <div class="row align-items-center mb-4">
            <div class="col-8">
                <h3 class="fw-bold m-0 text-uppercase"><?= htmlspecialchars($compName) ?></h3>
                <p class="text-muted small m-0"><?= htmlspecialchars($compAddress) ?></p>
                <p class="text-muted small m-0">Email: <?= htmlspecialchars($compEmail) ?></p>
            </div>
            <div class="col-4 text-end">
                <h4 class="fw-bold text-primary m-0">LAPORAN KEUANGAN</h4>
                <p class="small text-muted m-0">Periode: <span class="print-periode"></span></p>
            </div>
        </div>
        <hr class="border-2 border-dark opacity-100 mb-4">
    </div>

    <!-- ===== SCREEN HEADER ===== -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 no-print">
        <div>
            <h4 class="fw-bold text-dark-blue mb-1">Laporan Keuangan Bulanan</h4>
            <p class="text-muted small mb-0">Analisis arus kas masuk dan keluar per periode transaksi</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" id="btn-print-report">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <!-- ===== FILTER PANEL ===== -->
    <div class="card border-0 shadow-sm mb-4 no-print filter-card">
        <div class="card-body p-3">
            <div class="row align-items-end g-3">
                <div class="col-md-4 col-sm-6">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-1">Tanggal Mulai</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                        <input type="date" class="form-control" id="filter-tanggal-mulai" value="<?= date('Y-m-01') ?>">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-1">Tanggal Selesai</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                        <input type="date" class="form-control" id="filter-tanggal-selesai" value="<?= date('Y-m-t') ?>">
                    </div>
                </div>
                <div class="col-md-4 col-12 d-grid">
                    <button class="btn btn-primary" id="btn-filter-report">
                        <i class="bi bi-funnel-fill me-1"></i> Filter Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== DYNAMIC SUMMARY CARDS CONTAINER ===== -->
    <div id="financial-summary-cards" class="mb-4">
        <!-- Dynamically rendered by JavaScript -->
    </div>

    <!-- ===== TRANSACTIONS TABLE ===== -->
    <div class="card border-0 shadow-sm report-table-card">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark-blue mb-3 no-print">Rincian Transaksi Invoice</h6>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle" id="report-table">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 12%">Tanggal</th>
                            <th style="width: 15%">No Invoice</th>
                            <th>Perusahaan</th>
                            <th style="width: 15%">Tipe Faktur (Tax)</th>
                            <th style="width: 15%" class="text-center">Tipe Transaksi</th>
                            <th style="width: 18%" class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody id="financial-transactions-body">
                        <!-- Loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ===== CSS STYLING ===== -->
<style>
    .text-dark-blue {
        color: #1e293b;
    }
    .filter-card {
        border-radius: 12px;
    }
    .report-table-card {
        border-radius: 16px;
    }
    .badge-cash-in {
        background-color: rgba(16, 185, 129, 0.1) !important;
        color: #10b981 !important;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .badge-cash-out {
        background-color: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444 !important;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    .text-profit-plus {
        color: #10b981;
    }
    .text-profit-minus {
        color: #ef4444;
    }
    .summary-group-box {
        background-color: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }
    .metric-subcard {
        border-radius: 12px;
        transition: transform 0.2s ease;
    }
    .metric-subcard:hover {
        transform: scale(1.01);
    }

    /* Print styles */
    @media print {
        body {
            background-color: #fff !important;
            color: #000 !important;
            font-size: 11pt !important;
        }
        .no-print, #sidebar, #toggleSidebar, .navbar, .btn-kembali, #kembali-2 {
            display: none !important;
        }
        #wrapper, #content, #main-content {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }
        .print-header {
            display: block !important;
        }
        .card {
            border: 0 !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin-bottom: 0 !important;
        }
        .card-body {
            padding: 0 !important;
        }
        .table-responsive {
            overflow: visible !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            page-break-inside: auto !important;
        }
        tr {
            page-break-inside: avoid !important;
            page-break-after: auto !important;
        }
        thead {
            display: table-header-group !important;
        }
        .table-dark {
            background-color: #e2e8f0 !important;
            color: #000 !important;
        }
        .table-dark th {
            color: #000 !important;
            border-bottom: 2px solid #000 !important;
            background-color: #e2e8f0 !important;
        }
        .badge {
            background: none !important;
            color: #000 !important;
            border: none !important;
            padding: 0 !important;
            font-weight: bold;
        }
        .summary-group-box {
            border: 2px solid #000 !important;
            background-color: #fff !important;
            margin-bottom: 30px !important;
            page-break-inside: avoid !important;
        }
        .metric-subcard {
            border: 1px solid #ccc !important;
            background-color: #fff !important;
        }
    }
</style>

<!-- ===== JAVASCRIPT LOGIC ===== -->
<script>
    $(document).ready(function() {
        // Format Indonesian Date
        function formatDateIndo(dateStr) {
            if (!dateStr) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateStr).toLocaleDateString('id-ID', options);
        }

        // Format Currency Helper
        function formatValCurrency(val, currency) {
            return currency + ' ' + parseFloat(val || 0).toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Load Financial Report Data via AJAX
        function loadFinancialReport() {
            const start = $("#filter-tanggal-mulai").val();
            const end = $("#filter-tanggal-selesai").val();

            // Set period in print preview
            const periodStr = formatDateIndo(start) + ' - ' + formatDateIndo(end);
            $(".print-periode").text(periodStr);

            $.post("/model/financial_report_data.php", {
                tanggal_mulai: start,
                tanggal_selesai: end
            }, function(res) {
                if (res.status === 'success') {
                    renderSummary(res.summary);
                    renderTransactions(res.transactions);
                } else {
                    alert('Gagal mengambil data laporan: ' + res.message);
                }
            }, 'json');
        }

        // Render Summary Cards dynamically based on currencies
        function renderSummary(summary) {
            let html = '';
            const currencies = Object.keys(summary);

            if (currencies.length === 0) {
                html = `
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <div class="text-muted py-4">
                            <i class="bi bi-cash-coin fs-1 text-secondary mb-3 d-block"></i>
                            <h6 class="fw-bold">Tidak ada transaksi keuangan pada periode ini</h6>
                            <p class="small mb-0">Silakan ubah rentang filter tanggal Anda</p>
                        </div>
                    </div>
                `;
            } else {
                currencies.forEach(curr => {
                    const rev = summary[curr].revenue;
                    const exp = summary[curr].expense;
                    const net = summary[curr].net_profit;

                    const profitClass = net >= 0 ? 'text-profit-plus' : 'text-profit-minus';
                    const profitIcon = net >= 0 ? 'bi-arrow-up-right-circle-fill' : 'bi-arrow-down-right-circle-fill';
                    
                    html += `
                        <div class="summary-group-box p-4 mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-primary px-3 py-2 fs-6 rounded-3 fw-bold">${curr}</span>
                                <h6 class="m-0 ms-2 fw-bold text-dark-blue">Indikator Keuangan (${curr})</h6>
                            </div>
                            <div class="row g-3">
                                <!-- Revenue Sub-card -->
                                <div class="col-md-4">
                                    <div class="card border-0 bg-white shadow-xs metric-subcard p-3 h-100">
                                        <p class="text-muted small text-uppercase mb-1 fw-bold">Penjualan (Revenue)</p>
                                        <h4 class="fw-bold text-profit-plus m-0">${formatValCurrency(rev, curr)}</h4>
                                        <span class="text-muted small mt-2 d-block"><i class="bi bi-arrow-up text-success me-1"></i>Kas Masuk</span>
                                    </div>
                                </div>
                                <!-- Expense Sub-card -->
                                <div class="col-md-4">
                                    <div class="card border-0 bg-white shadow-xs metric-subcard p-3 h-100">
                                        <p class="text-muted small text-uppercase mb-1 fw-bold">Pembelian (Expense)</p>
                                        <h4 class="fw-bold text-profit-minus m-0">${formatValCurrency(exp, curr)}</h4>
                                        <span class="text-muted small mt-2 d-block"><i class="bi bi-arrow-down text-danger me-1"></i>Kas Keluar</span>
                                    </div>
                                </div>
                                <!-- Profit Sub-card -->
                                <div class="col-md-4">
                                    <div class="card border-0 bg-white shadow-xs metric-subcard p-3 h-100">
                                        <p class="text-muted small text-uppercase mb-1 fw-bold">Laba Bersih (Net Profit)</p>
                                        <h4 class="fw-bold ${profitClass} m-0">${formatValCurrency(net, curr)}</h4>
                                        <span class="text-muted small mt-2 d-block"><i class="bi ${profitIcon} me-1"></i>Selisih Bersih</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            $("#financial-summary-cards").html(html);
        }

        // Render Transaction Table Rows
        function renderTransactions(transactions) {
            let html = '';

            if (transactions.length === 0) {
                html = `
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-info-circle me-1"></i> Tidak ada transaksi tercatat untuk periode ini.
                        </td>
                    </tr>
                `;
            } else {
                transactions.forEach((tx, i) => {
                    const badgeClass = tx.cs_tipe === 'customer' ? 'badge-cash-in' : 'badge-cash-out';
                    const txType = tx.cs_tipe === 'customer' ? 'Penjualan' : 'Pembelian';
                    const totalStr = formatValCurrency(tx.total, tx.currency);

                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${tx.tanggal_invoice}</td>
                            <td class="fw-semibold text-primary font-monospace">${tx.no_invoice}</td>
                            <td>
                                <div>
                                    <span class="fw-bold d-block text-dark-blue">${tx.nama_customer_supplier}</span>
                                    <span class="text-muted small text-uppercase text-xs font-size-xs">${tx.cs_tipe}</span>
                                </div>
                            </td>
                            <td>${tx.tax_tipe ?? '-'}</td>
                            <td class="text-center">
                                <span class="badge ${badgeClass} px-2.5 py-1.5 rounded fw-bold text-uppercase" style="font-size: 0.75rem;">
                                    ${txType}
                                </span>
                            </td>
                            <td class="text-end fw-bold font-monospace">${totalStr}</td>
                        </tr>
                    `;
                });
            }

            $("#financial-transactions-body").html(html);
        }

        // Initial Data Load
        loadFinancialReport();

        // Trigger filters on click
        $("#btn-filter-report").click(function() {
            loadFinancialReport();
        });

        // Trigger browser print
        $("#btn-print-report").click(function() {
            window.print();
        });
    });
</script>
