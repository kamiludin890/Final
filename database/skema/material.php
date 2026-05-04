<?php
$skema = "CREATE TABLE IF NOT EXISTS material (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_material VARCHAR(50),
    nama_material_internal text,
    tipe_material text,
    harga DECIMAL(15,2),
    currency VARCHAR(10),
    satuan VARCHAR(50),
    status TINYINT DEFAULT 1
);";
