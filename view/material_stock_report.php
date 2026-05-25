<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
@include $_SERVER['DOCUMENT_ROOT'] . '/database/company.php';

$compName = isset($company_name) ? $company_name : 'PT AYO BISA SEJAHTERA';
$compAddress = isset($address) ? $address : 'Alamat Perusahaan';
$compEmail = isset($email) ? $email : 'info@company.com';
?>

<div class="material-stock-report-container fade-in-up mt-3">
    <!-- ===== PRINT HEADER (ONLY VISIBLE ON PRINT) ===== -->
    <div class="print-header d-none">
        <div class="row align-items-center mb-4">
            <div class="col-8">
                <h3 class="fw-bold m-0 text-uppercase"><?= htmlspecialchars($compName) ?></h3>
                <p class="text-muted small m-0"><?= htmlspecialchars($compAddress) ?></p>
                <p class="text-muted small m-0">Email: <?= htmlspecialchars($compEmail) ?></p>
            </div>
            <div class="col-4 text-end">
                <h4 class="fw-bold text-success m-0">LAPORAN MUTASI STOK</h4>
                <p class="small text-muted m-0">Periode: <span class="print-periode"></span></p>
            </div>
        </div>
        <hr class="border-2 border-dark opacity-100 mb-4">
    </div>

    <!-- ===== SCREEN HEADER ===== -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 no-print">
        <div>
            <h4 class="fw-bold text-dark-blue mb-1">Laporan Mutasi Stok Material</h4>
            <p class="text-muted small mb-0">Rangkuman mutasi barang masuk, keluar, saldo akhir, serta valuasi aset</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success" id="btn-print-stock-report">
                <i class="bi bi-printer me-1"></i> Cetak Mutasi
            </button>
        </div>
    </div>

    <!-- ===== FILTER PANEL ===== -->
    <div class="card border-0 shadow-sm mb-4 no-print filter-card">
        <div class="card-body p-3">
            <div class="row align-items-end g-3">
                <div class="col-md-3 col-sm-6">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-1">Tanggal Mulai</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                        <input type="date" class="form-control" id="filter-stock-mulai" value="<?= date('Y-m-01') ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-1">Tanggal Selesai</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                        <input type="date" class="form-control" id="filter-stock-selesai" value="<?= date('Y-m-t') ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-1">Tipe Material</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-tags"></i></span>
                        <select class="form-control" id="filter-tipe-material">
                            <option value="">-- Semua Tipe --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12 d-grid">
                    <button class="btn btn-success" id="btn-filter-stock">
                        <i class="bi bi-funnel-fill me-1"></i> Saring Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SUMMARY SUMMARY CARDS ===== -->
    <div class="row mb-4 g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-success text-white p-3 h-100 position-relative overflow-hidden">
                <div class="card-body d-flex align-items-center justify-content-between z-index-1">
                    <div>
                        <p class="text-white-50 small text-uppercase mb-1 fw-bold tracking-wider">Total Item Terdaftar</p>
                        <h3 class="mb-0 fw-bold" id="card-total-items">-</h3>
                    </div>
                    <div class="icon-circle bg-white-10 text-white" style="width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(255,255,255,0.15)">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-primary text-white p-3 h-100 position-relative overflow-hidden">
                <div class="card-body d-flex align-items-center justify-content-between z-index-1">
                    <div>
                        <p class="text-white-50 small text-uppercase mb-1 fw-bold tracking-wider">Total Valuasi Aset Stok</p>
                        <h3 class="mb-0 fw-bold" id="card-total-asset-valuation">-</h3>
                    </div>
                    <div class="icon-circle bg-white-10 text-white" style="width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(255,255,255,0.15)">
                        <i class="bi bi-currency-dollar fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== STOCK LEDGER TABLE ===== -->
    <div class="card border-0 shadow-sm report-table-card">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark-blue mb-3 no-print">Laporan Saldo & Mutasi Stok</h6>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle" id="report-table">
                    <thead class="table-dark text-center">
                        <tr>
                            <th rowspan="2" class="align-middle" style="width: 5%">No</th>
                            <th rowspan="2" class="align-middle" style="width: 10%">Kode</th>
                            <th rowspan="2" class="align-middle text-start">Nama Material</th>
                            <th rowspan="2" class="align-middle text-start" style="width: 12%">Tipe</th>
                            <th rowspan="2" class="align-middle" style="width: 8%">Satuan</th>
                            <th colspan="4" class="border-bottom text-center">Mutasi Kuantitas (Qty)</th>
                            <th rowspan="2" class="align-middle text-end" style="width: 15%">Nilai Aset</th>
                        </tr>
                        <tr>
                            <th style="width: 10%">Stok Awal</th>
                            <th style="width: 9%" class="text-success">Masuk (+)</th>
                            <th style="width: 9%" class="text-danger">Keluar (-)</th>
                            <th style="width: 10%">Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody id="stock-report-body" class="text-center font-monospace">
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
    .z-index-1 {
        z-index: 1;
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
        .bg-success, .bg-primary {
            background-color: #fff !important;
            color: #000 !important;
            border: 2px solid #000 !important;
            margin-bottom: 20px !important;
        }
        .text-white-50 {
            color: #555 !important;
        }
        .bg-success h3, .bg-primary h3 {
            color: #000 !important;
        }
        .icon-circle {
            display: none !important;
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
            border: 1px solid #000 !important;
            background-color: #e2e8f0 !important;
        }
        td {
            border: 1px solid #ccc !important;
        }
        .text-success {
            color: #000 !important;
            font-weight: bold;
        }
        .text-danger {
            color: #000 !important;
            font-weight: bold;
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

        // Load Tipe Material dynamically to populate filter
        function loadTipeMaterialOptions() {
            $.post('/model/list_tipe_material.php', function(data) {
                if (typeof data === 'string') {
                    data = JSON.parse(data);
                }
                
                let html = '<option value="">-- Semua Tipe --</option>';
                data.forEach(t => {
                    html += `<option value="${t.id}">${t.nama_tipe_material}</option>`;
                });
                
                $("#filter-tipe-material").html(html);
            });
        }

        // Load Material Stock Report Data
        function loadStockReport() {
            const start = $("#filter-stock-mulai").val();
            const end = $("#filter-stock-selesai").val();
            const tipeId = $("#filter-tipe-material").val();

            // Set period in print preview
            const periodStr = formatDateIndo(start) + ' - ' + formatDateIndo(end);
            $(".print-periode").text(periodStr);

            $.post("/model/material_stock_report_data.php", {
                tanggal_mulai: start,
                tanggal_selesai: end,
                id_tipe_material: tipeId
            }, function(res) {
                if (res.status === 'success') {
                    // Update Summary cards
                    $("#card-total-items").text(res.summary.total_items + ' Material');
                    $("#card-total-asset-valuation").text(formatValCurrency(res.summary.total_asset_valuation_idr, 'IDR'));
                    
                    renderStockTable(res.data);
                } else {
                    alert('Gagal mengambil data laporan: ' + res.message);
                }
            }, 'json');
        }

        // Render rows of the stock ledger table
        function renderStockTable(items) {
            let html = '';

            if (items.length === 0) {
                html = `
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            <i class="bi bi-info-circle me-1"></i> Tidak ada material terdaftar.
                        </td>
                    </tr>
                `;
            } else {
                items.forEach((it, i) => {
                    const assetValStr = formatValCurrency(it.asset_value, it.currency);
                    
                    html += `
                        <tr>
                            <td class="text-center font-sans font-normal" style="font-family: inherit;">${i + 1}</td>
                            <td class="fw-bold text-dark text-start font-monospace">${it.kode_material}</td>
                            <td class="text-start font-sans" style="font-family: inherit;">
                                <span class="fw-semibold text-dark-blue">${it.nama_material_internal}</span>
                            </td>
                            <td class="text-start font-sans" style="font-family: inherit;">
                                <span class="badge bg-light text-secondary border px-2 py-1 small">${it.nama_tipe_material ?? '-'}</span>
                            </td>
                            <td class="text-center font-sans" style="font-family: inherit;">${it.satuan}</td>
                            
                            <!-- Quantities -->
                            <td class="text-center font-monospace fw-semibold">${it.stok_awal}</td>
                            <td class="text-center font-monospace text-success fw-bold">+${it.qty_masuk}</td>
                            <td class="text-center font-monospace text-danger fw-bold">-${it.qty_keluar}</td>
                            <td class="text-center font-monospace fw-bold text-primary">${it.stok_akhir}</td>
                            
                            <!-- Asset valuation -->
                            <td class="text-end fw-bold font-monospace text-dark">${assetValStr}</td>
                        </tr>
                    `;
                });
            }

            $("#stock-report-body").html(html);
        }

        // Initialize view components
        loadTipeMaterialOptions();
        loadStockReport();

        // Bind filter event
        $("#btn-filter-stock").click(function() {
            loadStockReport();
        });

        // Bind print event
        $("#btn-print-stock-report").click(function() {
            window.print();
        });
    });
</script>
