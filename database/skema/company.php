<?php
$skema = "CREATE TABLE IF NOT EXISTS company (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company VARCHAR(10),
    company_code VARCHAR(10),
    company_address TEXT,
    email VARCHAR(255),
    tax_number VARCHAR(255)
);";
