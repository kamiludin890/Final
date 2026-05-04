<?php
$skema = "CREATE TABLE IF NOT EXISTS currency_rate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency VARCHAR(10),
    rate DECIMAL(15,2),
    tanggal DATE
);";
