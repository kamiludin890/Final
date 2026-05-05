<?php
$skema = "CREATE TABLE IF NOT EXISTS purchase_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_customer_supplier INT,
    no_purchase_order VARCHAR(50),
    tanggal_purchase_order DATE,
    tanggal_due_date DATE,
    status TINYINT DEFAULT 1
);";
