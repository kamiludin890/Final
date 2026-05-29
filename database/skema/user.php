<?php
$skema = "CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    department VARCHAR(50),
    nama VARCHAR(255),
    email VARCHAR(255),
    no_telp VARCHAR(20),
    alamat TEXT,
    foto text,
    akses text,
    status TINYINT DEFAULT 1
);";
