<?php
$skema = "CREATE TABLE IF NOT EXISTS tipe_material (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tipe_material VARCHAR(255),
    pengkodean VARCHAR(255),
    status TINYINT DEFAULT 1
);";
