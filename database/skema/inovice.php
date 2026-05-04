<?php
$skema = "CREATE TABLE IF NOT EXISTS invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_customer_supplier INT,
    id_purchase_order INT,
    no_invoice VARCHAR(50),
    tanggal_invoice DATE,
    tax_tipe VARCHAR(50),
    total DECIMAL(15,2),
    currency VARCHAR(10),
    status TINYINT DEFAULT 1
);";
