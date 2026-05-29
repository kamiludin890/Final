<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/template/btn_kembali_second.php';
?>
<?php

/**
 * HALAMAN DOKUMENTASI FINAL APP
 * Sistem ERP - Financial Analysis and Resource Planning
 * 
 * File: view/info_pengguna.php
 * Purpose: Menampilkan dokumentasi lengkap aplikasi Final App
 */
?>

<div class="container-lg mt-5 mb-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-light p-5 rounded-lg border-start border-primary border-5">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="public/icon/Final.png" alt="Final App" style="width: 60px; height: 60px;">
                    <div>
                        <h1 class="m-0">Final App - Dokumentasi Sistem</h1>
                        <p class="text-muted m-0">Sistem ERP untuk Manajemen Keuangan dan Sumber Daya</p>
                    </div>
                </div>
                <p class="text-secondary">Dokumentasi ini menjelaskan fitur, penggunaan, dan struktur sistem Final App secara menyeluruh.</p>
            </div>
        </div>
    </div>

    <!-- Daftar Isi -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-list"></i> Daftar Isi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><a href="#overview" class="text-decoration-none">1. Ringkasan Aplikasi</a></li>
                                <li><a href="#requirements" class="text-decoration-none">2. Persyaratan Sistem</a></li>
                                <li><a href="#installation" class="text-decoration-none">3. Instalasi</a></li>
                                <li><a href="#features" class="text-decoration-none">4. Fitur & Modul</a></li>
                                <li><a href="#structure" class="text-decoration-none">5. Struktur Proyek</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><a href="#modules" class="text-decoration-none">6. Detail Modul</a></li>
                                <li><a href="#database" class="text-decoration-none">7. Struktur Database</a></li>
                                <li><a href="#users" class="text-decoration-none">8. Pengguna & Akses</a></li>
                                <li><a href="#guide" class="text-decoration-none">9. Panduan Penggunaan</a></li>
                                <li><a href="#support" class="text-decoration-none">10. Dukungan & Bantuan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 1. RINGKASAN APLIKASI -->
    <div class="row mb-4" id="overview">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-info-circle"></i> 1. Ringkasan Aplikasi</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">Apa itu Final App?</h6>
                    <p>Final App adalah Sistem ERP (Enterprise Resource Planning) yang dirancang untuk membantu perusahaan dalam mengelola keuangan dan sumber daya secara efisien. Sistem ini menyediakan solusi lengkap untuk:</p>

                    <ul>
                        <li><strong>Manajemen Material</strong> - Tracking stok barang dan inventory</li>
                        <li><strong>Manajemen Penjualan & Pembelian</strong> - Invoice dan purchase order</li>
                        <li><strong>Manajemen Pelanggan & Supplier</strong> - Database kontak bisnis</li>
                        <li><strong>Analisis Keuangan</strong> - Laporan pendapatan dan pengeluaran multi-currency</li>
                        <li><strong>Kontrol Akses Pengguna</strong> - Role-based access control (RBAC)</li>
                    </ul>

                    <div class="alert alert-info mt-3">
                        <strong><i class="bi bi-lightbulb"></i> Fitur Utama:</strong><br>
                        Sistem mendukung multi-currency dengan konversi otomatis ke IDR, dashboard dengan visualisasi data real-time, laporan finansial menyeluruh, dan manajemen pengguna dengan berbagai level akses.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. PERSYARATAN SISTEM -->
    <div class="row mb-4" id="requirements">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-gear"></i> 2. Persyaratan Sistem</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Server Requirements</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Web Server:</strong> Apache 2.4.66 atau lebih tinggi
                                </li>
                                <li class="list-group-item">
                                    <strong>PHP Version:</strong> 8.3.30 atau lebih tinggi
                                </li>
                                <li class="list-group-item">
                                    <strong>Database:</strong> MySQL 8.4.3 atau lebih tinggi
                                </li>
                                <li class="list-group-item">
                                    <strong>PHP Extensions:</strong>
                                    <ul class="mt-2">
                                        <li>PDO MySQL</li>
                                        <li>COM/DOTNET</li>
                                        <li>JSON</li>
                                        <li>cURL</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Tools & Software</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Composer:</strong> Package manager PHP
                                </li>
                                <li class="list-group-item">
                                    <strong>Git:</strong> Version control (opsional)
                                </li>
                                <li class="list-group-item">
                                    <strong>Browser Support:</strong> Semua modern browsers (Chrome, Firefox, Safari, Edge)
                                </li>
                                <li class="list-group-item">
                                    <strong>Recommended Tools:</strong>
                                    <ul class="mt-2">
                                        <li><strong>Laragon</strong> (Windows)</li>
                                        <li><strong>XAMPP</strong> (Cross-platform)</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. INSTALASI -->
    <div class="row mb-4" id="installation">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-download"></i> 3. Instalasi</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Langkah-Langkah Instalasi</h6>

                    <div class="accordion" id="installationAccordion">
                        <!-- Step 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#step1">
                                    Langkah 1: Clone Repository
                                </button>
                            </h2>
                            <div id="step1" class="accordion-collapse collapse show" data-bs-parent="#installationAccordion">
                                <div class="accordion-body">
                                    <p>Clone repository dari GitHub:</p>
                                    <pre class="bg-light p-3 rounded"><code>git clone https://github.com/kamiludin890/Final.git</code></pre>
                                    <p>Atau download sebagai ZIP dan extract ke folder web server Anda (htdocs untuk XAMPP atau www untuk Laragon).</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step2">
                                    Langkah 2: Instalasi Dependencies
                                </button>
                            </h2>
                            <div id="step2" class="accordion-collapse collapse" data-bs-parent="#installationAccordion">
                                <div class="accordion-body">
                                    <p>Buka terminal di folder proyek dan jalankan:</p>
                                    <pre class="bg-light p-3 rounded"><code>composer install</code></pre>
                                    <p>Atau instalasi packages secara individual:</p>
                                    <pre class="bg-light p-3 rounded"><code>composer require twbs/bootstrap:5.3.8
composer require twbs/bootstrap-icons
composer require coreui/coreui:^5.6
composer require codeat3/blade-google-material-design-icons:^1.21</code></pre>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step3">
                                    Langkah 3: Konfigurasi Database
                                </button>
                            </h2>
                            <div id="step3" class="accordion-collapse collapse" data-bs-parent="#installationAccordion">
                                <div class="accordion-body">
                                    <p><strong>Buat database baru di MySQL:</strong></p>
                                    <pre class="bg-light p-3 rounded"><code>CREATE DATABASE final_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</code></pre>

                                    <p class="mt-3"><strong>Konfigurasi file database/koneksi.php:</strong></p>
                                    <pre class="bg-light p-3 rounded"><code>&lt;?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'final_app';

$conn = new mysqli($host, $user, $password, $db);
?&gt;</code></pre>

                                    <p class="mt-3"><strong>Import database schema:</strong></p>
                                    <p>Gunakan file-file di folder <code>database/skema/</code> untuk membuat tabel. Import semua file ke database Anda melalui phpMyAdmin atau command line MySQL.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step4">
                                    Langkah 4: Setup Pengguna Default
                                </button>
                            </h2>
                            <div id="step4" class="accordion-collapse collapse" data-bs-parent="#installationAccordion">
                                <div class="accordion-body">
                                    <p>Sistem akan otomatis membuat pengguna default jika tabel user kosong:</p>
                                    <ul>
                                        <li><strong>Username:</strong> admin</li>
                                        <li><strong>Password:</strong> admin</li>
                                    </ul>
                                    <div class="alert alert-warning mt-3">
                                        <strong><i class="bi bi-exclamation-triangle"></i> Penting:</strong> Segera ubah password default setelah login pertama kali!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step5">
                                    Langkah 5: Akses Aplikasi
                                </button>
                            </h2>
                            <div id="step5" class="accordion-collapse collapse" data-bs-parent="#installationAccordion">
                                <div class="accordion-body">
                                    <p>Akses aplikasi melalui browser:</p>
                                    <ul>
                                        <li><strong>Local:</strong> http://localhost/Final/ (atau sesuai folder proyek Anda)</li>
                                        <li><strong>Dengan Laragon:</strong> http://final.local/ (jika sudah dikonfigurasi)</li>
                                    </ul>
                                    <p class="mt-3">Sistem akan mengarahkan Anda ke halaman login jika belum authenticated.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. FITUR & MODUL -->
    <div class="row mb-4" id="features">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-box2"></i> 4. Fitur & Modul Utama</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Dashboard -->
                        <div class="col-md-6">
                            <div class="card border-left border-primary border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-speedometer2 text-primary"></i> Dashboard
                                    </h6>
                                    <p class="card-text text-muted small">Tampilan ringkasan data dengan visualisasi chart dan KPI real-time</p>
                                    <ul class="small">
                                        <li>Total Material & Invoice</li>
                                        <li>Revenue & Expense Overview</li>
                                        <li>Monthly Sales & Purchase Chart</li>
                                        <li>Currency Conversion to IDR</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Material Management -->
                        <div class="col-md-6">
                            <div class="card border-left border-success border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-box-seam text-success"></i> Manajemen Material
                                    </h6>
                                    <p class="card-text text-muted small">Kelola inventory dan data material dengan kategori dan konversi satuan</p>
                                    <ul class="small">
                                        <li>CRUD Material & Stok</li>
                                        <li>Tipe Material (Kategori)</li>
                                        <li>Konversi Satuan</li>
                                        <li>Material Stock Report</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Management -->
                        <div class="col-md-6">
                            <div class="card border-left border-danger border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-receipt text-danger"></i> Manajemen Invoice
                                    </h6>
                                    <p class="card-text text-muted small">Kelola faktur penjualan dan pembelian dengan multi-currency support</p>
                                    <ul class="small">
                                        <li>Invoice Penjualan & Pembelian</li>
                                        <li>Invoice Item Management</li>
                                        <li>Multi-Currency Support</li>
                                        <li>Invoice Print & Export</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Customer & Supplier -->
                        <div class="col-md-6">
                            <div class="card border-left border-warning border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-person-lines-fill text-warning"></i> Pelanggan & Supplier
                                    </h6>
                                    <p class="card-text text-muted small">Database lengkap untuk manajemen relasi bisnis</p>
                                    <ul class="small">
                                        <li>Daftar Customer & Supplier</li>
                                        <li>Informasi Kontak & Alamat</li>
                                        <li>Histori Transaksi</li>
                                        <li>Data Validasi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Order -->
                        <div class="col-md-6">
                            <div class="card border-left border-info border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-file-earmark-arrow-down text-info"></i> Purchase Order
                                    </h6>
                                    <p class="card-text text-muted small">Manajemen pesanan pembelian dari supplier</p>
                                    <ul class="small">
                                        <li>Buat & Kelola PO</li>
                                        <li>Item Detail & Harga</li>
                                        <li>Status Tracking</li>
                                        <li>Print & Approval</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- In/Out Material -->
                        <div class="col-md-6">
                            <div class="card border-left border-secondary border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-arrow-left-right text-secondary"></i> Masuk/Keluar Material
                                    </h6>
                                    <p class="card-text text-muted small">Tracking pergerakan stok material</p>
                                    <ul class="small">
                                        <li>Record Material In/Out</li>
                                        <li>Quantity & Date Tracking</li>
                                        <li>Status Management</li>
                                        <li>Detail Reporting</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Reports -->
                        <div class="col-md-6">
                            <div class="card border-left border-success border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-graph-up text-success"></i> Laporan Keuangan
                                    </h6>
                                    <p class="card-text text-muted small">Analisis finansial mendalam dengan multiple currencies</p>
                                    <ul class="small">
                                        <li>Revenue & Expense Report</li>
                                        <li>Profit Analysis</li>
                                        <li>Currency Breakdown</li>
                                        <li>Time-based Filtering</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Settings & Admin -->
                        <div class="col-md-6">
                            <div class="card border-left border-dark border-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">
                                        <i class="bi bi-gear text-dark"></i> Pengaturan & Admin
                                    </h6>
                                    <p class="card-text text-muted small">Konfigurasi sistem dan manajemen pengguna</p>
                                    <ul class="small">
                                        <li>User Management & Roles</li>
                                        <li>Company Settings</li>
                                        <li>Currency Management</li>
                                        <li>Database Import/Export</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. STRUKTUR PROYEK -->
    <div class="row mb-4" id="structure">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-diagram-3"></i> 5. Struktur Proyek (MVC Pattern)</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">Final App menggunakan pola <strong>MVC (Model-View-Controller)</strong> untuk organisasi kode yang baik:</p>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Model Layer</h6>
                            <pre class="bg-light p-3 rounded small"><code>/model/
  ├── login.php              (Auth & Login)
  ├── material.php           (Material CRUD)
  ├── invoice.php            (Invoice Management)
  ├── purchase_order.php     (PO Management)
  ├── customer_supplier.php  (Customer/Supplier)
  ├── in_out_material.php    (Stock Movement)
  ├── financial_report_data.php
  ├── material_stock_report_data.php
  └── ... [berbagai helper models]</code></pre>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">View Layer</h6>
                            <pre class="bg-light p-3 rounded small"><code>/view/
  ├── template/
  │   ├── header.php    (HTML Header)
  │   └── footer.php    (HTML Footer)
  ├── dashboard.php     (Dashboard View)
  ├── material.php      (Material List)
  ├── invoice.php       (Invoice List)
  ├── purchase_order.php
  ├── form/             (Form Templates)
  ├── print/            (Print Templates)
  ├── report/           (Report Views)
  └── ... [berbagai halaman view]</code></pre>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6 class="fw-bold">Database Layer</h6>
                        <pre class="bg-light p-3 rounded small"><code>/database/
  ├── koneksi.php        (Database Connection)
  ├── config.php         (Config File)
  └── skema/             (Database Schemas)
      ├── material.php
      ├── invoice.php
      ├── purchase_order.php
      └── ... [berbagai table schemas]</code></pre>
                    </div>

                    <div class="mt-3">
                        <h6 class="fw-bold">Folder Lainnya</h6>
                        <ul>
                            <li><strong>/controller/</strong> - Route handler & controller utama</li>
                            <li><strong>/public/</strong> - Assets (CSS, JS, Icon)</li>
                            <li><strong>/vendor/</strong> - Composer dependencies (Bootstrap, CoreUI, etc)</li>
                            <li><strong>/screenshoot/</strong> - Screenshot untuk dokumentasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. DETAIL MODUL -->
    <div class="row mb-4" id="modules">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-puzzle"></i> 6. Detail Modul & Fitur</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="modulesAccordion">
                        <!-- Modul Material -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#modul1">
                                    📦 Manajemen Material
                                </button>
                            </h2>
                            <div id="modul1" class="accordion-collapse collapse show" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul untuk mengelola data material/barang dengan stok tracking.</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li>Tambah/Edit/Hapus Material</li>
                                        <li>Tracking Stok Real-time</li>
                                        <li>Kategori Material (Tipe)</li>
                                        <li>Konversi Satuan (Kg, Liter, PCS, dll)</li>
                                        <li>Status Active/Inactive</li>
                                        <li>Laporan Stok Material</li>
                                    </ul>
                                    <p class="mt-2"><strong>Database Table:</strong> <code>material</code>, <code>tipe_material</code>, <code>konfersi_satuan</code></p>
                                    <p><strong>Related Models:</strong> material.php, tipe_material.php</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modul Invoice -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modul2">
                                    📄 Manajemen Invoice
                                </button>
                            </h2>
                            <div id="modul2" class="accordion-collapse collapse" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul untuk invoice penjualan dan pembelian dengan support multi-currency.</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li>Buat Invoice (Sales & Purchase)</li>
                                        <li>Item Management dalam Invoice</li>
                                        <li>Multi-Currency Support (USD, SGD, EUR, JPY, dll)</li>
                                        <li>Auto-generate Invoice Number</li>
                                        <li>Print/Export Invoice</li>
                                        <li>Status Tracking (Draft, Completed, Cancelled)</li>
                                        <li>Customer/Supplier Link</li>
                                    </ul>
                                    <p class="mt-2"><strong>Database Table:</strong> <code>invoice</code>, <code>invoice_item</code>, <code>currency_rate</code></p>
                                    <p><strong>Related Models:</strong> invoice.php, get_invoice.php</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modul Purchase Order -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modul3">
                                    📋 Purchase Order
                                </button>
                            </h2>
                            <div id="modul3" class="accordion-collapse collapse" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul untuk manajemen pesanan pembelian dari supplier.</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li>Buat Purchase Order Baru</li>
                                        <li>Item & Harga Management</li>
                                        <li>Auto-generate PO Number</li>
                                        <li>Supplier Assignment</li>
                                        <li>Delivery Date Tracking</li>
                                        <li>PO Status (Pending, Approved, Received)</li>
                                        <li>Print PO untuk Approval</li>
                                    </ul>
                                    <p class="mt-2"><strong>Database Table:</strong> <code>purchase_order</code>, <code>purchase_order_item</code></p>
                                    <p><strong>Related Models:</strong> purchase_order.php, get_purchase_order.php</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modul Customer/Supplier -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modul4">
                                    👥 Pelanggan & Supplier
                                </button>
                            </h2>
                            <div id="modul4" class="accordion-collapse collapse" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul manajemen database pelanggan dan supplier.</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li>Tambah/Edit/Hapus Customer/Supplier</li>
                                        <li>Tipe Contact (Customer, Supplier, Both)</li>
                                        <li>Informasi Lengkap (Nama, Alamat, Phone, Email)</li>
                                        <li>Bank & Payment Info</li>
                                        <li>Contact Person Management</li>
                                        <li>Histori Transaksi</li>
                                    </ul>
                                    <p class="mt-2"><strong>Database Table:</strong> <code>customer_supplier</code></p>
                                    <p><strong>Related Models:</strong> customer_supplier.php, list_customer_supplier.php</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modul In/Out Material -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modul5">
                                    🔄 Masuk/Keluar Material
                                </button>
                            </h2>
                            <div id="modul5" class="accordion-collapse collapse" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul tracking pergerakan stok material (masuk/keluar).</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li>Record Material In (Pembelian/Penerimaan)</li>
                                        <li>Record Material Out (Penjualan/Penggunaan)</li>
                                        <li>Quantity & Unit Tracking</li>
                                        <li>Date & Time Logging</li>
                                        <li>Reference Document (Invoice, PO)</li>
                                        <li>Stock Update Otomatis</li>
                                        <li>Movement History Report</li>
                                    </ul>
                                    <p class="mt-2"><strong>Database Table:</strong> <code>in_out_material</code></p>
                                    <p><strong>Related Models:</strong> in_out_material.php, detail_in_out_material.php</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modul Laporan -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modul6">
                                    📊 Laporan & Analytics
                                </button>
                            </h2>
                            <div id="modul6" class="accordion-collapse collapse" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul reporting dan analisis finansial serta inventory.</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li><strong>Financial Report:</strong> Revenue, Expense, Profit Analysis</li>
                                        <li><strong>Material Stock Report:</strong> Stok saat ini dan historical</li>
                                        <li><strong>Monthly Charts:</strong> Sales dan Purchase trends</li>
                                        <li><strong>Currency Breakdown:</strong> Multi-currency analysis</li>
                                        <li><strong>Date Range Filtering:</strong> Custom period reporting</li>
                                        <li><strong>PDF Export:</strong> Download laporan sebagai PDF</li>
                                    </ul>
                                    <p class="mt-2"><strong>Related Models:</strong> financial_report_data.php, material_stock_report_data.php</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modul Settings -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modul7">
                                    ⚙️ Pengaturan & Administrator
                                </button>
                            </h2>
                            <div id="modul7" class="accordion-collapse collapse" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><strong>Deskripsi:</strong> Modul konfigurasi sistem dan manajemen admin.</p>
                                    <p><strong>Fitur Utama:</strong></p>
                                    <ul>
                                        <li><strong>User Management:</strong> CRUD User, Role Assignment</li>
                                        <li><strong>Access Control:</strong> Role-based menu access</li>
                                        <li><strong>Company Settings:</strong> Company info & details</li>
                                        <li><strong>Currency Management:</strong> Add/Edit exchange rates</li>
                                        <li><strong>Account Settings:</strong> User profile & password</li>
                                        <li><strong>Database Management:</strong> Import/Export data</li>
                                        <li><strong>User Access Logs:</strong> Track user activities</li>
                                    </ul>
                                    <p class="mt-2"><strong>Related Models:</strong> akun_model.php, user_akses_model.php, company.php</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. STRUKTUR DATABASE -->
    <div class="row mb-4" id="database">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-database"></i> 7. Struktur Database</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3"><strong>Database: final_app</strong> | Type: MySQL 8.4.3</p>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Tabel</th>
                                    <th>Deskripsi</th>
                                    <th>Primary Key</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>user</code></td>
                                    <td>Data pengguna sistem</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>material</code></td>
                                    <td>Daftar material/barang</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>tipe_material</code></td>
                                    <td>Kategori/jenis material</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>invoice</code></td>
                                    <td>Data invoice (penjualan & pembelian)</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>invoice_item</code></td>
                                    <td>Item detail dalam invoice</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>purchase_order</code></td>
                                    <td>Data purchase order dari supplier</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>purchase_order_item</code></td>
                                    <td>Item detail dalam PO</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>customer_supplier</code></td>
                                    <td>Data customer dan supplier</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>in_out_material</code></td>
                                    <td>Tracking masuk/keluar material</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>currency_rate</code></td>
                                    <td>Nilai tukar mata uang</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>currency_list</code></td>
                                    <td>Daftar mata uang yang didukung</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>konfersi_satuan</code></td>
                                    <td>Konversi satuan material</td>
                                    <td>id (INT)</td>
                                </tr>
                                <tr>
                                    <td><code>company</code></td>
                                    <td>Informasi perusahaan</td>
                                    <td>id (INT)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-info mt-3">
                        <strong><i class="bi bi-info-circle"></i> Note:</strong> File schema untuk setiap tabel tersedia di folder <code>/database/skema/</code>. Import semua file untuk membuat struktur database lengkap.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 8. PENGGUNA & AKSES -->
    <div class="row mb-4" id="users">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-shield-lock"></i> 8. Manajemen Pengguna & Akses</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Role-Based Access Control (RBAC)</h6>
                    <p>Sistem menggunakan sistem role untuk mengontrol akses menu berdasarkan keperluan pengguna.</p>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Role Standar</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Admin:</strong> Akses penuh ke semua menu dan fitur
                                </li>
                                <li class="list-group-item">
                                    <strong>Manager:</strong> Akses ke data, laporan, dan pengaturan terbatas
                                </li>
                                <li class="list-group-item">
                                    <strong>Staff:</strong> Akses ke input data dan view laporan
                                </li>
                                <li class="list-group-item">
                                    <strong>Supervisor:</strong> Akses ke data dan approval transaksi
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Menu Access Groups</h6>
                            <ul>
                                <li><strong>Dashboard:</strong> View ringkasan data</li>
                                <li><strong>Data:</strong> Material, Invoice, PO, Customer/Supplier, Stock Movement</li>
                                <li><strong>Laporan:</strong> Financial & Stock Reports</li>
                                <li><strong>Pengaturan:</strong> User, Currency, Settings, Database</li>
                            </ul>
                        </div>
                    </div>

                    <h6 class="fw-bold">Mengelola User Access</h6>
                    <p>Untuk memberikan/mengubah akses user:</p>
                    <ol>
                        <li>Login sebagai Admin</li>
                        <li>Buka menu <strong>Pengaturan → User Management</strong></li>
                        <li>Pilih user yang ingin diubah aksesnya</li>
                        <li>Tentukan menu mana saja yang boleh diakses</li>
                        <li>Simpan perubahan</li>
                    </ol>

                    <div class="alert alert-warning mt-3">
                        <strong><i class="bi bi-exclamation-triangle"></i> Keamanan:</strong> Selalu ubah password default (admin/admin) setelah setup awal. Jangan berikan akses admin kepada semua user.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 9. PANDUAN PENGGUNAAN -->
    <div class="row mb-4" id="guide">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-book"></i> 9. Panduan Penggunaan</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="guideAccordion">
                        <!-- Login -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#guide1">
                                    Login ke Sistem
                                </button>
                            </h2>
                            <div id="guide1" class="accordion-collapse collapse show" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Akses aplikasi melalui browser (http://localhost/Final/)</li>
                                        <li>Masukkan <strong>Username</strong> dan <strong>Password</strong></li>
                                        <li>Klik tombol <strong>Login</strong></li>
                                        <li>Jika login offline (database tidak terkoneksi), gunakan akun: admin / admin</li>
                                    </ol>
                                    <div class="alert alert-info">
                                        <strong>Tips:</strong> Username default adalah "admin" dengan password "admin" pada instalasi pertama.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigasi -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide2">
                                    Navigasi Menu Utama
                                </button>
                            </h2>
                            <div id="guide2" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <p>Menu tersedia di sisi kiri (sidebar) dengan ikon dan label:</p>
                                    <ul>
                                        <li><strong>📊 Dashboard:</strong> Tampilan ringkasan dan KPI</li>
                                        <li><strong>📁 Data:</strong> CRUD material, invoice, PO, customer/supplier</li>
                                        <li><strong>📈 Laporan:</strong> Financial dan stock reports</li>
                                        <li><strong>⚙️ Pengaturan:</strong> Konfigurasi sistem dan user management</li>
                                    </ul>
                                    <p class="mt-3"><strong>Catatan:</strong> Menu yang tidak bisa diakses akan tampil disabled sesuai role user Anda.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tambah Data -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide3">
                                    Menambah Data Baru
                                </button>
                            </h2>
                            <div id="guide3" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <p><strong>Langkah umum untuk menambah data:</strong></p>
                                    <ol>
                                        <li>Navigasi ke menu yang sesuai (Data → Material, Data → Invoice, dll)</li>
                                        <li>Klik tombol <strong>"Tambah Data Baru"</strong> atau <strong>"+ New"</strong></li>
                                        <li>Form akan muncul untuk diisi</li>
                                        <li>Isi semua field yang required (bertanda <span class="text-danger">*</span>)</li>
                                        <li>Klik tombol <strong>"Simpan"</strong> atau <strong>"Submit"</strong></li>
                                        <li>Sistem akan menampilkan pesan sukses jika berhasil</li>
                                    </ol>
                                    <div class="alert alert-info">
                                        <strong>Tips:</strong> Jika form sudah diisi tapi tombol simpan tidak aktif, pastikan semua field required sudah terisi dengan benar.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Data -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide4">
                                    Mengedit Data Existing
                                </button>
                            </h2>
                            <div id="guide4" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Buka daftar data (Data → Material, Data → Invoice, dll)</li>
                                        <li>Cari data yang ingin diedit dengan scrolling atau search filter</li>
                                        <li>Klik tombol <strong>"Edit"</strong> atau ikon <strong>Edit</strong> pada baris data</li>
                                        <li>Form akan terbuka dengan data yang sudah terisi</li>
                                        <li>Ubah field yang perlu diubah</li>
                                        <li>Klik tombol <strong>"Perbarui"</strong> atau <strong>"Update"</strong></li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- Hapus Data -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide5">
                                    Menghapus Data
                                </button>
                            </h2>
                            <div id="guide5" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Buka daftar data yang ingin dihapus</li>
                                        <li>Klik tombol <strong>"Hapus"</strong> atau ikon <strong>Delete</strong> pada baris data</li>
                                        <li>Konfirmasi akan muncul - klik <strong>"Hapus"</strong> atau <strong>"OK"</strong> untuk mengonfirmasi</li>
                                        <li>Data akan dihapus dari database</li>
                                    </ol>
                                    <div class="alert alert-danger">
                                        <strong><i class="bi bi-exclamation-triangle"></i> Peringatan:</strong> Tindakan penghapusan biasanya tidak bisa dibatalkan (kecuali ada backup). Pastikan Anda yakin sebelum menghapus data penting.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Laporan -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide6">
                                    Membuat & Mengekspor Laporan
                                </button>
                            </h2>
                            <div id="guide6" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <p><strong>Mengakses Laporan:</strong></p>
                                    <ol>
                                        <li>Navigasi ke menu <strong>Laporan</strong> di sidebar</li>
                                        <li>Pilih jenis laporan yang diinginkan (Financial atau Stock)</li>
                                        <li>Tentukan date range dengan filter tanggal (optional)</li>
                                        <li>Laporan akan ditampilkan dengan grafik dan tabel</li>
                                    </ol>

                                    <p class="mt-3"><strong>Export Laporan:</strong></p>
                                    <ol>
                                        <li>Setelah laporan ditampilkan, cari tombol <strong>"Export PDF"</strong> atau <strong>"Print"</strong></li>
                                        <li>Sistem akan generate PDF laporan</li>
                                        <li>File PDF siap untuk didownload atau dicetak</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- Multi-Currency -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide7">
                                    Bekerja dengan Multi-Currency
                                </button>
                            </h2>
                            <div id="guide7" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                <div class="accordion-body">
                                    <p><strong>Sistem mendukung mata uang berikut:</strong> IDR, USD, SGD, EUR, JPY, dan lainnya.</p>

                                    <p class="mt-3"><strong>Mengubah Currency Rate:</strong></p>
                                    <ol>
                                        <li>Buka menu <strong>Pengaturan → Currency Management</strong></li>
                                        <li>Masukkan atau update rate untuk setiap currency</li>
                                        <li>Simpan perubahan</li>
                                        <li>Rate akan digunakan untuk konversi otomatis ke IDR</li>
                                    </ol>

                                    <p class="mt-3"><strong>Fallback Rates:</strong> Jika rate tidak ditemukan, sistem menggunakan fallback default (USD: 16000, SGD: 11800, EUR: 17200, JPY: 102).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 10. DUKUNGAN & BANTUAN -->
    <div class="row mb-4" id="support">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0"><i class="bi bi-headset"></i> 10. Dukungan & Bantuan</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Troubleshooting Umum</h6>
                            <div class="accordion" id="troubleAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#trouble1">
                                            Database tidak terkoneksi
                                        </button>
                                    </h2>
                                    <div id="trouble1" class="accordion-collapse collapse" data-bs-parent="#troubleAccordion">
                                        <div class="accordion-body small">
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Pastikan MySQL service sudah berjalan</li>
                                                <li>Verifikasi konfigurasi di <code>database/koneksi.php</code></li>
                                                <li>Cek username dan password database</li>
                                                <li>Pastikan database sudah dibuat</li>
                                                <li>Coba login dengan akun offline (admin/admin)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#trouble2">
                                            Lupa password user
                                        </button>
                                    </h2>
                                    <div id="trouble2" class="accordion-collapse collapse" data-bs-parent="#troubleAccordion">
                                        <div class="accordion-body small">
                                            <p><strong>Solusi:</strong></p>
                                            <ol>
                                                <li>Login sebagai Admin</li>
                                                <li>Buka Pengaturan → User Management</li>
                                                <li>Cari user yang lupa password</li>
                                                <li>Klik "Reset Password" atau edit user</li>
                                                <li>Set password baru untuk user tersebut</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#trouble3">
                                            Laporan tidak menampilkan data
                                        </button>
                                    </h2>
                                    <div id="trouble3" class="accordion-collapse collapse" data-bs-parent="#troubleAccordion">
                                        <div class="accordion-body small">
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Pastikan data sudah diinput dengan status "active" atau "completed"</li>
                                                <li>Cek date range filter sesuai dengan periode data</li>
                                                <li>Refresh halaman atau clear browser cache</li>
                                                <li>Verifikasi database schema sudah benar</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#trouble4">
                                            Menu tidak muncul
                                        </button>
                                    </h2>
                                    <div id="trouble4" class="accordion-collapse collapse" data-bs-parent="#troubleAccordion">
                                        <div class="accordion-body small">
                                            <p><strong>Solusi:</strong></p>
                                            <ul>
                                                <li>Periksa access control di user settings</li>
                                                <li>Admin harus memberikan akses menu yang diperlukan</li>
                                                <li>Logout dan login kembali agar perubahan akses teraplikasi</li>
                                                <li>Pastikan user tidak memiliki role yang membatasi akses</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold">Kontak & Referensi</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>GitHub Repository:</strong><br>
                                    <a href="https://github.com/kamiludin890/Final" target="_blank" class="text-decoration-none">
                                        https://github.com/kamiludin890/Final
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <strong>Documentation Files:</strong><br>
                                    <ul class="small mt-2">
                                        <li>readme.md - Overview & installation</li>
                                        <li>LICENSE.txt - License information</li>
                                        <li>/database/skema/ - Database schemas</li>
                                    </ul>
                                </li>
                                <li class="list-group-item">
                                    <strong>Key Files:</strong><br>
                                    <ul class="small mt-2">
                                        <li>index.php - Entry point</li>
                                        <li>controller/index.php - Main router</li>
                                        <li>database/koneksi.php - DB connection</li>
                                    </ul>
                                </li>
                            </ul>

                            <div class="alert alert-info mt-3">
                                <strong><i class="bi bi-lightbulb"></i> Tips:</strong> Untuk bantuan lebih lanjut, check file schema untuk struktur database detail atau baca kode model untuk memahami business logic.
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">Dokumentasi Teknis</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Framework & Library:</strong></p>
                            <ul class="small">
                                <li>Bootstrap 5.3.8 - UI Framework</li>
                                <li>Bootstrap Icons - Icon Library</li>
                                <li>CoreUI 5.6 - Admin Template</li>
                                <li>Google Material Icons - Additional Icons</li>
                                <li>jQuery - JavaScript Library</li>
                                <li>Chart.js - Data Visualization</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Architecture:</strong></p>
                            <ul class="small">
                                <li>Design Pattern: MVC</li>
                                <li>Database: MySQL (Relational)</li>
                                <li>Server Language: PHP 8.3+</li>
                                <li>Session Management: PHP Sessions</li>
                                <li>Data Format: JSON</li>
                                <li>Authentication: Username/Password</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Lisensi -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title fw-bold">
                        <i class="bi bi-shield-check"></i> Lisensi & Informasi Proyek
                    </h6>
                    <p class="card-text small">
                        <strong>Final App</strong> adalah sistem ERP open-source yang dirancang untuk memudahkan manajemen keuangan dan sumber daya perusahaan.
                        Proyek ini dilisensikan di bawah MIT License, GPL v3, dan AGPL - silakan lihat file LICENSE.txt untuk detail lengkap.
                    </p>
                    <p class="card-text small text-muted">
                        <strong>Dokumentasi dibuat pada:</strong> <?= date('d F Y H:i:s') ?> |
                        <strong>Versi Dokumen:</strong> 1.0
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .border-left {
        border-left: 4px solid #007bff !important;
        padding-left: 15px;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0c63e4;
    }

    pre code {
        font-size: 0.875rem;
    }

    .logo-final {
        width: 40px;
        height: 40px;
    }

    .table-sm td,
    .table-sm th {
        padding: 0.5rem;
    }
</style>